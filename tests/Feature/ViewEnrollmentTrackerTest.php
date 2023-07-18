<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\UsageLog;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewEnrollmentTracker extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_enrollment_tracker_view()
    {
        $usage_log= new UsageLog();
        $usage_log->save();
        $response = $this->get('/enrollment_over_time');

        $response->assertStatus(200);
    }

    public function test_enrollment_tracker_usage_tracking()
    {
        $usage_log= new UsageLog();
        $usage_log->save();
        $response = $this->get('/enrollment_over_time');


        $this->assertSame(1,UsageLog::where("created_at",now())->first()->report_views);
    }
}
