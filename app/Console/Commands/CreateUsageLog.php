<?php

namespace App\Console\Commands;

use App\Models\UsageLog;
use Illuminate\Console\Command;

class CreateUsageLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-usage-log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new usage log entry for use in dev enviroment';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $usage_log= new UsageLog();
        $result=$usage_log->save();

        if(!$result){
            $this->error("Error when creating Usage Log!");
            return Command::FAILURE;
        }
        
        $this->info("Usage Log Sucessfully Created!");
        return Command::SUCCESS;

 
    }
}
