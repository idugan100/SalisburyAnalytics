<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Livewire\Component;

class SearchCourses extends Component
{
    public $search;
    public $selected_department;
    public $courses;
    public $selected_course;
    public $departments;

    public function mount(){
        $this->courses=[];
        $this->departments=Course::select("departmentCode")->orderBy("departmentCode","asc")->distinct()->get()->toArray();
    }

    public function render()
    {
        if($this->selected_department){
            $this->courses=Course::where("departmentCode",$this->selected_department)->orderBy("courseNumber")->get();
        }
        else{
            $this->courses=[];
        }
        
        return view('livewire.search-courses');
    }
}
