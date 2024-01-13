<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PrivacyPolicyViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_privacy_policy_view()
    {
        UsageLog::factory()->create();

        $response = $this->get('/privacy');

        $response->assertStatus(200);
    }

    public function test_privacy_policy_usage_tracking()
    {
        UsageLog::factory()->create();

            $this->get('/privacy');

        $this->assertDatabaseHas('usage_log', [
            'created_at' => now()->toDateTimeString(),
            'about_views' => 1,
        ]);
    }
}
