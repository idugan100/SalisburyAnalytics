<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Charts\GradeDistribution;


use App\Models\Course;

class CourseController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, GradeDistribution $chart)
    {   
        $validated=$request->validate([
            'search'=>['nullable','regex:/.*-.*/']
        ]);
        //todo logic for when $validated['search'] isn't there
        
        $courses=Course::filter($validated)->paginate(16);
        foreach($courses as $course){
            $course->chart=$chart->build($course);
            $course->semesters=DB::table("courses_x_professors_with_grades")
                                ->select("semester","year")
                                ->where("course_ID",$course->id)
                                ->distinct()->orderBy('year')->orderBy("semester","desc")->get()->toArray();
            $course->topProfessors=DB::table("courses_x_professors_with_grades")
                                    ->join("professors","professor_ID","professors.id")
                                    ->select("firstName", "lastName")
                                    ->where("course_ID",$course->id)
                                    ->groupBy("professor_ID")
                                    ->orderByRaw("sum(quantity) desc")
                                    ->limit(4)->get()->toArray();
        }

        return view('courses.index',[
            'courses'=>$courses
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
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        $validated=$request->validate([
            "courseTitle"=>"required",
            "description"=>"nullable",
            "courseNumber"=>"required",
            "departmentCode"=>"required",
            "creditsLecture"=>"nullable",
            "creditsLab"=>"nullable",
            "creditsTotal"=>"nullable",
            "syllabusLink"=>"nullable"
        ]);
        $course=new Course;
        $course->courseTitle=$validated['courseTitle'];
        $course->description=$validated['description'];
        $course->courseNumber=$validated['courseNumber'];
        $course->departmentCode=$validated['departmentCode'];
        $course->creditsLecture=$validated['creditsLecture'];
        $course->creditsLab=$validated['creditsLab'];
        $course->creditsTotal=$validated['creditsTotal'];
        $course->syllabusLink=$validated['syllabusLink'];
        $course->save();
        return redirect(route('courses.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $reviews=$course->reviews()->where('approved_flag',ReviewController::APPROVED_FLAG)->get();
        return view('courses.show',compact('course','reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        
        return view("courses.edit",['course'=>$course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $validated=$request->validate([
            "courseTitle"=>"required",
            "description"=>"required",
            "courseNumber"=>"required",
            "departmentCode"=>"required",
            "creditsLecture"=>"nullable",
            "creditsLab"=>"nullable",
            "creditsTotal"=>"required",
            "syllabusLink"=>"nullable"
        ]);
        
        $course->courseTitle=$validated['courseTitle'];
        $course->description=$validated['description'];
        $course->courseNumber=$validated['courseNumber'];
        $course->departmentCode=$validated['departmentCode'];
        $course->creditsLecture=$validated['creditsLecture'];
        $course->creditsLab=$validated['creditsLab'];
        $course->creditsTotal=$validated['creditsTotal'];
        $course->syllabusLink=$validated['syllabusLink'];
        $course->save();
        return redirect(route("courses.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect(route("courses.index"));

        
    }
}
