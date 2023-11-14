<?php

namespace App\Http\Controllers;

use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Requests\StoreReviewRequest;
use App\Models\Course;
use App\Models\Review;
use App\services\TrackUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    const PROCESSING_FLAG = 0;

    const APPROVED_FLAG = 1;

    const REJECTED_FLAG = 2;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'review_options_by_department', 'create', 'store']]);
        $this->middleware(EnsureIsAdmin::class, ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        TrackUsage::log($request, 'review');

        $reviews = Review::where('approved_flag', 1)->latest()->paginate(10);

        return view('reviews.public.index', ['reviews' => $reviews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        TrackUsage::log($request, 'review');

        $departmentList = Course::select('departmentCode')->orderBy('departmentCode', 'asc')->distinct()->get()->toArray();

        return view('reviews.public.create', ['departmentList' => $departmentList]);
    }

    public function review_options_by_department(Request $request)
    {
        $professorList = DB::table('courses_x_professors_with_grades')
            ->join('courses', 'course_id', 'courses.id')
            ->join('professors', 'professor_id', 'professors.id')
            ->select('professors.id', 'firstName', 'lastName')
            ->where('departmentCode', $request->departmentCode)
            ->groupBy('professor_id', 'firstName', 'lastName')
            ->orderBy('lastName', 'ASC')
            ->get();
        $courseList = Course::where('departmentCode', $request->departmentCode)->orderBy('courseNumber')->get();

        return view('reviews.public.create-options', compact('professorList', 'courseList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request)
    {
        //validation

        $validated = $request->validate([
            'response' => 'required',
            'courseID' => 'required',
            'professorID' => 'required',
        ]);

        $review = new Review;
        $review->course_id = $validated['courseID'];
        $review->professor_id = $validated['professorID'];
        $review->response = $validated['response'];
        $review->approved_flag = self::PROCESSING_FLAG;
        $review->save();

        return redirect(route('reviews.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return back();
    }

    public function approve(Review $review)
    {
        $review->approved_flag = self::APPROVED_FLAG;
        $review->save();

        return redirect(route('reviews.processing'));
    }

    public function reject(Review $review)
    {
        $review->approved_flag = self::REJECTED_FLAG;
        $review->save();

        return redirect(route('reviews.processing'));
    }

    public function reprocess(Review $review, $origin)
    {
        $review->approved_flag = self::PROCESSING_FLAG;
        $review->save();
        if ($origin == 'rejected') {
            return redirect(route('reviews.rejected'));
        }

        return redirect(route('reviews.approved'));

    }

    public function rejected()
    {
        $reviews = Review::where('approved_flag', self::REJECTED_FLAG)->latest('updated_at')->paginate(10);

        return view('reviews.admin.rejected_reviews', compact('reviews'));
    }

    public function approved()
    {
        $reviews = Review::where('approved_flag', self::APPROVED_FLAG)->latest('updated_at')->paginate(10);

        return view('reviews.admin.approved', compact('reviews'));
    }

    public function processing()
    {
        $reviews = Review::where('approved_flag', self::PROCESSING_FLAG)->latest('updated_at')->paginate(10);

        return view('reviews.admin.processing', compact('reviews'));
    }
}
