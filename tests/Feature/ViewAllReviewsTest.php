<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\AuthTestCase;

class ViewAllReviewsTest extends AuthTestCase
{
    use RefreshDatabase;

    public function test_all_reviews_view()
    {
        UsageLog::factory()->create();

        $response = $this->actingAs($this->subscribed_user)->get('/reviews');

        $response->assertStatus(200);
    }

    public function test_all_reviews_usage_tracking()
    {
        $log = UsageLog::factory()->create();

        $this->actingAs($this->subscribed_user)->get('/reviews');

        $this->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'review_views' => 1,
        ]);
    }
}
