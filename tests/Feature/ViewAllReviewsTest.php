<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewAllReviewsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_all_reviews_view()
    {
        UsageLog::factory()->create();

        $response = $this->get('/reviews');

        $response->assertStatus(200);
    }

    public function test_all_reviews_usage_tracking()
    {
        UsageLog::factory()->create();

        $response = $this->get('/reviews');

        $this->assertSame(1, UsageLog::where('created_at', now())->first()->review_views);
    }
}
