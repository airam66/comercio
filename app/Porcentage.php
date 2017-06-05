<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Porcentage extends Model
{
    protected $table="porcentages";

    protected $fillable= ['wholesale_porcentage','retail_porcentage']; 

}
