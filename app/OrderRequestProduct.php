<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderRequestProduct extends Model
{
    protected $table="order_requests_products";
    protected $fillable= ['request_id','product_id','amount','subTotal','price'];
}
