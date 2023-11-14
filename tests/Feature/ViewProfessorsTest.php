<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewProfessorsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_professor_view()
    {
        UsageLog::factory()->create();

        $response = $this->get('/professors');

        $response->assertStatus(200);
    }

    public function test_professor_usage_tracking()
    {
        UsageLog::factory()->create();

        $response = $this->get('/professors');

        $this->assertSame(1, UsageLog::where('created_at', now())->first()->professor_views);
    }
}
