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
            //todo logic for less then two search terms e.g. firstname only
            $secondTerm=False;
            $explodedTerms=explode( " ", $searchTerm['search']);
            if(count($explodedTerms)==2){
                $secondTerm=True;
                $var=$explodedTerms[1];
            }
            
            $searchedPosts=$query
                ->where('firstName' , 'LIKE' , "%" . $explodedTerms[0]. "%")
                ->orwhere('lastName', 'LIKE', "%" . $explodedTerms[0] . "%")
                ->when($secondTerm, function ($query, $var) {
                    return $query->orwhere('firstName' , 'LIKE' , "%" . $var. "%");
                })
                ->when($secondTerm, function ($query, $var) {
                    return $query->orwhere('lastName' , 'LIKE' , "%" . $var. "%");
                });
                
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
