<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_course_view()
    {
        UsageLog::factory()->create();

        Course::factory()->create();

        $response = $this->get(route('courses.show', 1));

        $response->assertStatus(200);
    }

    public function test_show_course_usage_tracking()
    {
        UsageLog::factory()->create();

        Course::factory()->create();

        $this->get(route('courses.show', 2));

        $this->assertDatabaseHas('usage_log', [
            'created_at' => now()->toDateTimeString(),
            'course_views' => 1,
        ]);
    }
}
