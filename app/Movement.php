<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
	protected $table="movements";
    protected $fillable=['concept','type','rode'];


     public function scopeSearchMovement($query,$fecha1,$fecha2){
       return $query->whereDate('created_at','>=',$fecha1)->whereDate('created_at','<=',$fecha2);   

    }

    public static function totalIncomes(){

    	return Movement::where('type','=','entrada')->pluck('rode')->sum();
    }
    
     public static function totalOutcomes(){

    	return Movement::where('type','=','salida')->pluck('rode')->sum();
    }

    public static function totalOutcomesByDate($fecha1,$fecha2){

    	return Movement::searchMovement($fecha1,$fecha2)->where('type','=','salida')->pluck('rode')->sum();
    }

    public static function totalIncomesByDate($fecha1,$fecha2){
     
     return Movement::searchMovement($fecha1,$fecha2)->where('type','=','entrada')->pluck('rode')->sum();
    }

    public static function movementToday(){

    	return Movement::whereDate('created_at','=',\Carbon\Carbon::now()->format('Y-m-d'));
    }

     public static function totalIncomesToday(){

    	 return Movement::movementToday()->where('type','=','entrada')->pluck('rode')->sum();
    }
    
    public static function totalOutcomesToday(){

    	 return Movement::movementToday()->where('type','=','salida')->pluck('rode')->sum();
    }

    public static function scopeSearchConcept($query,$concept){
         return Movement::where('concept','LIKE',"%" . $concept . "%");
    }


}
