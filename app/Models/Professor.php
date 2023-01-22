<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;
    protected $fillable=['firstName','lastName','deparment'];
    
    public function scopeFilter( $query, $searchTerm){
        
        
        if(array_key_exists('search', $searchTerm)){
            
            $explodedTerms=explode( " ", $searchTerm['search']);

            if(count($explodedTerms)<2){
                $searchedPosts=$query
                    ->orwhere('firstName' , 'LIKE' , "%" . $explodedTerms[0]. "%")
                    ->orwhere('lastName', 'LIKE', "%" . $explodedTerms[0] . "%");
            }
            else{
                $searchedPosts=$query
                    ->orwhere('firstName' , 'LIKE' , "%" . $explodedTerms[0]. "%")
                    ->orwhere('lastName', 'LIKE', "%" . $explodedTerms[0] . "%")
                    ->orwhere('firstName' , 'LIKE' , "%" . $explodedTerms[1]. "%")
                    ->orwhere('lastName' , 'LIKE' , "%" . $explodedTerms[1]. "%");
            }
                
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
