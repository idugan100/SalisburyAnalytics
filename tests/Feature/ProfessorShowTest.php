<?php

namespace Tests\Feature;

use App\Models\Professor;
use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfessorShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_professor_view()
    {
        UsageLog::factory()->create();

        $professor = Professor::factory()->create();

        $response = $this->get(route('professors.show', $professor->id));

        $response->assertStatus(200);
    }

    public function test_show_professor_usage_tracking()
    {
        UsageLog::factory()->create();

        $professor = Professor::factory()->create();

        $this->get(route('professors.show', $professor->id));

        $this->assertDatabaseHas('usage_log', [
            'created_at' => now()->toDateTimeString(),
            'professor_views' => 1,
        ]);
    }
}
