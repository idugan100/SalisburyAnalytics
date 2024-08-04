<?php

namespace Tests\Feature;

use App\Models\Professor;
use App\Models\UsageLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\AuthTestCase;

class ProfessorShowTest extends AuthTestCase
{
    use RefreshDatabase;

    public function test_show_professor_view()
    {
        UsageLog::factory()->create();

        $professor = Professor::factory()->create();

        $response = $this->actingAs($this->subscribed_user)->get(route('professors.show', $professor->id));

        $response->assertStatus(200);
    }

    public function test_show_professor_usage_tracking()
    {
        $log = UsageLog::factory()->create();

        $professor = Professor::factory()->create();

        $this->actingAs($this->subscribed_user)->get(route('professors.show', $professor->id));

        $this->assertDatabaseHas('usage_log', [
            'created_at' => $log->created_at,
            'professor_views' => 1,
        ]);
    }
}
