<?php

use App\services\TrackUsage;
use Illuminate\Http\Request;
use Database\Factories\CourseFactory;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\GpaOverTimeController;

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
});

//routes for courses
Route::get('/', [CourseController::class,"index"]);
Route::resource('courses',CourseController::class);

//crud review routes
Route::resource('professors',ProfessorController::class);

Route::resource('reviews',ReviewController::class);

//admin review routes
Route::get('/processing', [ReviewController::class, 'processing'])->name('reviews.processing');
Route::get('/approved',[ReviewController::class,'approved'])->name('reviews.approved');
Route::get('/rejected',[ReviewController::class,'rejected'])->name("reviews.rejected");
Route::get('/usage',[UsageController::class,'index'])->name("usage.index");
Route::get('/usage_details/{usagelog}',[UsageController::class,'details'])->name("usage.details");


//review actions
Route::get('/reviews/approve/{review}',[ReviewController::class,'approve'])->name('review.approve');
Route::get('/reviews/reject/{review}',[ReviewController::class,'reject'])->name("review.reject");
Route::get('/reviews/reprocess/{review}/{origin}',[ReviewController::class,'reprocess'])->name("review.reprocess");

//grade inflation report
Route::get("/gpa_over_time",[GpaOverTimeController::class,"index"])->name("gpa");




Auth::routes([

    'register' => false, // Register Routes...
  
    'reset' => false, // Reset Password Routes...
  
    'verify' => false, // Email Verification Routes...
  
  ]);


