<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Professor;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Auth\Events\Validated;

class ReviewController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews=Review::all();
        return (view('reviews.index',["reviews"=>$reviews]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("reviews.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(StoreReviewRequest $request)
    {
        //validation
        $validated=$request->validate([
            'question'=>'required',
            'response'=>'required',
            'departmentCode'=>'regex:/.*-.*/',
            'professorName'=>'regex:/[a-zA-Z] [a-zA-Z]/'
        ]);
        $professorID=$this->getProfessorId($validated['professorName']);
        $courseID=$this->getCourseId($validated['departmentCode']);
        $review = new Review;
        $review->course_id=$courseID;
        $review->professor_id=$professorID;
        $review->question=$validated['question'];
        $review->response=$validated['response'];
        $review->save();
        return redirect(route("reviews.index"));
    }

    private function getProfessorId($professorName)
    {
        $explodedName=explode(" ",$professorName);
        //checks on $exploded name
        $professor=Professor::where("firstName",$explodedName[0])
            ->where("lastName",$explodedName[1])
            ->get();
        return $professor[0]->id;
    }
    private function getCourseId($courseCode)
    {
        $explodedCourse=explode("-",$courseCode);
        //checks on $exploded course code
        $course=Course::where("departmentCode",$explodedCourse[0])
            ->where("courseNumber",$explodedCourse[1])
            ->get();
        return $course[0]->id;
        
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return back();
    }
}
