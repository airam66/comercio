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
            ['main/pagine/Catalogo/Catalogue','main/pagine/Catalogo/showProduct','main/pagine/Catalogo/filtroCategoriaCatalogo','main/pagine/index','main/pagine/aboutUs','main/pagine/contactUs','main/pagine/webUsers/edit','main/pagine/shoppingcart/index','main/pagine/shoppingcart/indexWeb'], function($view){
            $shoppingcart_id=\Session::get('shoppingcart_id');
            $shoppingcart=ShoppingCart::findOrCreateBySessionID($shoppingcart_id);
            \Session::put('shoppingcart_id',$shoppingcart->id);
           
            $view->with('shoppingcart',$shoppingcart);
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
