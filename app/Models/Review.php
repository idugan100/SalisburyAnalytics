<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['question','response','professor_id','course_id'];

 

    public function professor(){
        return $this->belongsTo(Professor::class);
    }
    public function course(){
        return $this->belongsTo(Course::class);
    }
}
