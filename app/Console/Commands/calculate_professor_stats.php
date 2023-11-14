<?php

namespace App\Console\Commands;

use App\Models\Professor;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class calculate_professor_stats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:professor-stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'recalculate all statistics for professors';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $professors = Professor::all();
        $bar = $this->output->createProgressBar(count($professors));
        $bar->start();
        foreach ($professors as $professor) {
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
                    join professors on professor_ID=professors.id
                    where lastName=\"".$professor->lastName.'" and firstName="'.$professor->firstName."\" and grade in ('A','B','C','D','F') )as `T`");

            $professor->avg_gpa = (float) $avg_gpa[0]->Course_GPA;

            $total_enrollment = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where professor_ID=? and grade in ('A','B','C','D','F','W');", [$professor->id]);
            $professor->total_enrollment = (float) $total_enrollment[0]->total;

            if ($professor->total_enrollment != 0) {
                $a_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where professor_ID=? and grade ='A';", [$professor->id]);
                $professor->A_Rate = ceil(((float) $a_qty[0]->total * 100) / $professor->total_enrollment);

                $b_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where professor_ID=? and grade ='B';", [$professor->id]);
                $professor->B_Rate = ceil(((float) $b_qty[0]->total * 100) / $professor->total_enrollment);

                $c_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where professor_ID=? and grade ='C';", [$professor->id]);
                $professor->C_Rate = ceil(((float) $c_qty[0]->total * 100) / $professor->total_enrollment);

                $d_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where professor_ID=? and grade ='D';", [$professor->id]);
                $professor->D_Rate = ceil(((float) $d_qty[0]->total * 100) / $professor->total_enrollment);

                $f_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where professor_ID=? and grade ='F';", [$professor->id]);
                $professor->F_Rate = ceil(((float) $f_qty[0]->total * 100) / $professor->total_enrollment);

                $w_qty = DB::select("select sum(quantity) as total from courses_x_professors_with_grades where professor_ID=? and grade ='W';", [$professor->id]);
                $professor->W_Rate = ceil(((float) $w_qty[0]->total * 100) / $professor->total_enrollment);
            }
            $professor->save();
            $bar->advance();
        }
        $bar->finish();
        $this->newline();
        $this->info('Professor Stats Successfully Calculated!');

        return Command::SUCCESS;
    }
}
