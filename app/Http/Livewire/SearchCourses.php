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

    public function mount(){
        $this->courses=[];
    }

    public function render()
    {
        $departments=Course::select("departmentCode")->distinct()->get();
        if($this->selected_department){
            $this->courses=Course::where("departmentCode",$this->selected_department)->orderBy("courseNumber")->get();
        }
        return view('livewire.search-courses',["search"=>$this->search, "departments"=>$departments,"courses"=>$this->courses]);
    }
}
