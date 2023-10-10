<?php

namespace App\Console\Commands;
use App\Models\Course;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class calculate_course_stats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:course-stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'recalculate all statistics for courses';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $courses=Course::all();
        $bar = $this->output->createProgressBar(count($courses));
        $bar->start();
        foreach($courses as $course){
            $avg_gpa=DB::select(
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
                    where departmentCode='".$course->departmentCode."' and courseNumber='". $course->courseNumber."' and grade in ('A','B','C','D','F') )as `T`;");
            
            $course->avg_gpa = (float) $avg_gpa[0]->Course_GPA;
            
            $total_enrollment = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where course_ID=? and grade in ('A','B','C','D','F','W');",[$course->id]);
            $course->total_enrollment= (float) $total_enrollment[0]->total;
            
            if($course->total_enrollment !=0){
                $a_qty=DB::select("select sum(quantity) as total from courses_x_professors_with_grades where course_ID=? and grade ='A';",[$course->id]);
                $course->A_Rate=ceil(((float) $a_qty[0]->total *100)/$course->total_enrollment);
                
                $b_qty=DB::select("select sum(quantity) as total from courses_x_professors_with_grades where course_ID=? and grade ='B';",[$course->id]);
                $course->B_Rate=ceil(((float) $b_qty[0]->total *100)/$course->total_enrollment);
                
                $c_qty=DB::select("select sum(quantity) as total from courses_x_professors_with_grades where course_ID=? and grade ='C';",[$course->id]);
                $course->C_Rate=ceil(((float) $c_qty[0]->total *100)/$course->total_enrollment);
                
                $d_qty=DB::select("select sum(quantity) as total from courses_x_professors_with_grades where course_ID=? and grade ='D';",[$course->id]);
                $course->D_Rate=ceil(((float) $d_qty[0]->total *100)/$course->total_enrollment);
                
                $f_qty=DB::select("select sum(quantity) as total from courses_x_professors_with_grades where course_ID=? and grade ='F';",[$course->id]);
                $course->F_Rate=ceil(((float) $f_qty[0]->total *100)/$course->total_enrollment);

                $w_qty=DB::select("select sum(quantity) as total from courses_x_professors_with_grades where course_ID=? and grade ='W';",[$course->id]);
                $course->W_Rate=ceil(((float) $w_qty[0]->total *100)/$course->total_enrollment);
            }
            
            
            $course->save();
            $bar->advance();
        }
        $bar->finish();
        $this->newline();
        $this->info("Course Stats Successfully Calculated!");

        return Command::SUCCESS;
    }
}
