<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\AuthTestCase;

class ViewProfessorsTest extends AuthTestCase
{
    use RefreshDatabase;

    public function test_professor_view()
    {
        UsageLog::factory()->create();

        $response = $this->actingAs($this->subscribed_user)->get('/professors');

        $response->assertStatus(200);
    }

    public function test_professor_usage_tracking()
    {
        $log = UsageLog::factory()->create();

        $this->actingAs($this->subscribed_user)->get('/professors');

        $this->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'professor_views' => 1,
        ]);
    }
}
