<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable=['description','creditLab','creditLecture','creditsTotal', 'courseNumber', 'departmentCode','syllabusLink','avg_gpa'];
    public function scopeFilter($query,array $searchTerm){
        if(array_key_exists('search',$searchTerm)){
            
            $explodedSearchTerm=explode("-", $searchTerm['search']);
            return $query->where("departmentCode","=",$explodedSearchTerm[0])
                ->where("courseNumber", "=", $explodedSearchTerm[1]);
           

        }
        else{
            return $query;
        }
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
