<?php
namespace App\services;
use Illuminate\Support\Facades\Http;

class RmpLinkPopulationService

{
    public function getLinks(){
        $response = Http::get('https://www.googleapis.com/customsearch/v1/siterestrict', [
            'key' => env("GOOGLE_CUSTOM_SEARCH_KEY"),
            'cx' =>env("GOOGLE_CUSTOM_SEARCH_ENGINE_ID"),
            'q' => "Enyue Lu Salisbury University"
        ]);
        dd($response->body());
    }
    
}