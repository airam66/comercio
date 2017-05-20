<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $table="products";

    protected $fillable= ['code','name','category_id','description','stock','price','extension','status'];



      public function category(){

    	return $this->belongsTo('App\Category');
    }
}
