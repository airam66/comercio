<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ShoppingCart;

class ShoppingCartProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            ['main/pagine/Catalogo/Catalogue','main/pagine/Catalogo/showProduct','main/pagine/Catalogo/filtroCategoriaCatalogo','main/pagine/index','main/pagine/aboutUs','main/pagine/contactUs','main/pagine/webUsers/edit','main/pagine/shoppingcart/index'], function($view){
            $shopping_cart_id=\Session::get('shopping_cart_id');
            $shopping_cart=ShoppingCart::findOrCreateBySessionID($shopping_cart_id);
            \Session::put('shopping_cart_id',$shopping_cart->id);
           
            $view->with('shopping_cart',$shopping_cart);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
