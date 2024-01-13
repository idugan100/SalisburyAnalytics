<?php

namespace App\Http\Controllers;

use App\Charts\GradeDistribution;
use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\services\TrackUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'course_options_by_department', 'times']]);
        $this->middleware(EnsureIsAdmin::class, ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, GradeDistribution $chart)
    {
        TrackUsage::log($request, 'course');

        if ($request->department != null && $request->courseNumber == null) {
            $courses = Course::with('approved_reviews')->where('departmentCode', $request->department)->paginate(100);
        } elseif ($request->department != null && $request->courseNumber != null) {
            $courses = Course::with('approved_reviews')->where('courseNumber', $request->courseNumber)->where('departmentCode', $request->department)->paginate(100);
        } else {
            $courses = Course::with('approved_reviews')->paginate(16);
        }

        $departments = Course::select('departmentCode')->orderBy('departmentCode', 'asc')->distinct()->get()->toArray();

        $message = null;
        if ($request->department || $request->courseNumber) {
            $message = 'showing search results for '.($request->department ?? '').' '.($request->courseNumber ?? '');
        }

        return view('courses.index', [
            'courses' => $courses,
            'result_message' => $message,
            'departments' => $departments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        $validated = $request->validate([
            'courseTitle' => 'required',
            'description' => 'nullable',
            'courseNumber' => 'required',
            'departmentCode' => 'required',
            'creditsLecture' => 'nullable',
            'creditsLab' => 'nullable',
            'creditsTotal' => 'nullable',
            'syllabusLink' => 'nullable',
        ]);

        Course::create($validated);

        return redirect(route('courses.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Course $course, GradeDistribution $chart)
    {
        TrackUsage::log($request, 'course');
        $request->flash();

        $query = DB::table('courses_x_professors_with_grades')
            ->selectRaw("sum(quantity) as 'total', grade")
            ->where('course_ID', $course->id)
            ->whereIn('grade', ['A', 'B', 'C', 'D', 'F', 'W']);
        //apply filters
        if (isset($request->selected_semester)) {

            $query = $query->whereRaw('concat(semester,year) = ? ', [$request->selected_semester]);
        }
        if (isset($request->selected_professor)) {

            $query = $query->where('professor_ID', $request->selected_professor);
        }
        //build chart

        $grade_distribution_chart = $chart->build($query->groupBy('grade')->get());

        //get data for options
        $semesters = DB::table('courses_x_professors_with_grades')
            ->select('semester', 'year')
            ->where('course_ID', $course->id)
            ->distinct()->orderBy('year')->orderBy('semester', 'desc')->get()->toArray();

        $professors = DB::table('courses_x_professors_with_grades')
            ->join('professors', 'professor_ID', 'professors.id')
            ->select('firstName', 'lastName', 'professors.id')
            ->where('course_ID', $course->id)
            ->groupBy('professor_ID')
            ->get()->toArray();

        return view('courses.show', [
            'chart' => $grade_distribution_chart,
            'professors' => $professors,
            'semesters' => $semesters,
            'course' => $course]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {

        return view('courses.edit', ['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $validated = $request->validate([
            'courseTitle' => 'required',
            'description' => 'required',
            'courseNumber' => 'required',
            'departmentCode' => 'required',
            'creditsLecture' => 'nullable',
            'creditsLab' => 'nullable',
            'creditsTotal' => 'required',
            'syllabusLink' => 'nullable',
        ]);

        $course->update($validated);

        return redirect(route('courses.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect(route('courses.index'));

    }

    public function course_options_by_department(Request $request)
    {

        $courses = Course::where('departmentCode', $request->department)->orderBy('courseNumber')->get();

        return view('courses.search-courses', compact('courses'));
    }

    public function times(Request $request, Course $course)
    {
        TrackUsage::log($request, 'course');

        return view('courses.times', compact('course'));
    }
}
