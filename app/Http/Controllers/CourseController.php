<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $validated=$request->validate([
            'search'=>['nullable','regex:/.*-.*/']
        ]);
        //todo logic for when $validated['search'] isn't there
        
        $posts=Course::filter($validated)->get();
        return view('courses.index',[
            'courses'=>$posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        $validated=$request->validate([
            "courseTitle"=>"required",
            "description"=>"required",
            "courseNumber"=>"required",
            "departmentCode"=>"required",
            "creditsLecture"=>"required",
            "creditsLab"=>"required",
            "creditsTotal"=>"required",
            "syllabusLink"=>"required"
        ]);
        $course=new Course;
        $course->courseTitle=$validated['courseTitle'];
        $course->description=$validated['description'];
        $course->courseNumber=$validated['courseNumber'];
        $course->departmentCode=$validated['departmentCode'];
        $course->creditsLecture=$validated['creditsLecture'];
        $course->creditsLab=$validated['creditsLab'];
        $course->creditsTotal=$validated['creditsTotal'];
        $course->syllabusLink=$validated['syllabusLink'];
        $course->save();
        return redirect(route('courses.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect(route("courses.index"));

        
    }
}
