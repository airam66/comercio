
<?php

Route::group(['middleware' => 'auth'], function () {
        Route::get('/link1', function ()    {
//        // Uses Auth Middleware
   });
	
});

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes

Route::resource('cotillon','MainPagineController');

Route::get('/admin', function(){
	return view('admin.home');
});

// rutas para la pagina de administracion del sistema

Route::group(['prefix'=>'admin'], function(){

	Route::resource('categories','CategoriesController');
	
    Route::resource('products','ProductsController');
});