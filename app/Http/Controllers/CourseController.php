<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use App\services\TrackUsage;
use Illuminate\Http\Request;
use App\Charts\GradeDistribution;
use Illuminate\Support\Facades\DB;



use App\Http\Requests\StoreCourseRequest;
use App\Http\Controllers\ReviewController;
use App\Http\Requests\UpdateCourseRequest;

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
        TrackUsage::log($request,"course");

        if($request->department != null && $request->courseNumber==null){
            $courses=Course::where("departmentCode", $request->department)->paginate(100);
        }
        elseif($request->department != null && $request->courseNumber!=null){
            $courses=Course::where("courseNumber", $request->courseNumber)->where("departmentCode", $request->department)->paginate(100);
        }
        else{
            $courses=Course::paginate(16);
        }

        foreach($courses as $course){
            $course->reviews=Review::where("course_id",$course->id)->where("approved_flag",ReviewController::APPROVED_FLAG)->get();
            $course->total_enrollment=DB::table("courses_x_professors_with_grades")
                                        ->selectRaw("sum(quantity) as total")
                                        ->where("course_ID",$course->id)
                                        ->whereIn("grade",['A','B','C','D','F','W'])
                                        ->first()->total;
        }

        return view('courses.index',[
            'courses'=>$courses,
            'result_department'=>$request->department ?? "",
            'result_courseNumber'=>$request->courseNumber ?? ""
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
    public function show(Request $request, Course $course, GradeDistribution $chart)
    {        
        TrackUsage::log($request,"course");

        $query= DB::table("courses_x_professors_with_grades")
                ->selectRaw("sum(quantity) as 'total', grade")
                ->where("course_ID",$course->id)
                ->whereIn("grade",['A','B','C','D','F','W']);
        //apply filters
        if(isset($request->selected_semester)){
            
            $query = $query->whereRaw("concat(semester,year) = ? ", [$request->selected_semester]);    
        }
        if(isset($request->selected_professor)){
            
            $query = $query->where("professor_ID",$request->selected_professor);
        }
        //build chart

           
           $grade_distribution_chart=$chart->build($query->groupBy("grade")->get());

        //get data for options
        $semesters=DB::table("courses_x_professors_with_grades")
                                ->select("semester","year")
                                ->where("course_ID",$course->id)
                                ->distinct()->orderBy('year')->orderBy("semester","desc")->get()->toArray();

        $professors=DB::table("courses_x_professors_with_grades")
                                ->join("professors","professor_ID","professors.id")
                                ->select("firstName", "lastName","professors.id")
                                ->where("course_ID",$course->id)
                                ->groupBy("professor_ID")
                                ->get()->toArray();

        return view('courses.show',[
                                    "prev_semester"=>($request->selected_semester ?? ""),
                                    "prev_professor"=>($request->selected_professor ?? ""),
                                    "chart"=>$grade_distribution_chart,
                                    "professors"=>$professors,
                                    "semesters"=>$semesters, 
                                    "course"=>$course]);
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
