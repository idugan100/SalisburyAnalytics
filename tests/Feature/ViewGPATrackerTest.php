<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewGPATrackerTest extends AuthTestCase
{
    use RefreshDatabase;

    public function test_gpa_tracker_view()
    {
        UsageLog::factory()->create();

        $response = $this->actingAs($this->subscribed_user)->get(route('gpa'));

        $response->assertStatus(200);
    }

    public function test_gpa_tracker_usage_tracking()
    {
        $log = UsageLog::factory()->create();

        $this->actingAs($this->subscribed_user)->get(route('gpa'));

        $this->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'report_views' => 1,
        ]);
    }
}
