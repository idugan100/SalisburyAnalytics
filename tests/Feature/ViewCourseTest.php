<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewCourseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_course_view()
    {
        UsageLog::factory()->create();

        $response = $this->get('/courses');

        $response->assertStatus(200);
    }

    public function test_course_usage_tracking()
    {
        UsageLog::factory()->create();

        $response = $this->get('/courses');

        $this->assertSame(1, UsageLog::where('created_at', now())->first()->course_views);
    }
}
