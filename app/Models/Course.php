<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ReviewController;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'courseTitle', 'creditLab', 'creditLecture', 'creditsTotal', 'courseNumber', 'departmentCode', 'syllabusLink', 'avg_gpa'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function approved_reviews()
    {
        return $this->hasMany(Review::class)->where('approved_flag', ReviewController::APPROVED_FLAG);
    }

    public function calculate_statistics(){
        $avg_gpa = DB::select(
            "Select ROUND(sum(T.GPA)/sum(T.quantity),2) as 'Course_GPA' from
                (Select grade, quantity, 
                        CASE 
                        WHEN grade='A' THEN 4 
                        WHEN grade='B' THEN 3 
                        WHEN grade='C' THEN 2
                        WHEN grade='D' THEN 1
                        WHEN grade='F' THEN 0
                        END * quantity as 'GPA'
                from courses_x_professors_with_grades
                join courses on course_ID=courses.id
                where departmentCode='".$this->departmentCode."' and courseNumber='".$this->courseNumber."' and grade in ('A','B','C','D','F') )as `T`;");

        $this->avg_gpa = (float) $avg_gpa[0]->Course_GPA;

        $total_enrollment = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where course_ID=? and grade in ('A','B','C','D','F','W');", [$this->id]);
        $this->total_enrollment = (float) $total_enrollment[0]->total;

        if ($this->total_enrollment != 0) {
            $a_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where course_ID=? and grade ='A';", [$this->id]);
            $this->A_Rate = ceil(((float) $a_qty[0]->total * 100) / $this->total_enrollment);

            $b_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where course_ID=? and grade ='B';", [$this->id]);
            $this->B_Rate = ceil(((float) $b_qty[0]->total * 100) / $this->total_enrollment);

            $c_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where course_ID=? and grade ='C';", [$this->id]);
            $this->C_Rate = ceil(((float) $c_qty[0]->total * 100) / $this->total_enrollment);

            $d_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where course_ID=? and grade ='D';", [$this->id]);
            $this->D_Rate = ceil(((float) $d_qty[0]->total * 100) / $this->total_enrollment);

            $f_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where course_ID=? and grade ='F';", [$this->id]);
            $this->F_Rate = ceil(((float) $f_qty[0]->total * 100) / $this->total_enrollment);

            $w_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where course_ID=? and grade ='W';", [$this->id]);
            $this->W_Rate = ceil(((float) $w_qty[0]->total * 100) / $this->total_enrollment);
        }
        $this->save();
    }
}
