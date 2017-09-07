<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWeb extends Model
{
    protected $fillable = [
        'name', 'email', 'password','photo_name','role_id','client_id',
    ];

    
}
