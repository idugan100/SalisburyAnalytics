<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Professor;
use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CalculateProfessorStatsTest extends TestCase
{
    use RefreshDatabase;

    public function test_calculate_professor_stats_command_exits_correctly(): void
    {
        $professor = Professor::factory()->create();
        $course1 = Course::factory()->create();
        $course2 = Course::factory()->create();

        DB::table('courses_x_professors_with_grades')->insert([
            ['semester' => 'Fall', 'professor_ID' => $professor->id, 'course_ID' => $course1->id, 'quantity' => 1, 'grade' => 'A', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor->id, 'course_ID' => $course1->id, 'quantity' => 2, 'grade' => 'B', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor->id, 'course_ID' => $course1->id, 'quantity' => 1, 'grade' => 'C', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor->id, 'course_ID' => $course1->id, 'quantity' => 1, 'grade' => 'D', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor->id, 'course_ID' => $course2->id, 'quantity' => 2, 'grade' => 'A', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor->id, 'course_ID' => $course2->id, 'quantity' => 1, 'grade' => 'B', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor->id, 'course_ID' => $course2->id, 'quantity' => 1, 'grade' => 'C', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor->id, 'course_ID' => $course2->id, 'quantity' => 1, 'grade' => 'F', 'year' => 2023],

        ]);
        $this->artisan('populate:professor-stats')
            ->expectsOutputToContain('Professor stats successfully calculated in ')
            ->assertExitCode(Command::SUCCESS);
    }

    public function test_calculate_professor_stats_function_calculates_correctly(): void
    {
        $professor = Professor::factory()->create();
        $course1 = Course::factory()->create();
        $course2 = Course::factory()->create();

        DB::table('courses_x_professors_with_grades')->insert([
            ['semester' => 'Fall', 'professor_ID' => $professor->id, 'course_ID' => $course1->id, 'quantity' => 1, 'grade' => 'A', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor->id, 'course_ID' => $course1->id, 'quantity' => 2, 'grade' => 'B', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor->id, 'course_ID' => $course1->id, 'quantity' => 1, 'grade' => 'C', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor->id, 'course_ID' => $course1->id, 'quantity' => 1, 'grade' => 'D', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor->id, 'course_ID' => $course2->id, 'quantity' => 2, 'grade' => 'A', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor->id, 'course_ID' => $course2->id, 'quantity' => 1, 'grade' => 'B', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor->id, 'course_ID' => $course2->id, 'quantity' => 1, 'grade' => 'C', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor->id, 'course_ID' => $course2->id, 'quantity' => 1, 'grade' => 'F', 'year' => 2023],

        ]);
        $professor->calculate_statistics();
        $this->assertDatabaseHas('professors',
            ['id' => $professor->id, 'total_enrollment' => 10, 'A_rate' => 30, 'B_rate' => 30, 'C_rate' => 20, 'D_rate' => 10, 'F_rate' => 10, 'W_rate' => 0, 'avg_gpa' => 2.60]
        );
    }
}
