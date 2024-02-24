<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewProfessorsTest extends TestCase
{
    use RefreshDatabase;

    public function test_professor_view()
    {
        UsageLog::factory()->create();

        $response = $this->get('/professors');

        $response->assertStatus(200);
    }

    public function test_professor_usage_tracking()
    {
        $log=UsageLog::factory()->create();

        $this->get('/professors');

        $this->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'professor_views' => 1,
        ]);
    }
}
