<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PremiumPageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_premium_view(): void
    {
        UsageLog::factory()->create();

        $response = $this->get('/premium');

        $response->assertStatus(200);
    }

    public function test_about_usage_tracking()
    {
        UsageLog::factory()->create();

        $this->get('/premium');

        $this->assertDatabaseHas('usage_log', [
            'created_at' => now()->toDateTimeString(),
            'about_views' => 1,
        ]);    
    }
}
