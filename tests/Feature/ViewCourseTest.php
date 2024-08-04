<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewCourseTest extends AuthTestCase
{
    use RefreshDatabase;

    public function test_course_view()
    {
        UsageLog::factory()->create();

        $response = $this->actingAs($this->subscribed_user)->get('/courses');

        $response->assertStatus(200);
    }

    public function test_course_usage_tracking()
    {
        $log = UsageLog::factory()->create();

        $this->actingAs($this->subscribed_user)->get('/courses');

        $this->actingAs($this->subscribed_user)->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'course_views' => 1,
        ]);
    }
}
