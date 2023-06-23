<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Professor;

class calculate_professor_grade_distributions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate_professor_grade_distributions';

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
        foreach($professors as $professor){
            $professor->qty_A=0;
            $professor->qty_B=0;
            $professor->qty_C=0;
            $professor->qty_D=0;
            $professor->qty_F=0;
            $professor->qty_W=0;

            $grade_array=DB::table('courses_x_professors_with_grades')
                ->select(DB::raw('grade, sum(quantity) as "qty"'))
                ->where('professor_ID',$professor->id)
                ->groupBy('grade')
                ->orderBY('grade')
                ->get();

            foreach($grade_array as $grade){
                switch ($grade->grade) {
                    case 'A':
                        $professor->qty_A=$grade->qty;
                        break;
                    case 'B':
                        $professor->qty_B=$grade->qty;
                        break;
                    case 'C':
                        $professor->qty_C=$grade->qty;
                        break;
                    case 'D':
                        $professor->qty_D=$grade->qty;
                        break;
                    case 'F':
                        $professor->qty_F=$grade->qty;
                        break;
                    case 'W':
                        $professor->qty_W=$grade->qty;
                        break;

                }
            }
            $professor->save();
            $bar->advance();
        }

        $bar->finish();
        $this->newline();
        $this->info("Professor Grade Distributions Successfully Calculated!");
        return Command::SUCCESS;
    }
}
