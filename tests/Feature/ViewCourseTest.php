<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewCourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_course_view()
    {
        UsageLog::factory()->create();

        $response = $this->get('/courses');

        $response->assertStatus(200);
    }

    public function test_course_usage_tracking()
    {
        $log = UsageLog::factory()->create();

        $this->get('/courses');

        $this->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'course_views' => 1,
        ]);
    }
}
