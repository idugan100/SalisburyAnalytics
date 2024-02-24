<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PremiumPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_premium_view(): void
    {
        UsageLog::factory()->create();

        $response = $this->get('/premium');

        $response->assertStatus(200);
    }

    public function test_about_usage_tracking()
    {
        $log=UsageLog::factory()->create();

        $this->get('/premium');

        $this->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'about_views' => 1,
        ]);
    }
}
