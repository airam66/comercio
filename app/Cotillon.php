<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotillon extends Model
{
    //
    protected $table="cotillones";

    protected $fillable= ['name','description_AboutUs','address','phones','email','facebook','bussines_hours'];
}
