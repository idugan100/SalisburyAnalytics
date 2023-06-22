<?php

namespace App\Console\Commands;
use App\Models\Course;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class calculate_course_GPAs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate_course_GPAs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
                            else 0
                            END * quantity as 'GPA'
                    from courses_x_professors_with_grades
                    join courses on course_ID=courses.id
                    where departmentCode='".$course->departmentCode."' and courseNumber='". $course->courseNumber."' and grade in ('A','B','C','D','F','W') )as `T`;");
            
            $course->avg_gpa= (float) $avg_gpa[0]->Course_GPA;
            $course->save();
            $bar->advance();
        }
        $bar->finish();
        $this->newline();
        $this->info("Course GPAs Successfully Calculated!");

        return Command::SUCCESS;
    }
}
