<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table="invoices";
    protected $fillable= ['client_id','discount','total','status'];
    public function products(){
    	return $this->belongsToMany('App\Product')->withTimestamps();

    }
     public function clients(){

        return $this->belongsTo('App\Client');
    }

    
    public function scopeSearchInvoice($query,$fecha1,$fecha2){

        return $query->where( [['created_at','>=',$fecha1],
                ['created_at','<=',$fecha2],]);

    }

    public function client(){

        return $this->belongsTo	('App\Client');
    }



}
	

