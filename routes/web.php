<?php

use App\services\TrackUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BillingController;
use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Controllers\UsageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\EnsureIsSubscribed;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\QueryToolController;
use App\Http\Controllers\GpaOverTimeController;
use App\Http\Controllers\EnrollmentOverTimeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/about', function (Request $request) {
    TrackUsage::log($request,"about");
    return view('about');
})->name("about");


//privacy policy
Route::get("/privacy", function(Request $request){
    TrackUsage::log($request,"about");
    return view("privacy");
})->name("privacy");


//routes for courses
Route::get('/', [CourseController::class, "index"]);
Route::resource('courses', CourseController::class);
Route::get('/course_options_by_department', [CourseController::class, "course_options_by_department"]);

//professor routes
Route::resource('professors', ProfessorController::class);
Route::get('/professor_options_by_department', [ProfessorController::class, "professor_options_by_department"]);

//review routes
Route::resource('reviews', ReviewController::class);
Route::get('/review_options_by_department', [ReviewController::class, "review_options_by_department"]);


Route::middleware(EnsureIsAdmin::class)->group(function (){
    //admin usage routes
    Route::get('/usage', [UsageController::class, 'index'])->name("usage.index");
    Route::get('/usage_details/{usagelog}', [UsageController::class,'details'])->name("usage.details");

    //admin review routes
    Route::get('/processing', [ReviewController::class, 'processing'])->name('reviews.processing');
    Route::get('/approved', [ReviewController::class, 'approved'])->name('reviews.approved');
    Route::get('/rejected', [ReviewController::class, 'rejected'])->name("reviews.rejected");
    Route::get('/reviews/approve/{review}', [ReviewController::class, 'approve'])->name('review.approve');
    Route::get('/reviews/reject/{review}', [ReviewController::class, 'reject'])->name("review.reject");
    Route::get('/reviews/reprocess/{review}/{origin}', [ReviewController::class, 'reprocess'])->name("review.reprocess");
});


//grade inflation report
Route::get("/gpa_over_time", [GpaOverTimeController::class, "index"])->name("gpa")->middleware(EnsureIsSubscribed::class);

//enrollment report
Route::get("/enrollment_over_time", [EnrollmentOverTimeController::class, "index"])->name("enrollment")->middleware(EnsureIsSubscribed::class);

//query tool
Route::get("/query_tool", [QueryToolController::class, "index"])->name("qtool")->middleware(EnsureIsSubscribed::class);


//stripe
Route::get('/billing-portal', [BillingController::class, "billing_portal"])->middleware("auth");
Route::get('/product-checkout', [BillingController::class, "checkout"])->middleware("auth")->name("checkout");
Route::post('/create-subscription', [BillingController::class, "create_subscription"])->middleware("auth");
Route::get("/premium", [BillingController::class , "premium_page"])->name("premium");


//authentication routes
Auth::routes([
    'register' => true, // Register Routes...
    'reset' => false, // Reset Password Routes...
    'verify' => false, // Email Verification Routes...
  ]);


