<?php

namespace Tests\Feature;

use App\Models\Professor;
use App\Models\UsageLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfessorShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_professor_view()
    {
        UsageLog::factory()->create();

        Professor::factory()->create();

        $response = $this->get(route('professors.show', 1));

        $response->assertStatus(200);
    }
    
    public function test_show_professor_usage_tracking()
    {
        UsageLog::factory()->create();

        Professor::factory()->create();

        $this->get(route('professors.show', 2));

        $this->assertSame(1, UsageLog::where('created_at', now())->first()->professor_views);
    }

}
