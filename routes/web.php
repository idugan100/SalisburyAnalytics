<?php

use App\services\TrackUsage;
use Illuminate\Http\Request;
use Database\Factories\CourseFactory;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name("home");

//routes for courses
Route::get('/', [CourseController::class,"index"]);
Route::resource('courses',CourseController::class);

//crud review routes
Route::resource('professors',ProfessorController::class);

Route::resource('reviews',ReviewController::class);

//admin review routes
Route::get('/processing', [ReviewController::class, 'processing'])->name('reviews.processing')->middleware(EnsureIsAdmin::class);
Route::get('/approved',[ReviewController::class,'approved'])->name('reviews.approved')->middleware(EnsureIsAdmin::class);
Route::get('/rejected',[ReviewController::class,'rejected'])->name("reviews.rejected")->middleware(EnsureIsAdmin::class);
Route::get('/usage',[UsageController::class,'index'])->name("usage.index")->middleware(EnsureIsAdmin::class);
Route::get('/usage_details/{usagelog}',[UsageController::class,'details'])->name("usage.details")->middleware(EnsureIsAdmin::class);


//review actions
Route::get('/reviews/approve/{review}',[ReviewController::class,'approve'])->name('review.approve')->middleware(EnsureIsAdmin::class);
Route::get('/reviews/reject/{review}',[ReviewController::class,'reject'])->name("review.reject")->middleware(EnsureIsAdmin::class);
Route::get('/reviews/reprocess/{review}/{origin}',[ReviewController::class,'reprocess'])->name("review.reprocess")->middleware(EnsureIsAdmin::class);

//grade inflation report
Route::get("/gpa_over_time",[GpaOverTimeController::class,"index"])->name("gpa")->middleware(EnsureIsSubscribed::class);

//enrollment report
Route::get("/enrollment_over_time",[EnrollmentOverTimeController::class,"index"])->name("enrollment")->middleware(EnsureIsSubscribed::class);

//query tool
Route::get("/query_tool",[QueryToolController::class,"index"])->name("qtool")->middleware(EnsureIsSubscribed::class);


//stripe
Route::get('/billing-portal', function (Request $request) {
    TrackUsage::log($request,"about");
    return $request->user()->redirectToBillingPortal(route('courses.index'));
})->middleware("auth");

Route::get('/product-checkout', function (Request $request) {
    TrackUsage::log($request,"about");
    return view('checkout', [
        'intent' => auth()->user()->createSetupIntent()
    ]);
})->middleware("auth")->name("checkout");

Route::post('/create-subscription', function (Request $request) {
    $request->user()->newSubscription(
        'default', env("PLAN_ID")
    )->create($request->token);
    return $request->user()->redirectToBillingPortal(route('courses.index'));
})->middleware("auth");

Route::get("/premium",function (Request $request) {
    TrackUsage::log($request,"about");
    return view("premium");
})->name("premium");


Auth::routes([

    'register' => true, // Register Routes...
  
    'reset' => false, // Reset Password Routes...
  
    'verify' => false, // Email Verification Routes...
  
  ]);


