<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use App\Models\Professor;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

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
        $reviews=Review::latest()->get();
        return (view('reviews.index',["reviews"=>$reviews]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courseList=DB::table('courses')
            ->select("departmentCode","id", "courseNumber")
            ->groupByRaw("departmentCode, courseNumber")
            ->get();
        $professorList=DB::table('professors')
            ->select('id','firstName','lastName')
            ->get();
        return view("reviews.create",['professorList'=>$professorList,'courseList'=>$courseList]);
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
            'courseID'=>'required',
            'professorID'=>'required'
        ]);
        
        $review = new Review;
        $review->course_id=$validated['courseID'];
        $review->professor_id=$validated['professorID'];
        $review->question=$validated['question'];
        $review->response=$validated['response'];
        $review->save();
        return redirect(route("reviews.index"));
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
