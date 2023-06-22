<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Professor;

class calculate_professor_GPAs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate_professor_GPAs';

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
        $professors=Professor::all();
        $bar = $this->output->createProgressBar(count($professors));
        $bar->start();
        foreach($professors as $professor){
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
                    join professors on professor_ID=professors.id
                    where lastName=\"". $professor->lastName . "\" and firstName=\"" . $professor->firstName . "\" and grade in ('A','B','C','D','F','W') )as `T`");

            $professor->avg_gpa= (float) $avg_gpa[0]->Course_GPA;
            $professor->save();
            $bar->advance();
        }
        $bar->finish();
        $this->newline();
        $this->info("Professor GPAs Successfully Calculated!");
        return Command::SUCCESS;
    }
}
