<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConfirmStudentDemographicDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_student_demographic_data()
    {
        $response = Http::get('https://api.data.gov/ed/collegescorecard/v1/schools.json', [
            'school.name' => 'Salisbury',
            'api_key' => env('DoE_API_KEY'),
        ]);
        $this->assertEquals(200,$response->getStatusCode());
    }

    public function test_student_ethnicity_data_unchanged(){
        $response = Http::get('https://api.data.gov/ed/collegescorecard/v1/schools.json', [
            'school.name' => 'Salisbury',
            'api_key' => env('DoE_API_KEY'),
        ]);

        $body=json_decode($response->body());
        $student_enthnicity=$body->results[0]->latest->student->demographics->race_ethnicity;

        $this->assertEquals(.0054,$student_enthnicity->aian);
        $this->assertEquals(.0009,$student_enthnicity->nhpi);
        $this->assertEquals(.0397,$student_enthnicity->asian);
        $this->assertEquals(.1263,$student_enthnicity->black);
        $this->assertEquals(.7066,$student_enthnicity->white);
        $this->assertEquals(.0609,$student_enthnicity->hispanic);
        $this->assertEquals(.0279,$student_enthnicity->two_or_more);
        $this->assertEquals(.0229,$student_enthnicity->unknown);
    }

}
