<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\UsageLog;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewAddReviewTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_all_reviews_view()
    {
        $usage_log= new UsageLog();
        $usage_log->save();
        $response = $this->get('/reviews/create');

        $response->assertStatus(200);
    }

    public function test_gpa_tracker_usage_tracking()
    {
        $usage_log= new UsageLog();
        $usage_log->save();
        $response = $this->get('/reviews/create');


        $this->assertSame(1,UsageLog::where("created_at",now())->first()->review_views);
    }
}
