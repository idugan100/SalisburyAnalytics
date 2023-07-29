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
            $course->chart=$chart->build($course);
            $course->reviews=Review::where("course_id",$course->id)->where("approved_flag",ReviewController::APPROVED_FLAG)->get();
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
        if(isset($request->selected_professor) || isset($request->selected_semester)){
           
           $grade_distribution_chart=$chart->build($this->convert_query_results_to_object($query->groupBy("grade")->get()));
        }
        else{
            $grade_distribution_chart=$chart->build($course);
        }
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

    private function convert_query_results_to_object($grade_distribution){
        $entity=(object)[];
        $entity->qty_A=0;
        $entity->qty_B=0;
        $entity->qty_C=0;
        $entity->qty_D=0;
        $entity->qty_F=0;
        $entity->qty_W=0;

        foreach($grade_distribution as $grade_total){
            switch ($grade_total->grade) {
                case 'A':
                    $entity->qty_A= (int) $grade_total->total;
                    break;
                case 'B':
                    $entity->qty_B= (int) $grade_total->total;
                    break;
                case 'C':
                    $entity->qty_C= (int) $grade_total->total;
                    break;
                case 'D':
                    $entity->qty_D= (int) $grade_total->total;
                    break;
                case 'F':
                    $entity->qty_F= (int) $grade_total->total;
                    break;
                case 'W':
                    $entity->qty_W= (int) $grade_total->total;
                    break;
            }

        }

        return $entity;
    }
}
