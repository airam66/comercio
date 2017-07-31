<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderRequestProduct extends Model
{
    protected $table="order_request_product";
    protected $fillable= ['request_id','product_id','amount','subTotal','price'];
}
