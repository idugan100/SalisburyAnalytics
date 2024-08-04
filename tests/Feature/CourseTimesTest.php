<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseTimesTest extends AuthTestCase
{
    use RefreshDatabase;

    public function test_course_times_view(): void
    {
        UsageLog::factory()->create();

        $course = Course::factory()->create();

        $response = $this->actingAs($this->subscribed_user)->get(route('courses.times', $course->id));

        $response->assertStatus(200);
    }

    public function test_course_times_usage_tracking(): void
    {
        $log = UsageLog::factory()->create();

        $course = Course::factory()->create();

        $this->actingAs($this->subscribed_user)->get(route('courses.times', $course->id));

        $this->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'course_views' => 1,
        ]);
    }
}
