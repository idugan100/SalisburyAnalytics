<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use App\Models\Professor;
use App\services\TrackUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
    const PROCESSING_FLAG=0;
    const APPROVED_FLAG=1;
    const REJECTED_FLAG=2;

    public function __construct(){
        $this->middleware('auth', ['except' => ['index','create','store']]);
        $this->middleware(EnsureIsAdmin::class,["only"=>["destroy"]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        TrackUsage::log($request,"review");

        $reviews=Review::where('approved_flag',1)->latest()->get();
        return (view('reviews.index',["reviews"=>$reviews]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        TrackUsage::log($request,"review");
        
        $courseList=DB::table('courses')
            ->select("departmentCode","id", "courseNumber")
            ->orderBy("departmentCode",'asc')
            ->orderBY("courseNumber","asc")
            ->get();
        $professorList=DB::table('professors')
            ->select('id','firstName','lastName')
            ->orderBy("lastName","asc")
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
            'response'=>'required',
            'courseID'=>'required',
            'professorID'=>'required'
        ]);
        
        $review = new Review;
        $review->course_id=$validated['courseID'];
        $review->professor_id=$validated['professorID'];
        $review->response=$validated['response'];
        $review->approved_flag=self::PROCESSING_FLAG;
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

    public function approve(Review $review)
    {
        $review->approved_flag=self::APPROVED_FLAG;
        $review->save();
        return redirect(route("reviews.processing"));
    }
    public function reject(Review $review)
    {
        $review->approved_flag=self::REJECTED_FLAG;
        $review->save();
        return redirect(route("reviews.processing"));
    }
    public function reprocess(Review $review, $origin){
        $review->approved_flag=self::PROCESSING_FLAG;
        $review->save();
        if($origin=="rejected"){
            return redirect(route('reviews.rejected'));
        }
        return redirect(route('reviews.approved'));

    }
    public function rejected(){
        $reviews=Review::where('approved_flag',self::REJECTED_FLAG)->latest('updated_at')->paginate(10);
        return view("rejected_reviews", compact('reviews'));
    }
    public function approved(){
        $reviews=Review::where('approved_flag',self::APPROVED_FLAG)->latest('updated_at')->paginate(10);
        return view("approved", compact('reviews'));
    }
    public function processing(){
        $reviews=Review::where('approved_flag',self::PROCESSING_FLAG)->latest('updated_at')->paginate(10);
        return view('processing', compact('reviews'));
    }
}
