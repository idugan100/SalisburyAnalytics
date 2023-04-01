<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\StoreProfessorRequest;
use App\Http\Requests\UpdateProfessorRequest;

class ProfessorController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index','show']]);
    }
    
        
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $validated=$request->validate([
            "search"=>['nullable','regex:/[a-zA-Z]+[a-zA-Z]*/']
        ]);
        
        $professor=Professor::filter($validated)->get();
        

        

        return(view("professors.index",["professors"=>$professor]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return(view('professors.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfessorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfessorRequest $request)
    {
        $validated=$request->validate([
            "firstName"=>"required",
            "lastName"=>"required",
            "department"=>"required"
        ]);
        $professor= new Professor();
        $professor->firstName=$validated['firstName'];
        $professor->lastName=$validated['lastName'];
        $professor->department=$validated['department'];
        $professor->save();
        return redirect(route("professors.index"));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function show(Professor $professor)
    {
        $reviews=$professor->reviews()->where('approved_flag',ReviewController::APPROVED_FLAG)->get();
        return view('professors.show',compact('professor','reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function edit(Professor $professor)
    {
        return(view("professors.edit",["professor"=>$professor]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfessorRequest  $request
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfessorRequest $request, Professor $professor)
    {
        $validated=$request->validate([
            'firstName'=>'required',
            'lastName'=>'required',
            'department'=>'required'
        ]);
        
        $professor->update($validated);
        $professor->department=$validated['department'];
        $professor->save();
        return redirect(route('professors.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professor $professor)
    {
        $professor->delete();
        return(redirect(route("professors.index")));
    }

}
