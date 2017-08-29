<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table="orders";
    protected $fillable= ['client_id','advance','delivery_date','total','status'];

  
    
     public function client(){

        return $this->belongsTo ('App\Client');
    }

    public function scopeSearchOrder($query,$fecha1,$fecha2){
       return $query->whereDate('created_at','>=',$fecha1)->whereDate('created_at','<=',$fecha2);   

    }

      public function products(){
        return $this->belongsToMany('App\Product')->withTimestamps();

    }
   

    public function payments(){

        return $this->hasMany('App\Payment');
        
    }

}
