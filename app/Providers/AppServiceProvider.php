<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; //lo agregue

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void

          */



 public function boot()
{
    Schema::defaultStringLength(191);
}
   // public function boot()
    //{
        //
    //}

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
