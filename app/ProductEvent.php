<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductEvent extends Model
{
    protected $table="product_events";

    protected $fillable= ['product_id','event_id'];
}
