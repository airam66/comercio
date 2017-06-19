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

    public function scopeSearchLine($query,$name){
		
		return $query->where('name','LIKE',"%".$name."%");

	}
}
