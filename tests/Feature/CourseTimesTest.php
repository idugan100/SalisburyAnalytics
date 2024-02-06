<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseTimesTest extends TestCase
{
    use RefreshDatabase;

    public function test_course_times_view(): void
    {
        UsageLog::factory()->create();

        $course = Course::factory()->create();

        $response = $this->get(route('courses.times', $course->id));

        $response->assertStatus(200);
    }

    public function test_course_times_usage_tracking(): void
    {
        UsageLog::factory()->create();

        $course = Course::factory()->create();

        $this->get(route('courses.times', $course->id));

        $this->assertDatabaseHas('usage_log', [
            'created_at' => now()->toDateTimeString(),
            'course_views' => 1,
        ]);
    }
}
