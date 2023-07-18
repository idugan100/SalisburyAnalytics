<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\services\TrackUsage;
use Illuminate\Http\Request;
use App\Charts\EnrollmentOverTime;
use Illuminate\Support\Facades\DB;

class EnrollmentOverTimeController extends Controller
{
    public function index(Request $request, EnrollmentOverTime $chart){

        TrackUsage::log($request,"report");

        $departments=Course::select("departmentCode")->distinct()->orderBy("departmentCode","asc")->get();
        $selected_department=$request->Department;
        $query=
            "Select sum(quantity) as 'Enrollment', semester, `year` from
            (Select  quantity, `year`, semester
            from courses_x_professors_with_grades
            join courses on course_ID=courses.id
            where  departmentCode like '%%".$selected_department."%%')as `T`
            group by
            year, semester
            order by 
            year, semester DESC;";
                

        $enrollment_by_semester=DB::select($query);
            
      
        $enrollment_chart=$chart->build($enrollment_by_semester);

        return view("enrollmentOverTime.index", compact('enrollment_chart', 'departments', 'selected_department'));
    }
}
