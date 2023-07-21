<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Livewire\Component;
use App\Models\Professor;
use Illuminate\Support\Facades\DB;

class SearchProfessors extends Component
{
    public $search;
    public $selected_department;
    public $professors;
    public $selected_professor;
    public $departments;

    public function mount(){
        $this->courses=[];
        $this->departments=Course::select("departmentCode")->orderBy("departmentCode","asc")->distinct()->get()->toArray();
    }

    public function render()
    {
        if($this->selected_department){

            $this->professors=DB::table("courses_x_professors_with_grades")
                                ->join("courses","course_id","courses.id")
                                ->join("professors","professor_id","professors.id")
                                ->select("professors.id","firstName","lastName")
                                ->where("departmentCode",$this->selected_department)
                                ->groupBy("professor_id","firstName","lastName")
                                ->orderBy("lastName","ASC")
                                ->get();
        }
        else{
            $this->professors=[];
        }
        return view('livewire.search-professors');
    }
}
