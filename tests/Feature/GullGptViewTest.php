<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GullGptViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_gullgpt_view(): void
    {
        UsageLog::factory()->create();

        $response = $this->get('/gullGPT');

        $response->assertStatus(200);

    }

    public function test_gullgpt_usage_tracking()
    {
        UsageLog::factory()->create();

        $this->get('/gullGPT');

        $this->assertDatabaseHas('usage_log', [
            'created_at' => now()->toDateTimeString(),
            'about_views' => 1,
        ]);
    }
}
