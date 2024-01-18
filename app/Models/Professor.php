<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
