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
    
  Route::resource('events','EventController');
  
  Route::resource('brands','BrandController');  

  Route::post('/products/enable/{id}','ProductsController@enable')->name('enable');

  Route::post('/products/enable/{id}','ProductsController@enable')->name('enable');
    
  Route::resource('products','ProductsController');

  Route::resource('lines','LinesController');

  Route::resource('porcentages','PorcentagesController');

});



Route::get('/', function () {
    return view('main.pagine.index');
});

Auth::routes();

//Rutas para la pagina web
Route::get('/index', 'MainController@index')->name('index');

Route::get('/aboutUs', 'AboutUsController@aboutUs')->name('aboutUs');
Route::get('/contactUs', 'ContactUsController@contactUs')->name('contactUs');
Route::get('/catalogue', 'CatalogsController@index')->name('catalogue');
Route::post('/contactForm', 'ContactUsController@contact')->name('contactForm');
//Route::get('/CatalogueShow','CatalogsController@show')->name('catalogueShow');
Route::resource('catalogueShow', 'CatalogsController');
Route::get('events/{name}','CatalogsController@searchEvent')->name('searchEvent');


	
Route::post('send', ['as' => 'send', 'uses' => 'MailController@send'] );
Route::get('contact', ['as' => 'contact', 'uses' => 'MailController@index'] );




