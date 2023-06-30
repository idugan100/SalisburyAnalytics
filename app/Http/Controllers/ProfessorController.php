<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\StoreProfessorRequest;
use App\Http\Requests\UpdateProfessorRequest;
use App\Charts\GradeDistribution;

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
    public function index(Request $request, GradeDistribution $chart)
    {   
        $validated=$request->validate([
            "search"=>['nullable','regex:/[a-zA-Z]+[a-zA-Z]*/']
        ]);

        $professors=Professor::filter($validated)->orderBy('lastName')->paginate(16);
        foreach($professors as $professor){
            $professor->chart=$chart->build($professor);
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
                                        
            
        };
        $search_term= $request->search ?? null;
        
        return(view("professors.index",["professors"=>$professors,"search"=>$search_term]));
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
    public function show(Professor $professor)
    {
        $reviews=$professor->reviews()->where('approved_flag',ReviewController::APPROVED_FLAG)->get();
        return view('professors.show',compact('professor','reviews'));
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

}
