<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table="clients";

    protected $fillable= ['name','cuil','address','location','phone','email','bill','status'];

    public function productos()
    {
        return $this->hasMany('App\Invoice');
    }

     public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }

    public static function clientByCuil($term){

        return static::select('id', 'name','cuil','address' ,'phone','email')
            ->where(strval('cuil'),'LIKE',"%$term%")
            ->get();

    }   



    public function scopeSearchClient($query,$name){

        return $query->where('name','LIKE',"%" . $name . "%");
    }
}
