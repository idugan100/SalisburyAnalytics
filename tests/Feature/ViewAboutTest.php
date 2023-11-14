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

        $response = $this->get('/about');

        $this->assertSame(1, UsageLog::where('created_at', now())->first()->about_views);
    }
}
