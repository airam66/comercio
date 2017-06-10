<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{


    protected $table="events";
    protected $fillable= ['name','status'];
    

    public function products(){
    	return $this->belongsToMany('App\Product')->withTimestamps();
    }
     public function scopeSearchEvent($query,$name){
		return $query->where('name','=',$name);

	}

	public function scopeSearchEventP($query,$name){
		
		return $query->where('name','LIKE',"%".$name."%");

	}
			
}


?>
