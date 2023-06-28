<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\services\RmpLinkPopulationService;

class GetRMPLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GetRMPLinks';

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
        $response = new RmpLinkPopulationService();
        $response->getLinks();
        return Command::SUCCESS;
    }
}
