<?php

namespace App\Http\Controllers;

use App\Charts\GradeDistribution;
use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Middleware\EnsureIsSubscribed;
use App\Http\Requests\StoreProfessorRequest;
use App\Http\Requests\UpdateProfessorRequest;
use App\Models\Course;
use App\Models\Professor;
use App\Models\Review;
use App\services\TrackUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfessorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'professor_options_by_department']]);
        $this->middleware(EnsureIsSubscribed::class, ['only' => ['show']]);
        $this->middleware(EnsureIsAdmin::class, ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        TrackUsage::log($request, 'professor');

        if ($request->department != null && $request->professor_id == null) {
            $professors = DB::table('courses_x_professors_with_grades')
                ->join('courses', 'course_id', 'courses.id')
                ->join('professors', 'professor_id', 'professors.id')
                ->select('professors.*')
                ->where('departmentCode', $request->department)
                ->groupBy('professor_id', 'firstName', 'lastName')
                ->orderBy('lastName', 'ASC')
                ->paginate(100);
        } elseif ($request->professor_id != null) {

            $professors = Professor::where('id', $request->professor_id)->paginate(1);
        } else {
            $professors = Professor::paginate(8);
        }

        foreach ($professors as $professor) {
            $professor->topCourses = DB::table('courses_x_professors_with_grades')
                ->join('courses', 'course_ID', 'courses.id')
                ->select('courseTitle', 'departmentCode', 'courseNumber')
                ->where('professor_ID', $professor->id)
                ->groupBy('course_ID')
                ->orderByRaw('sum(quantity) desc')
                ->limit(4)->get()->toArray();
            $professor->reviews = Review::where('professor_id', $professor->id)->where('approved_flag', ReviewController::APPROVED_FLAG)->get();
        }

        $departments = Course::select('departmentCode')->orderBy('departmentCode', 'asc')->distinct()->get()->toArray();

        $message = null;
        if ($request->department) {
            if ($request->professor_id) {
                $message = 'showing search results for '.($professors[0]->firstName.' '.$professors[0]->lastName ?? '').' ('.($request->department ?? '').')';
            } else {
                $message = 'showing search results for '.($request->department ?? '');
            }
        } elseif ($request->professor_id) {
            $message = 'showing search results for '.$professors[0]->firstName.' '.$professors[0]->lastName;
        }

        return view('professors.index',
            ['professors' => $professors,
                'departments' => $departments,
                'message' => $message]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('professors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfessorRequest $request)
    {
        $validated = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'department' => 'required',
        ]);
        Professor::create($validated);

        return redirect(route('professors.index'));

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Professor $professor, GradeDistribution $chart)
    {
        TrackUsage::log($request, 'professor');
        $request->flash();

        $query = DB::table('courses_x_professors_with_grades')
            ->selectRaw("sum(quantity) as 'total', grade")
            ->where('professor_ID', $professor->id)
            ->whereIn('grade', ['A', 'B', 'C', 'D', 'F', 'W']);
        //apply filters
        if (isset($request->selected_semester)) {

            $query = $query->whereRaw('concat(semester,year) = ? ', [$request->selected_semester]);
        }
        if (isset($request->selected_course)) {

            $query = $query->where('course_ID', $request->selected_course);
        }
        //build chart

        $grade_distribution_chart = $chart->build($query->groupBy('grade')->get()->toArray());

        //get data for options
        $semesters = DB::table('courses_x_professors_with_grades')
            ->select('semester', 'year')
            ->where('professor_ID', $professor->id)
            ->distinct()->orderBy('year')->orderBy('semester', 'desc')->get()->toArray();

        $courses = DB::table('courses_x_professors_with_grades')
            ->join('courses', 'course_ID', 'courses.id')
            ->select('departmentCode', 'courseNumber', 'courses.id')
            ->where('professor_ID', $professor->id)
            ->groupBy('course_ID')
            ->get()->toArray();

        return view('professors.show', [
            'chart' => $grade_distribution_chart,
            'courses' => $courses,
            'semesters' => $semesters,
            'professor' => $professor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Professor $professor)
    {
        return view('professors.edit', ['professor' => $professor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfessorRequest $request, Professor $professor)
    {
        $validated = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'department' => 'required',
        ]);

        $professor->update($validated);

        return redirect(route('professors.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professor $professor)
    {
        $professor->delete();

        return redirect(route('professors.index'));
    }

    public function professor_options_by_department(Request $request)
    {

        $professors = DB::table('courses_x_professors_with_grades')
            ->join('courses', 'course_id', 'courses.id')
            ->join('professors', 'professor_id', 'professors.id')
            ->select('professors.id', 'firstName', 'lastName')
            ->where('departmentCode', $request->department)
            ->groupBy('professor_id', 'firstName', 'lastName')
            ->orderBy('lastName', 'ASC')
            ->get();

        return view('professors.search-professors', compact('professors'));
    }
}
