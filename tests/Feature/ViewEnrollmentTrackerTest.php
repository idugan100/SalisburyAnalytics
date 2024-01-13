<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewEnrollmentTrackerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_enrollment_tracker_view()
    {
        UsageLog::factory()->create();

        $response = $this->get(route('enrollment'));

        $response->assertStatus(200);
    }

    public function test_show_course_usage_tracking()
    {
        UsageLog::factory()->create();

        $this->get(route('enrollment'));

        $this->assertDatabaseHas('usage_log', [
            'created_at' => now()->toDateTimeString(),
            'report_views' => 1,
        ]);
    }
}
