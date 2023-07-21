<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;
    protected $fillable=['firstName','lastName','deparment','qty_A','qty_B','qty_C','qty_D','qty_F','qty_W'];
    
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
