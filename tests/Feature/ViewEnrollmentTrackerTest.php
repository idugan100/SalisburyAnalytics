<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewEnrollmentTrackerTest extends TestCase
{
    use RefreshDatabase;

    public function test_enrollment_tracker_view()
    {
        UsageLog::factory()->create();

        $response = $this->get(route('enrollment'));

        $response->assertStatus(200);
    }

    public function test_show_course_usage_tracking()
    {
        $log = UsageLog::factory()->create();

        $this->get(route('enrollment'));

        $this->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'report_views' => 1,
        ]);
    }
}
