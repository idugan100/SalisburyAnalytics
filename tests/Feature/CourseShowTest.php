<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\AuthTestCase;

class CourseShowTest extends AuthTestCase
{
    use RefreshDatabase;

    public function test_show_course_view_when_subscribed()
    {
        UsageLog::factory()->create();

        $course = Course::factory()->create();

        $response = $this->actingAs($this->subscribed_user)->get(route('courses.show', $course->id));

        $response->assertStatus(200);
    }

    public function test_show_course_usage_tracking()
    {
        $log = UsageLog::factory()->create();

        $course = Course::factory()->create();

        $this->actingAs($this->subscribed_user)->get(route('courses.show', $course->id));

        $this->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'course_views' => 1,
        ]);
    }
    
}
