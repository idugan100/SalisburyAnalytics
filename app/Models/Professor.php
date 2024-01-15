<?php

namespace App\Models;

use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = ['firstName', 'lastName', 'deparment', 'avg_GPA'];

    /** @return HasMany<Review> */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
