<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'auth'], function () {
       // Route::get('/link1', function ()    {
//        // Uses Auth Middleware


       Route::get('/admin', function(){
        return view('admin.home');
        });
   });
  


    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes

Route::resource('cotillon','MainPagineController');


// rutas para la pagina de administracion del sistema

Route::group(['prefix'=>'admin'], function(){

  Route::resource('categories','CategoriesController');
      Route::get('/category/{id}/desable','CategoriesController@desable')->name('categories.desable');
      Route::get('/category/{id}/enable','CategoriesController@enable')->name('categories.enable');

    
  Route::resource('events','EventController');
      Route::get('/events/{id}/desable','EventController@desable')->name('events.desable');
      Route::get('/events/{id}/enable','EventController@enable')->name('events.enable');

  Route::resource('brands','BrandController');   
     
  Route::resource('products','ProductsController');
      Route::get('/search','InvoicesController@search');
      
      Route::get('/searchL','InvoicesController@searchL');
       Route::get('/searchData','InvoicesController@searchDate');
       Route::get('/invoices/print','InvoicesController@print')->name('print');
       Route::get('show2','InvoicesController@show2');
      Route::get('productsSearch','ProductsController@SearchEventProducts')->name('productsSearch');
      Route::get('/products/{id}/desable','ProductsController@desable')->name('products.desable');
      Route::get('/products/{id}/enable','ProductsController@enable')->name('products.enable');

  Route::resource('lines','LinesController');

  Route::resource('porcentages','PorcentagesController');

  Route::resource('invoices','InvoicesController');
    Route::get('/autocomplete', 'InvoicesController@autocomplete')->name('autocomplete');
    Route::get('/autocompleteClient', 'InvoicesController@autocompleteClient')->name('autocompleteClient');
  Route::get('invoices/create/buscarproducto', 'InvoicesController@buscarproducto')->name('buscarproducto');
  
Route::resource('purchases','PurchasesController');

  route::resource('clients','ClientsController');
      Route::get('/searchClient','InvoicesController@searchClient');
  route::resource('providers','ProvidersController');
      Route::get('/searchProvider','PurchasesController@searchProvider');
  Route::resource('carrusel','CarruselController');

  
});

Route::get('/', 'MainController@index');

Auth::routes();

//Rutas para la pagina web
Route::get('/index', 'MainController@index')->name('index');

Route::get('/aboutUs', 'AboutUsController@aboutUs')->name('aboutUs');
Route::get('/contactUs', 'ContactUsController@contactUs')->name('contactUs');
Route::get('/catalogue', 'CatalogsController@index')->name('catalogue');
Route::post('/contactForm', 'ContactUsController@contact')->name('contactForm');
//Route::get('/CatalogueShow','CatalogsController@show')->name('catalogueShow');
Route::resource('/catalogueShow', 'CatalogsController');
Route::get('/events/{name}','CatalogsController@filtro')->name('searchEvent');
Route::get('/category/{id}/{name}','CatalogsController@searchCategoryProduct')->name('searchEventCategory');


	
Route::post('send', ['as' => 'send', 'uses' => 'MailController@send'] );
Route::get('contact', ['as' => 'contact', 'uses' => 'MailController@index'] );





