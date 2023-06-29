<?php
namespace App\services;
use Illuminate\Support\Facades\Http;
use App\Models\Professor;
use Exception;


class RmpLinkPopulationSerpService

{
    public function getLinks($professor){

            try{

                $response = Http::get('https://serpapi.com/search', [ 
                    'q' => $professor->firstName . " " . $professor->lastName." at Salisbury University Rate My professor",
                    "engine"=>"google",
                    'api_key' => env("SERP_API_KEY")
                ]);

                $decoded_response = json_decode($response->body());
                
                if(!isset($decoded_response->error)){
                    $professor->rmp_link=$decoded_response->organic_results[0]->link;
                    $professor->save();
                    echo( $professor->firstName . " " . $professor->lastName . " link found" . PHP_EOL);
                }
                else{
                    echo( $professor->firstName . " " . $professor->lastName . " Error:" . $decoded_response->error . PHP_EOL);
                }

            }catch(Exception $e){
               dd($e->getMessage(),$professor,$decoded_response->error);
            }
            

    }

}