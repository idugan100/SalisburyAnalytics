<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Course;
use Illuminate\Support\Facades\DB;


class calculate_course_grade_distributions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate_course_grade_distributions';

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
        foreach($courses as $course){
            $course->qty_A=0;
            $course->qty_B=0;
            $course->qty_C=0;
            $course->qty_D=0;
            $course->qty_F=0;
            $course->qty_W=0;

            $grade_array=DB::table('courses_x_professors_with_grades')
                ->select(DB::raw('grade, sum(quantity) as "qty"'))
                ->where('course_ID',$course->id)
                ->groupBy('grade')
                ->orderBY('grade')
                ->get();

            foreach($grade_array as $grade){
                switch ($grade->grade) {
                    case 'A':
                        $course->qty_A=$grade->qty;
                        break;
                    case 'B':
                        $course->qty_B=$grade->qty;
                        break;
                    case 'C':
                        $course->qty_C=$grade->qty;
                        break;
                    case 'D':
                        $course->qty_D=$grade->qty;
                        break;
                    case 'F':
                        $course->qty_F=$grade->qty;
                        break;
                    case 'W':
                        $course->qty_W=$grade->qty;
                        break;

                }
            }
            $course->save();
            $bar->advance();
        }

        $bar->finish();
        $this->newline();
        $this->info("Course Grade Distributions Successfully Calculated!");

        return Command::SUCCESS;
    }
}
