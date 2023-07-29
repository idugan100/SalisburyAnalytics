<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\services\TrackUsage;
use App\Models\Professor;
use Illuminate\Http\Request;

use App\Charts\GradeDistribution;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreProfessorRequest;
use App\Http\Requests\UpdateProfessorRequest;

class ProfessorController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index','show']]);
    }
    
        
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        TrackUsage::log($request,"professor");

        if($request->department != null && $request->professor_id==null){
            $professors=DB::table("courses_x_professors_with_grades")
            ->join("courses","course_id","courses.id")
            ->join("professors","professor_id","professors.id")
            ->select("professors.*")
            ->where("departmentCode",$request->department)
            ->groupBy("professor_id","firstName","lastName")
            ->orderBy("lastName","ASC")
            ->paginate(100);
        }
        elseif($request->department != null && $request->professor_id!=null){

            $professors=Professor::where("id",$request->professor_id)->paginate(1);
        }
        else{
            $professors=Professor::paginate(16);
        }

        foreach($professors as $professor){
            $professor->semesters=DB::table("courses_x_professors_with_grades")
                                ->select("semester","year")
                                ->where("professor_ID",$professor->id)
                                ->distinct()->orderBy('year')->orderBy("semester","desc")->get()->toArray();
            $professor->topCourses=DB::table("courses_x_professors_with_grades")
                                        ->join("courses","course_ID","courses.id")
                                        ->select("courseTitle", "departmentCode", "courseNumber")
                                        ->where("professor_ID",$professor->id)
                                        ->groupBy("course_ID")
                                        ->orderByRaw("sum(quantity) desc")
                                        ->limit(4)->get()->toArray();
            $professor->reviews=Review::where("professor_id",$professor->id)->where("approved_flag",ReviewController::APPROVED_FLAG)->get();
                                        
            
        };
        
        return(view("professors.index",
            ["professors"=>$professors,
            "result_department"=>$request->department ?? "",
            "result_professor"=>$request->professor_id ?? ""]
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return(view('professors.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfessorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfessorRequest $request)
    {
        $validated=$request->validate([
            "firstName"=>"required",
            "lastName"=>"required",
            "department"=>"required"
        ]);
        $professor= new Professor();
        $professor->firstName=$validated['firstName'];
        $professor->lastName=$validated['lastName'];
        $professor->department=$validated['department'];
        $professor->save();
        return redirect(route("professors.index"));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Professor $professor, GradeDistribution $chart)
    {
        TrackUsage::log($request,"professor");
        $query= DB::table("courses_x_professors_with_grades")
            ->selectRaw("sum(quantity) as 'total', grade")
            ->where("professor_ID",$professor->id)
            ->whereIn("grade",['A','B','C','D','F','W']);
        //apply filters
        if(isset($request->selected_semester)){
            
            $query = $query->whereRaw("concat(semester,year) = ? ", [$request->selected_semester]);    
        }
        if(isset($request->selected_course)){
            
            $query = $query->where("course_ID",$request->selected_course);
        }
        //build chart
        if(isset($request->selected_course) || isset($request->selected_semester)){
        
            $grade_distribution_chart=$chart->build($this->convert_query_results_to_object($query->groupBy("grade")->get()));
        }
        else{
            $grade_distribution_chart=$chart->build($professor);
        }
        //get data for options
        $semesters=DB::table("courses_x_professors_with_grades")
                                ->select("semester","year")
                                ->where("professor_ID",$professor->id)
                                ->distinct()->orderBy('year')->orderBy("semester","desc")->get()->toArray();

        $courses=DB::table("courses_x_professors_with_grades")
                                ->join("courses","course_ID","courses.id")
                                ->select("departmentCode", "courseNumber","courses.id")
                                ->where("professor_ID",$professor->id)
                                ->groupBy("course_ID")
                                ->get()->toArray();

        return view('professors.show',[
                                    "prev_semester"=>($request->selected_semester ?? ""),
                                    "prev_course"=>($request->selected_course ?? ""),
                                    "chart"=>$grade_distribution_chart,
                                    "courses"=>$courses,
                                    "semesters"=>$semesters, 
                                    "professor"=>$professor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function edit(Professor $professor)
    {
        return(view("professors.edit",["professor"=>$professor]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfessorRequest  $request
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfessorRequest $request, Professor $professor)
    {
        $validated=$request->validate([
            'firstName'=>'required',
            'lastName'=>'required',
            'department'=>'required'
        ]);
        
        $professor->update($validated);
        $professor->department=$validated['department'];
        $professor->save();
        return redirect(route('professors.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professor $professor)
    {
        $professor->delete();
        return(redirect(route("professors.index")));
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
