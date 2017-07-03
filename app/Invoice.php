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
    public function scopeSearchInvoice($query,$fecha1,$fecha2){

        return $query->whereBetween('created_at', [$fecha1,$fecha2 ]);

    }

    public function client(){

        return $this->belongsTo	('App\Client');
    }



}
	

