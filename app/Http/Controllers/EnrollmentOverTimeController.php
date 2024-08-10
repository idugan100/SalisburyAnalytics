<?php

namespace App\Http\Controllers;

use App\Charts\EnrollmentOverTime;
use App\Models\Course;
use App\Services\TrackUsage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class EnrollmentOverTimeController extends Controller
{
    public function index(Request $request, EnrollmentOverTime $chart): View
    {

        TrackUsage::log($request, 'report');
        $request->flash();

        $departments = Course::select('departmentCode')->distinct()->orderBy('departmentCode', 'asc')->get();
        $selected_department = $request->Department;

        $query =
            "Select sum(quantity) as 'Enrollment', semester, `year` from
            (Select  quantity, `year`, semester,
                    CASE
                        WHEN semester='Spring' THEN 1
                        WHEN semester='Summer' THEN 2
                        WHEN semester='Fall' THEN 3
                        END as semester_sort
            from courses_x_professors_with_grades
            join courses on course_ID=courses.id
            where  departmentCode like ?)as `T`
            group by
            year, semester
            order by 
            year, semester_sort;";
        $cache_key = 'enrollment_by_semester:'.$request->Department;
        $enrollment_by_semester = [];

        if (Cache::has($cache_key)) {
            $enrollment_by_semester = Cache::get($cache_key);
        } else {
            $enrollment_by_semester = DB::select($query, [($selected_department ?? '%')]);
            Cache::add($cache_key, $enrollment_by_semester, now()->addHours(24));
        }

        $enrollment_chart = $chart->build($enrollment_by_semester);

        return view('enrollmentOverTime.index', compact('enrollment_chart', 'departments'));
    }
}
