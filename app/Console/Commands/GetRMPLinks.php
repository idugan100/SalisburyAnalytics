<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\services\RmpLinkPopulationGoogleService;
use App\services\RmpLinkPopulationSerpService;


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
        $professors = Professor::all();
        $bar = $this->output->createProgressBar(count($professors));
        $provider=$this->choice(
            'What search API would you like to use?',
            ['Google', 'Serp'],
        );
        if($provider=="Serp"){
            $response = new RmpLinkPopulationSerpService();
            foreach($professors as $professor){
                $response->getLinks($professor);
                $bar->advance();
            }
            
           
        }
        elseif($provdier=="Google"){
            $response = new RmpLinkPopulationGoogleService();
            foreach($professors as $professor){
                $response->getLinks($professor);
                $bar->advance();
            }
        }
        $bar->finish();
        $this->newline();
        $this->info("RMP Links Successfully Scraped!");
        return Command::SUCCESS;
    }
        
        
}

