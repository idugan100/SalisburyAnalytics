<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['response', 'professor_id', 'course_id', 'approved_flag'];

    /** @return BelongsTo<Professor,Review> */
    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }

    /** @return BelongsTo<Course,Review> */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
