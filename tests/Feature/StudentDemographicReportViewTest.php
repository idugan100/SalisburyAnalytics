<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\UsageLog;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentDemographicReportViewTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_student_demographic_view()
    {
        UsageLog::factory()->create();

        $response = $this->get('/student_demographics');

        $response->assertStatus(200);
    }

    public function test_about_usage_tracking()
    {
        UsageLog::factory()->create();

        $this->get('/student_demographics');

        $this->assertDatabaseHas('usage_log', [
            'created_at' => now()->toDateTimeString(),
            'report_views' => 1,
        ]);
    }
}
