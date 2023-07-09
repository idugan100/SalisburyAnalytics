<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\ReviewController;
use App\Models\UsageLog;

use Database\Factories\CourseFactory;

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

Route::get('/', function () {

    $usage_log=UsageLog::whereDate('created_at', now())->first();
    $usage_log->about_views++;
    $usage_log->save();

    return view('welcome');
});

//routes for courses
Route::resource('courses',CourseController::class);

//crud review routes
Route::resource('professors',ProfessorController::class);

Route::resource('reviews',ReviewController::class);

//admin review routes
Route::get('/processing', [ReviewController::class, 'processing'])->name('reviews.processing');
Route::get('/approved',[ReviewController::class,'approved'])->name('reviews.approved');
Route::get('/rejected',[ReviewController::class,'rejected'])->name("reviews.rejected");
//review actions
Route::get('/reviews/approve/{review}',[ReviewController::class,'approve'])->name('review.approve');
Route::get('/reviews/reject/{review}',[ReviewController::class,'reject'])->name("review.reject");
Route::get('/reviews/reprocess/{review}/{origin}',[ReviewController::class,'reprocess'])->name("review.reprocess");





Auth::routes([

    'register' => false, // Register Routes...
  
    'reset' => false, // Reset Password Routes...
  
    'verify' => false, // Email Verification Routes...
  
  ]);


