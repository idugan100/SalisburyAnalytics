<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewAddReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_review_view()
    {
        UsageLog::factory()->create();

        $response = $this->get('/reviews/create');

        $response->assertStatus(200);
    }

    public function test_create_review_usage_tracking()
    {
        $log=UsageLog::factory()->create();

        $this->get('/reviews/create');

        $this->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'review_views' => 1,
        ]);
    }
}
