<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable=['description','creditLab','creditLecture','creditsTotal', 'courseNumber', 'departmentCode','syllabusLink'];
    public function scopeFilter($query,$searchTerm){
        if($searchTerm){
            $explodedSearchTerm=explode("-", $searchTerm);
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
