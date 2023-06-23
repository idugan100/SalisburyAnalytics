<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;
    protected $fillable=['firstName','lastName','deparment','qty_A','qty_B','qty_C','qty_D','qty_F','qty_W'];
    
    public function scopeFilter( $query, $searchTerm){
        
        if(array_key_exists('search', $searchTerm)){
            $searchedPosts=$query->whereRaw("match(firstName,lastName) against(?)",[$searchTerm["search"]]);
  
            return $searchedPosts;
        }
        else{
        
            return $query;
        }
    }

   
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
