<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Course;
use App\Models\UsageLog;
use App\Models\Professor;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseShowTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_no_params()
    {
        $this->add_data();
        
        $response = $this->get(route("courses.show",3));

        $response->assertStatus(200);
    }

    private function add_data(){
        $usage_log= new UsageLog();
        $usage_log->save();
        
        $course= new Course();
        $course->courseNumber=201;
        $course->id=3;
        $course->departmentCode="ACCT";
        $course->courseTitle="Cost Accounting I";
        $course->description="Emphasizes the use of accounting information for budgeting, planning and control, and decision making. Topics include integrated budgeting, variance analysis, job-order costing, activity-based costing, relevant costs for decision making, etc.";
        $course->avg_GPA=3.12;
        $course->save();

    }
}
