<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewAddReviewTest extends AuthTestCase
{
    use RefreshDatabase;

    public function test_create_review_view()
    {
        UsageLog::factory()->create();

        $response = $this->actingAs($this->subscribed_user)->get('/reviews/create');

        $response->assertStatus(200);
    }

    public function test_create_review_usage_tracking()
    {
        $log = UsageLog::factory()->create();

        $this->actingAs($this->subscribed_user)->get('/reviews/create');

        $this->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'review_views' => 1,
        ]);
    }
}
