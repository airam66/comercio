<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderRequest extends Model
{

	protected $table="order_requests";
    protected $fillable= ['client_id','advance','delivery_date','total','status'];
    public function products(){
    	return $this->belongsToMany('App\Product')->withTimestamps();

    }
     public function clients(){

        return $this->belongsTo('App\Client');
    }

    
    public function scopeSearchRequest($query,$fecha1,$fecha2){

        return $query->where( [['delivery_date','>=',$fecha1],
                ['delivery_date','<=',$fecha2],]);

    }

    public function client(){

        return $this->belongsTo	('App\Client');
    }
    
}
