<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewAboutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_about_view()
    {
        UsageLog::factory()->create();

        $response = $this->get('/about');

        $response->assertStatus(200);
    }

    public function test_about_usage_tracking()
    {
        UsageLog::factory()->create();

        $this->get('/about');

        $this->assertDatabaseHas('usage_log', [
            'created_at' => now()->toDateTimeString(),
            'about_views' => 1,
        ]);    }
}
