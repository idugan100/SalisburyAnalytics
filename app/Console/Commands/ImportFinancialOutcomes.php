<?php

namespace App\Console\Commands;

use App\Services\FinancialOutcomesManager;
use Illuminate\Console\Command;

class ImportFinancialOutcomes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:financial-outcomes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import program specific graduate financial information';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $financial_outcomes_manager = new FinancialOutcomesManager();
        $financial_outcomes_manager->import();
        if ($financial_outcomes_manager->is_error) {
            $this->error($financial_outcomes_manager->error_message);

            return Command::FAILURE;
        } else {
            $this->info(now().': financial outcomes import successfully ingested ' . $financial_outcomes_manager->ingested_count. " out of " . $financial_outcomes_manager->api_count);

            return Command::SUCCESS;
        }
    }
}
