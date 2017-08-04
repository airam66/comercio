<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table="payments";
    protected $fillable= ['order_id','amount_paid','created_at'];


    public function order(){

        return $this->belongsTo ('App\Order');
    }

}
