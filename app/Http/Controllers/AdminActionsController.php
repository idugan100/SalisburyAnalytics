<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Middleware\EnsureIsAdmin;
use App\Models\Professor;

class AdminActionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(EnsureIsAdmin::class);
    }

    public function index(Request $request){
        return view("admin.actions");
    }

    public function recalculate_courses(){
        $courses=Course::all();
        foreach($courses as $course){
            $course->calculate_statistics();
        }
        

        return "completed";
    }

    public function recalculate_professors(){
        $professors =Professor::all();
        foreach($professors as $professor){
            $professor->calculate_statistics();
        }

        return "completed";
    }
}
