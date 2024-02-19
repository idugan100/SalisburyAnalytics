<?php

namespace App\Console\Commands;

use App\Services\StudentDemographicsManager;
use Illuminate\Console\Command;

class ImportStudentDemographicInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:student-demographic-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update student demographic information from the Department of Education api';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $student_demographic_manager = new StudentDemographicsManager();
        $student_demographic_manager->import();
        if ($student_demographic_manager->is_error) {
            $this->error($student_demographic_manager->error_message);

            return Command::FAILURE;
        } else {
            $this->info(now().': import successful');

            return Command::SUCCESS;
        }
    }
}
