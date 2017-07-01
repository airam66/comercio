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
    public static function clientByCuit($term){
        return static::select('id', 'name','cuit','address' ,'phone','email')
            ->where('cuit','LIKE',"%$term%")
            ->get();

    }   



    public function scopeSearchClient($query,$name){

        return $query->where('name','LIKE',"%" . $name . "%");
    }
}
