<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
	protected $table="products_list_price";

    protected $fillable= ['product_id','purchase_price','wholesale_price','retail_price'];

    public function product(){
    	
   		return $this->belongsTo('App\Product'); 
	}
}
