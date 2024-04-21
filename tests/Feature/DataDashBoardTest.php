<?php

namespace Tests\Feature;

use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class DataDashBoardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_get_data_dashboard_page(): void
    {
        UsageLog::factory()->create();

        $response = $this->get(route('data_dashboard'));

        $response->assertStatus(200);
    }

    public function test_get_data_dashboard_source(): void
    {
        $response = Http::get('https://www.usmd.edu/IRIS/?view=SU');

        $this->assertEquals(200, $response->status());
    }

    public function test_show_data_dashboard_tracking()
    {
        $log = UsageLog::factory()->create();

        $this->get(route('data_dashboard'));

        $this->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'report_views' => 1,
        ]);
    }
}
