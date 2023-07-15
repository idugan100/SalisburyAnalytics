<?php

use App\services\IsBot;
use App\Models\UsageLog;
use Illuminate\Http\Request;
use Database\Factories\CourseFactory;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfessorController;

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

    $usage_log=UsageLog::whereDate('created_at', now())->first();
    IsBot::check($request->userAgent()) ? $usage_log->about_views_bot++ : $usage_log->about_views++;
    $usage_log->save();

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

//review actions
Route::get('/reviews/approve/{review}',[ReviewController::class,'approve'])->name('review.approve');
Route::get('/reviews/reject/{review}',[ReviewController::class,'reject'])->name("review.reject");
Route::get('/reviews/reprocess/{review}/{origin}',[ReviewController::class,'reprocess'])->name("review.reprocess");





Auth::routes([

    'register' => false, // Register Routes...
  
    'reset' => false, // Reset Password Routes...
  
    'verify' => false, // Email Verification Routes...
  
  ]);


