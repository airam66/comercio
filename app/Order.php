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
         return $query->where( [['created_at','>=',$fecha1],
                ['created_at','<=',$fecha2],]);

    }

      public function products(){
        return $this->belongsToMany('App\Product')->withTimestamps();

    }

    public function getUrlAttribute(){

      return route('orders.pdf',$this->id);
    }

    public function getRemoveAttribute(){

      return route('orders.destroy',$this->id);
    }

    public function getEditAttribute(){

      return route('orders.edit',$this->id);
    }
}
