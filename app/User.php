<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email','photo_name', 'password','role_id','client_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

   public function role(){

     return $this->belongsTo('App\Role');
   }
   public function scopeSearchUserName($query,$name)
    {
        return $query->where('name','LIKE',"%".$name."%");
      }

    public function standard(){
       return $this->role_id===5;
    }

   public function client(){
        return $this->hasOne('App\Client');
   }
    


     public function shoppingCarts()
    {
        return $this->hasMany('App\ShoppingCart');
    }

}
