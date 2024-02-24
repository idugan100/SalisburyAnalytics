<?php

namespace Tests\Feature;

use App\Models\StudentDemographicInfo;
use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentDemographicReportViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_demographic_view()
    {
        UsageLog::factory()->create();
        StudentDemographicInfo::factory()->create();

        $response = $this->get('/student_demographics');

        $response->assertStatus(200);
    }

    public function test_about_usage_tracking()
    {
        $log=UsageLog::factory()->create();
        StudentDemographicInfo::factory()->create();

        $this->get('/student_demographics');

        $this->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'report_views' => 1,
        ]);
    }
}
