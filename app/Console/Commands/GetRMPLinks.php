<?php

namespace App\Console\Commands;

use App\Models\Professor;
use Illuminate\Console\Command;
use App\services\RmpLinkPopulationSerpService;
use App\services\RmpLinkPopulationGoogleService;


class GetRMPLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:rmp-links';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Repopulates Rate my Professor links using either Google Scraping or SerpAPI';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $professors = Professor::where("rmp_link","")->get();
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
        elseif($provider=="Google"){
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

