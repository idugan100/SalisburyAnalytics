<?php

namespace App\Http\Controllers;

use App\Http\Middleware\EnsureIsAdmin;
use App\Jobs\RecalculateCourseStatistics;
use App\Models\Course;
use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;


class AdminActionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(EnsureIsAdmin::class);
    }

    public function index(Request $request)
    {
        //return batch data
        return view('admin.actions');
    }

    public function recalculate_courses()
    {
        $courses = Course::all()->toArray();
        Bus::batch([
            new RecalculateCourseStatistics($courses),
        ])->name('')->dispatch();

        $courses = Course::all();
        foreach ($courses as $course) {
            $course->calculate_statistics();
        }

        return 'completed';
    }

    public function recalculate_professors()
    {
        //dispatch job, return batch data to show progress
        $professors = Professor::all();
        foreach ($professors as $professor) {
            $professor->calculate_statistics();
        }

        return 'completed';
    }
}
