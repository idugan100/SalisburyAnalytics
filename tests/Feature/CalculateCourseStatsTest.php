<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Professor;
use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CalculateCourseStatsTest extends TestCase
{
    use RefreshDatabase;

    public function test_calculate_professor_stats_command_exits_correctly(): void
    {
        $professor1 = Professor::factory()->create();
        $professor2 = Professor::factory()->create();
        $course = Course::factory()->create();

        DB::table('courses_x_professors_with_grades')->insert([
            ['semester' => 'Fall', 'professor_ID' => $professor1->id, 'course_ID' => $course->id, 'quantity' => 1, 'grade' => 'A', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor1->id, 'course_ID' => $course->id, 'quantity' => 2, 'grade' => 'B', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor1->id, 'course_ID' => $course->id, 'quantity' => 1, 'grade' => 'C', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor1->id, 'course_ID' => $course->id, 'quantity' => 1, 'grade' => 'D', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor2->id, 'course_ID' => $course->id, 'quantity' => 2, 'grade' => 'A', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor2->id, 'course_ID' => $course->id, 'quantity' => 1, 'grade' => 'B', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor2->id, 'course_ID' => $course->id, 'quantity' => 1, 'grade' => 'C', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor2->id, 'course_ID' => $course->id, 'quantity' => 1, 'grade' => 'F', 'year' => 2023],

        ]);
        $this->artisan('populate:course-stats')
            ->expectsOutputToContain('Course stats successfully calculated in ')
            ->assertExitCode(Command::SUCCESS);
    }

    public function test_calculate_professor_stats_function_calculates_correctly(): void
    {
        $professor1 = Professor::factory()->create();
        $professor2 = Professor::factory()->create();
        $course = Course::factory()->create();

        DB::table('courses_x_professors_with_grades')->insert([
            ['semester' => 'Fall', 'professor_ID' => $professor1->id, 'course_ID' => $course->id, 'quantity' => 1, 'grade' => 'A', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor1->id, 'course_ID' => $course->id, 'quantity' => 2, 'grade' => 'B', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor1->id, 'course_ID' => $course->id, 'quantity' => 1, 'grade' => 'C', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor1->id, 'course_ID' => $course->id, 'quantity' => 1, 'grade' => 'D', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor2->id, 'course_ID' => $course->id, 'quantity' => 2, 'grade' => 'A', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor2->id, 'course_ID' => $course->id, 'quantity' => 1, 'grade' => 'B', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor2->id, 'course_ID' => $course->id, 'quantity' => 1, 'grade' => 'C', 'year' => 2023],
            ['semester' => 'Fall', 'professor_ID' => $professor2->id, 'course_ID' => $course->id, 'quantity' => 1, 'grade' => 'F', 'year' => 2023],

        ]);
        $course->calculate_statistics();
        $this->assertDatabaseHas('courses',
            ['id' => $course->id, 'total_enrollment' => 10, 'A_rate' => 30, 'B_rate' => 30, 'C_rate' => 20, 'D_rate' => 10, 'F_rate' => 10, 'W_rate' => 0, 'avg_gpa' => 2.60]
        );
    }
}
