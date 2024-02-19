<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CheckDoeEndPointTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_student_demographic_data()
    {
        $response = Http::get('https://api.data.gov/ed/collegescorecard/v1/schools.json', [
            'school.name' => 'Salisbury',
            'api_key' => env('DoE_API_KEY'),
        ]);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
