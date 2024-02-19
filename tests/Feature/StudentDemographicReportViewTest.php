<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentDemographicReportViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_demographic_view()
    {
        UsageLog::factory()->create();
        //add student demographics factory here

        $response = $this->get('/student_demographics');

        $response->assertStatus(200);
    }

    public function test_about_usage_tracking()
    {
        UsageLog::factory()->create();
        //add student demographics factory here

        $this->get('/student_demographics');

        $this->assertDatabaseHas('usage_log', [
            'created_at' => now()->toDateTimeString(),
            'report_views' => 1,
        ]);
    }
}
