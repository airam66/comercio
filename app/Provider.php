<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table="providers";

    protected $fillable= ['name','cuit','address','location','province','phone','email','bill','status'];

   /* public function productos()
    {
        return $this->hasMany('App\Invoice');
    }*/

    public static function providerByCuit($term){
        return static::select('id', 'name','cuit','address' ,'phone','email','province')
            ->where('cuit','LIKE',"%$term%")
            ->get();

    }   



    public function scopeSearchProvider($query,$name){

        return $query->where('name','LIKE',"%" . $name . "%");
    }
}