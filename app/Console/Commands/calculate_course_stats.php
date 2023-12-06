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
        $courses = Course::all();
        $bar = $this->output->createProgressBar(count($courses));
        $bar->start();
        foreach ($courses as $course) {
            $course->calculate_statistics();
            $bar->advance();
        }
        $bar->finish();
        $this->newline();
        $this->info('Course Stats Successfully Calculated!');

        return Command::SUCCESS;
    }
}
