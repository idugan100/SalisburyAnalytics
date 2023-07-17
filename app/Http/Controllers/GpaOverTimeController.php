<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\services\TrackUsage;
use App\Charts\GpaOverTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GpaOverTimeController extends Controller
{
    public function index(Request $request, GpaOverTime $chart){

        TrackUsage::log($request,"report");

        $departments=Course::select("departmentCode")->distinct()->orderBy("departmentCode","asc")->get();
        $selected_department=$request->Department;
        $query=
            "Select sum(T.GPA)/sum(T.quantity) as 'GPA', semester, `year` from
                (Select  quantity, `year`, semester,
                        CASE 
                        WHEN grade='A' THEN 4 
                        WHEN grade='B' THEN 3 
                        WHEN grade='C' THEN 2
                        WHEN grade='D' THEN 1
                        WHEN grade='F' THEN 0
                        else 0
                        END * quantity as 'GPA'
                from courses_x_professors_with_grades
                join courses on course_ID=courses.id
                where  grade in ('A','B','C','D','F','W')
                and departmentCode like '%".$selected_department."%')as `T`
                group by
                year, semester
                order by 
                year, semester DESC;";

        $gpa_by_semester=DB::select($query);
            
      
        $gpa_chart=$chart->build($gpa_by_semester);
        
        return view("gpaOverTime.index", compact('gpa_chart', 'departments', 'selected_department'));
    }
}
