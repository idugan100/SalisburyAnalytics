<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Charts\GpaOverTime;

class GpaOverTimeController extends Controller
{
    public function index(Request $request, GpaOverTime $chart){
        $gpa_by_semester=DB::select("Select sum(T.GPA)/sum(T.quantity) as 'GPA', semester, `year` from
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
            where  grade in ('A','B','C','D','F','W'))as `T`
            group by
            year, semester
            order by 
            year, semester DESC;");
      
        $gpa_chart=$chart->build($gpa_by_semester);
        return view("gpaOverTime.index", compact('gpa_chart'));
    }
}
