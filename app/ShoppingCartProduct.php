<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCartProduct extends Model
{
    protected $table="shopping_cart_product";
    protected $fillable= ['shopping_cart_id','product_id','amount','subTotal','price'];
}
