<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = ['firstName', 'lastName', 'deparment', 'avg_GPA'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
