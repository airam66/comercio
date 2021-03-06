<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table="clients";

    protected $fillable= ['name','cuil','address','location','phone','email','bill','status'];


     public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }


     public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public static function clientByCuil($term){

        return static::select('id', 'name','cuil','address' ,'phone','email')
            ->where('cuil','LIKE',"%$term%")
            ->where('status','=','activo')
            ->get();

    }   



    public function scopeSearchClient($query,$name){

        return $query->where('name','LIKE',"%" . $name . "%");
                     
    }
}
