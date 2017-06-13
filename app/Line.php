<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    protected $table="lines";

    protected $fillable= ['name','status'];

    public function productos()
    {
        return $this->hasMany('App\Product');
    }
}
