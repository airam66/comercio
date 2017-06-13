<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table="brands";

    protected $fillable= ['name','status'];

    public function productos()
    {
        return $this->hasMany('App\Product');
    }
}
