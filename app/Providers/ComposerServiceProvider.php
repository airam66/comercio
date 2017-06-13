<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use  Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(){

      View::composer(
            ['main/pagine/Catalogo/Catalogue','main/pagine/Catalogo/showProduct','main/pagine/Catalogo/filtroCategoriaCatalogo'],'App\Http\ViewComposers\AsideComposer'
        );
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
