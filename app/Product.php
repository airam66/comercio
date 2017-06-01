<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table="products";

   protected $fillable= ['code','name','category_id','line_id','event_id','brand_id','wholesale_cant','description','stock','extension','status','purchase_price','wholesale_price','retail_price'];

    public function category(){

        return $this->belongsTo('App\Category');
    }

    public function line(){

        return $this->belongsTo('App\Line');
    }

    public function brand(){

        return $this->belongsTo('App\Brand');
    }

    public function productevent()
    {
        return $this->belongsTo('App\ProductEvent');
    }

    public function event(){
        return $this->belongsToMany('App\Event')->using('App\ProductEvent');
    }

}
