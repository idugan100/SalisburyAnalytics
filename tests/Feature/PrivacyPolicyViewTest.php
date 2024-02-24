<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
        $log=UsageLog::factory()->create();

        $this->get('/privacy');

        $this->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'about_views' => 1,
        ]);
    }
}
