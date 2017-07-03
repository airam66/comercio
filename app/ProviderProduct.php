<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderProduct extends Model
{
    protected $table="providers_products";
    protected $fillable= ['provider_id','product_id'];
}
