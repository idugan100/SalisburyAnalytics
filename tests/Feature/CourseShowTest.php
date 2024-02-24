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

        $course = Course::factory()->create();

        $response = $this->get(route('courses.show', $course->id));

        $response->assertStatus(200);
    }

    public function test_show_course_usage_tracking()
    {
        $log=UsageLog::factory()->create();

        $course = Course::factory()->create();

        $this->get(route('courses.show', $course->id));

        $this->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'course_views' => 1,
        ]);
    }
}
