<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table="purchases";
    protected $fillable= ['provider_id','total','status'];

    public function products(){
    	return $this->belongsToMany('App\Product')->withTimestamps();

    }
     public function provider(){

        return $this->belongsTo('App\Provider');
    }

    
    public function scopeSearchPurchase($query,$fecha1,$fecha2){

        return $query->where( [['created_at','>=',$fecha1],
                ['created_at','<=',$fecha2],]);

    }
}
