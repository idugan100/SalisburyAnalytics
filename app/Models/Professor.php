<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;
    protected $fillable=['firstName','lastName','deparment'];
    
    public function scopeFilter( $query, $searchTerm){
        
        
        if($searchTerm){
            
            $explodedTerms=explode( " ", $searchTerm);
            $searchedPosts=$query
                ->where('firstName' , 'LIKE' , "%" . $explodedTerms[0]. "%")
                ->where('lastName', 'LIKE', "%" . $explodedTerms[1] . "%");
            return $searchedPosts;
        }
        else{
            dd("else");

            return $query;
        }
    }

   
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
