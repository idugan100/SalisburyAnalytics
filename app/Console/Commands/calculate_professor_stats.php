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
            $professor->calculate_statistics();
            $bar->advance();
        }
        $bar->finish();
        $this->newline();
        $this->info('Professor Stats Successfully Calculated!');

        return Command::SUCCESS;
    }
}
