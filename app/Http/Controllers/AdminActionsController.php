<?php

namespace App\Http\Controllers;

use App\Http\Middleware\EnsureIsAdmin;
use App\Jobs\RecalculateCourseStatistics;
use App\Jobs\RecalculateProfessorStatistics;
use App\Models\Course;
use App\Models\Professor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminActionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(EnsureIsAdmin::class);
    }

    public function index(Request $request): View
    {
        //return batch data
        return view('admin.actions');
    }

    public function recalculate_courses(): string
    {
        $courses = Course::all();
        RecalculateCourseStatistics::dispatch($courses);

        return 'process launched';
    }

    public function recalculate_professors(): string
    {
        $professors = Professor::all();
        RecalculateProfessorStatistics::dispatch($professors);

        return 'process launched';
    }

    public function get_running_jobs(): View
    {
        $decoded_jobs = [];
        $encoded_jobs = DB::table('jobs')->get();

        foreach ($encoded_jobs as $job) {
            $payload = json_decode($job->payload);
            $decoded_jobs[] = str_replace("App\Jobs\\", '', $payload->data->commandName);
        }

        return view('admin.jobs', ['jobs' => $decoded_jobs]);

    }
}
