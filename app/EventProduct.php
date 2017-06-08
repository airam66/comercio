<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventProduct extends Model
{
    protected $table="event_product";

    protected $fillable= ['product_id','event_id'];
}
