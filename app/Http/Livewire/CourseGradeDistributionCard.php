<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Charts\GradeDistribution;
use Illuminate\Support\Facades\DB;

class CourseGradeDistributionCard extends Component
{
    public $course;
    public $selected_semester;
    public $semesters;
    public $topProfessors;

    public function mount(){
        $this->semesters= json_decode(json_encode($this->course->semesters), true);        
        $this->topProfessors=json_decode(json_encode($this->course->topProfessors), true);

    }

    public function render(GradeDistribution $chart)
    {
        //dd($this->semesters);
        if(isset($this->selected_semester)){
            //dd($this->semesters);
            $grade_distribution = DB::table("courses_x_professors_with_grades")
                                    ->selectRaw("sum(quantity) as 'total', grade")
                                    ->where("course_ID",$this->course->id)
                                    ->whereIn("grade",['A','B','C','D','F','W'])
                                    ->whereRaw("concat(semester,year) = ? ", [$this->selected_semester])->groupBy("grade")->get();
            $chart=$chart->build($this->convert_query_results_to_object($grade_distribution));
            
                                    

        }
        else{

            $chart=$chart->build($this->course);
        }
        dd($chart);
        // dd($this->selected_semester);
        return view('livewire.course-grade-distribution-card',["chart"=>$chart]);
    }

    private function convert_query_results_to_object($grade_distribution){
        $entity=(object)[];
        foreach($grade_distribution as $grade_total){
            switch ($grade_total->grade) {
                case 'A':
                    $entity->qty_A= (int) $grade_total->total;
                    break;
                case 'B':
                    $entity->qty_B= (int) $grade_total->total;
                    break;
                case 'C':
                    $entity->qty_C= (int) $grade_total->total;
                    break;
                case 'D':
                    $entity->qty_D= (int) $grade_total->total;
                    break;
                case 'F':
                    $entity->qty_F= (int) $grade_total->total;
                    break;
                case 'W':
                    $entity->qty_W= (int) $grade_total->total;
                    break;
            }

        }
        return $entity;
    }
}
