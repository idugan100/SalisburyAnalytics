<?php

namespace App\Http\Controllers;

use App\Charts\GpaOverTime;
use App\Models\Course;
use App\Services\TrackUsage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class GpaOverTimeController extends Controller
{
    public function index(Request $request, GpaOverTime $chart): View
    {

        TrackUsage::log($request, 'report');
        $request->flash();

        $departments = Course::select('departmentCode')->distinct()->orderBy('departmentCode', 'asc')->get();
        $selected_department = $request->Department;
        $query =
            "Select sum(T.GPA)/sum(T.quantity) as 'GPA', semester, `year` from
                (Select  quantity, `year`, semester,
                        CASE 
                        WHEN grade='A' THEN 4
                        WHEN grade='A-' THEN 3.7
                        WHEN grade='B+' THEN 3.4
                        WHEN grade='B' THEN 3 
                        WHEN grade='B-' THEN 2.7
                        WHEN grade='C+' THEN 2.4
                        WHEN grade='C' THEN 2
                        WHEN grade='C-' THEN 1.7
                        WHEN grade='D+' THEN 1.4
                        WHEN grade='D' THEN 1
                        WHEN grade='D-' THEN .7
                        WHEN grade='E' THEN 0
                        WHEN grade='UW' THEN 0
                        END * quantity as 'GPA',
                        CASE
                        WHEN semester='Spring' THEN 1
                        WHEN semester='Summer' THEN 2
                        WHEN semester='Fall' THEN 3
                        END as semester_sort
                from courses_x_professors_with_grades
                join courses on course_ID=courses.id
                where  grade in ('A','A-','B+','B','B-','C+','C','C-','D+','D','D-','E','UW')
                and departmentCode like ? )as `T`
                group by
                year, semester
                order by 
                year, semester_sort;";

        $cache_key = 'gpa_by_semester:'.$request->Department;
        $gpa_by_semester = [];

        if (Cache::has($cache_key)) {
            $gpa_by_semester = Cache::get($cache_key);
        } else {
            $gpa_by_semester = DB::select($query, [($selected_department ?? '%')]);
            Cache::add($cache_key, $gpa_by_semester, now()->addHours(24));
        }

        $gpa_chart = $chart->build($gpa_by_semester, $selected_department);

        return view('gpaOverTime.index', compact('gpa_chart', 'departments'));
    }
}
