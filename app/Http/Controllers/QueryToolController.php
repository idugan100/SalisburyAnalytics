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
            $query=$this->setEntity($request->entity);
        }

        return view("queryTool.index",
            [
                "departments"=>$departments
            ]);
    }

    private function setEntity($entity){
        if($entity=="courses"){
            return DB::table("courses")->select("courseTitle","courseNumber","courses.id","departmentCode","statistic");
        }
        elseif($entity=="professors"){
           return DB::table("professors")->select("firstName","lastName","professors.id","statistic");
        }
        else{
            return DB::table("courses")->select("departmentCode","statistic");
        }
    }
}
