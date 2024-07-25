<?php

namespace App\Services;

use App\Models\Professor;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RmpLinkPopulationSerpService
{
    public function getLinks(Professor $professor): void
    {

        try {

            $response = Http::get('https://serpapi.com/search', [
                'q' => $professor->firstName.' '.$professor->lastName.' at '. env("UNIVERSITY_NAME").' Rate My professor',
                'engine' => 'google',
                'api_key' => env('SERP_API_KEY'),
            ]);

            $decoded_response = json_decode($response->body());

            if (! isset($decoded_response->error)) {
                $professor->rmp_link = $decoded_response->organic_results[0]->link;
                $professor->save();
                echo $professor->firstName.' '.$professor->lastName.' link found'.PHP_EOL;
            } else {
                echo $professor->firstName.' '.$professor->lastName.' Error:'.$decoded_response->error.PHP_EOL;
            }

        } catch (Exception $e) {
            Log::error($e->getMessage().'on professor id '.$professor->id);
        }

    }
}
