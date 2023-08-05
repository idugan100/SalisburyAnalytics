<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryToolController extends Controller
{
    public function index(Request $request){
        $departments=Course::select("departmentCode")->orderBy("departmentCode")->distinct()->get();
        if(isset($request->quantity)){
            $results=$this->getData($request);
            // dd($results);
        }

        return view("queryTool.index",
            [
                "departments"=>$departments,
                "results"=>$results??[],
                "prev_entity"=>$request->entity??null,
                "prev_statistic"=>$request->statistic??null,
                "prev_quantity"=>$request->quantity??null,
                "prev_ordering"=>$request->ordering??null,
                "prev_department_filter"=>$request->department_filter??null

            ]);
    }

    private function getData($request){
        if($request->entity=="courses"){
            if(isset($request->department_filter)){
                // dd($request->department_filter);
                return DB::table("courses")->select("courseTitle", "courseNumber", "courses.id", "departmentCode",$request->statistic)
                        ->where("courses.departmentCode",$request->department_filter)
                        ->orderBy($request->statistic, $request->ordering)
                        ->limit($request->quantity)
                        ->get()->toArray();
            }
            else{
                return DB::table("courses")->select("courseTitle", "courseNumber", "courses.id", "departmentCode",$request->statistic)
                        ->orderBy("courses.".$request->statistic, $request->ordering)
                        ->limit($request->quantity)
                        ->get()->toArray();
            }
        }
        elseif($request->entity=="professors"){
            if(isset($request->department_filter)){
                return DB::table("professors")->selectRaw("professors.*")
                        ->join("courses_x_professors_with_grades","professor_ID","professors.id")
                        ->join("courses","courses.id","course_ID")
                        ->where("departmentCode",$request->department_filter)
                        ->groupBy("professor_id",$request->statistic)
                        ->orderBy($request->statistic, $request->ordering)
                        ->limit($request->quantity)
                        ->get()->toArray();
            }
            else{
                return DB::table("professors")->select("firstName", "lastName", "professors.id" ,$request->statistic)
                        ->orderBy($request->statistic, $request->ordering)
                        ->limit($request->quantity)
                        ->get()->toArray();
            }
        }
    }
    
}
