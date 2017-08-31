<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
	protected $table="shopping_carts";
	protected $fillable = ['status','user_id','total'];

	public function ShoppingCartProducts(){
		return $this->hasMany('App\ShoppingCartProduct');
	}

	public function products(){
		return $this->belongsToMany('App\Product','shopping_cart_product');
	}

	public function productsSize(){
		return $this->products()->count();
	}

	public function total(){
		return $this->ShoppingCartProducts()->sum('subTotal');
	}

	public static function findOrCreateBySessionID($shopping_cart_id){
		$shopping_carts=ShoppingCart::findBySeccion($shopping_cart_id);
		if($shopping_carts)
			return $shopping_carts;
		else
			return ShoppingCart::createWithoutSession();

	}    

	public static function findBySeccion($shopping_cart_id){
		return ShoppingCart::find($shopping_cart_id);
	}

	public static function createWithoutSession(){
		return ShoppingCart::create([
			'status' => 'pendiente',
			'total'=>0,
			]);
	}
}
