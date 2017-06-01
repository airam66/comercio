<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table="products";

    protected $fillable= ['id','code','name','category_id','event_id','line_id','brand_id','description','stock','extension','status'];

    public function category(){

    	return $this->belongsTo('App\Category');
    }

    public function line(){

    	return $this->belongsTo('App\Line');
    }

    public function brand(){

    	return $this->belongsTo('App\Brand');
    }

    public function event(){

    	return $this->belongsTo('App\Event');
    }

    public function productprice(){

        return $this->hasMany('App\ProductPrice');
    }
}
