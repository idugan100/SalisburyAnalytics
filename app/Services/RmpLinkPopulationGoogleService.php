<?php

namespace App\Services;

use App\Models\Professor;
use Exception;
use Illuminate\Support\Facades\Http;

class RmpLinkPopulationGoogleService
{
    public function getLinks(Professor $professor): void
    {
        $decoded_response = [];
        try {

            $response = Http::get('https://www.googleapis.com/customsearch/v1/siterestrict', [
                'key' => env('GOOGLE_CUSTOM_SEARCH_KEY'),
                'cx' => env('GOOGLE_CUSTOM_SEARCH_ENGINE_ID'),
                'q' => $professor->firstName.' '.$professor->lastName.' Salisbury University',
            ]);
            $decoded_response = json_decode($response->body());

            if ($decoded_response->searchInformation->totalResults > 0) {
                $professor->rmp_link = $decoded_response->items[0]->link;
                $professor->save();
                echo $professor->firstName.' '.$professor->lastName.' found'.PHP_EOL;
            } else {
                echo $professor->firstName.' '.$professor->lastName.' not found'.PHP_EOL;
            }
        } catch (Exception $e) {
            dd($e->getMessage(), $professor, $decoded_response);
        }

    }
}
