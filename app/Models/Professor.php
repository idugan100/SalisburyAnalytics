<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = ['firstName', 'lastName', 'deparment', 'avg_GPA'];

    /** @return HasMany<Review> */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function calculate_statistics(): void
    {
        $avg_gpa = DB::select(
            "Select ROUND(sum(T.GPA)/sum(T.quantity),2) as 'Course_GPA' from
                (Select grade, quantity, 
                        CASE 
                        WHEN grade='A' THEN 4
                        WHEN grade='A-' THEN 3.7
                        WHEN grade='B+' THEN 3.4
                        WHEN grade='B' THEN 3 
                        WHEN grade='B-' THEN 2.7
                        WHEN grade='C+' THEN 2.4
                        WHEN grade='C' THEN 2
                        WHEN grade='C-' THEN 1.7
                        WHEN grade='D+' THEN 1.4
                        WHEN grade='D' THEN 1
                        WHEN grade='D-' THEN .7
                        WHEN grade='E' THEN 0
                        WHEN grade='UW' THEN 0
                        END * quantity as 'GPA'
                from courses_x_professors_with_grades
                join professors on professor_ID=professors.id
                where lastName=\"".$this->lastName.'" and firstName="'.$this->firstName."\" and grade in ('A','A-','B+','B','B-','C+','C','C-','D+','D','D-','E','UW') )as `T`");

        $this->avg_gpa = (float) $avg_gpa[0]->Course_GPA;

        $total_enrollment = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where professor_ID=? and grade in ('A','A-','B+','B','B-','C+','C','C-','D+','D','D-','E','UW');", [$this->id]);
        $this->total_enrollment = (int) $total_enrollment[0]->total;

        if ($this->total_enrollment != 0) {
            $a_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where professor_ID=? and grade in ('A','A-');", [$this->id]);
            $this->A_rate = ceil(((float) $a_qty[0]->total * 100) / $this->total_enrollment);

            $b_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where professor_ID=? and grade in ('B','B+','B-');", [$this->id]);
            $this->B_rate = ceil(((float) $b_qty[0]->total * 100) / $this->total_enrollment);

            $c_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where professor_ID=? and grade in ('C','C+','C-');", [$this->id]);
            $this->C_rate = ceil(((float) $c_qty[0]->total * 100) / $this->total_enrollment);

            $d_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where professor_ID=? and grade in ('D','D+','D-');", [$this->id]);
            $this->D_rate = ceil(((float) $d_qty[0]->total * 100) / $this->total_enrollment);

            $f_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where professor_ID=? and grade in ('E','UW');", [$this->id]);
            $this->F_rate = ceil(((float) $f_qty[0]->total * 100) / $this->total_enrollment);

            $w_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where professor_ID=? and grade in ('W','RW');", [$this->id]);
            $this->W_rate = ceil(((float) $w_qty[0]->total * 100) / $this->total_enrollment);
        }
        $this->save();
    }
}
