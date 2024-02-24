<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewAllReviewsTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_reviews_view()
    {
        UsageLog::factory()->create();

        $response = $this->get('/reviews');

        $response->assertStatus(200);
    }

    public function test_all_reviews_usage_tracking()
    {
        $log = UsageLog::factory()->create();

        $this->get('/reviews');

        $this->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'review_views' => 1,
        ]);
    }
}
