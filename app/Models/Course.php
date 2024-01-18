<?php

namespace App\Models;

use App\Http\Controllers\ReviewController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'courseTitle', 'creditLab', 'creditLecture', 'creditsTotal', 'courseNumber', 'departmentCode', 'syllabusLink', 'avg_gpa'];

    /** @return HasMany<Review> */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /** @return HasMany<Review> */
    public function approved_reviews()
    {
        return $this->reviews()->where('approved_flag', ReviewController::APPROVED_FLAG);
    }
}
