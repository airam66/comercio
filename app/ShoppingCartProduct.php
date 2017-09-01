<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCartProduct extends Model
{
    protected $table="shoppingcart_product";
    protected $fillable= ['shopping_cart_id','product_id','amount','subTotal','price'];

   public function scopeSearchOrderOnline($query,$id){

   	return $query->join('products as p','product_id','=','p.id')     
                 ->select('p.id as product_id','p.name as product_name','price','amount','subTotal')
                 ->where('shopping_cart_id','=',$id);


   }
    
}
