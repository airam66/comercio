<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    protected $table="purchases_products";
    protected $fillable= ['purchase_id','product_id','amount','subTotal','price'];
}
