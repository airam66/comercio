<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWeb extends Model
{
    protected $fillable = [
        'name', 'location','address','email', 'password','cuit','phone',
    ];
}
