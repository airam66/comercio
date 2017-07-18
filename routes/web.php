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
  

 

//##########################################################################################################
                                    //Rutas para el sistema de administracion
//##########################################################################################################

Route::group(['prefix'=>'admin','middleware' => 'auth'], function(){

  //******************************Rutas para lineas******************************************
  Route::resource('lines','LinesController');
  Route::get('/lines/{id}/desable','LinesController@desable')->name('lines.desable');

  //******************************Rutas para categorias******************************************
  Route::resource('categories','CategoriesController');
  Route::get('/categories/{id}/desable','CategoriesController@desable')->name('categories.desable');
  Route::get('/categories/{id}/enable','CategoriesController@enable')->name('categories.enable');

  //******************************Rutas para eventos******************************************
  Route::resource('events','EventController');
  Route::get('/events/{id}/desable','EventController@desable')->name('events.desable');
  Route::get('/events/{id}/enable','EventController@enable')->name('events.enable');

  //******************************Rutas para marcas******************************************
  Route::resource('brands','BrandController'); 
  Route::get('/brands/{id}/desable','BrandController@desable')->name('brands.desable'); 

  //******************************Rutas para productos**************************************** 
     
  Route::resource('products','ProductsController');
  Route::resource('porcentages','PorcentagesController');
  
  Route::get('/productsSearch','ProductsController@SearchEventProducts')->name('productsSearch');
  Route::get('products/{id}/desable','ProductsController@desable')->name('products.desable');
  Route::get('products/{id}/enable','ProductsController@enable')->name('products.enable');
  Route::post('products/updateStock','ProductsController@updateStock')->name('products.updateStock');
 //-------------para actualizar el stock de productos personalizados-------------------------------
  Route::get('craftProducts','ProductsController@craftProducts')->name('craftProducts');
  Route::post('products/updateStock','ProductsController@updateStock')->name('products.updateStock');
  Route::get('/searchCraftProducts', 'ProductsController@searchCraftProducts');  
  Route::get('/searchCraft', 'ProductsController@searchCraft'); 
 
  //-----------actualizar stock de productos que se utilizan para hacer prod personalizados----------
  Route::get('updateStockCreate',function(){
        return view('admin.products.updateStockCreate');
        });
   Route::get('/searchUpdateStockCreate', 'ProductsController@searchUpdateStockCreate');
   Route::post('products/updateStockCreateProduct', 'ProductsController@updateStockCreateProduct')->name('products.updateStockCreateProduct'); 

//************************************Rutas para ventas***********************************************
  Route::resource('invoices','InvoicesController');
  Route::get('/search','InvoicesController@search');
  Route::get('/searchL','InvoicesController@searchL');
  Route::get('/searchData','InvoicesController@searchDate');
  Route::post('invoices/desable','InvoicesController@desable')->name('invoices.desable');
  Route::get('/invoices/{id}/print','InvoicesController@print')->name('print');
  Route::get('/autocomplete', 'InvoicesController@autocomplete')->name('autocomplete');
  Route::get('/autocompleteClient', 'InvoicesController@autocompleteClient')->name('autocompleteClient');
  
  //########################### Rutas para compras###################
  Route::resource('purchases','PurchasesController');
  Route::get('/detailPurchase','PurchasesController@detailPurchase');
  Route::get('/searchProvider','PurchasesController@searchProvider');
  Route::get('/searchProducts','PurchasesController@searchProducts');
  Route::get('/autocompleteProvider', 'PurchasesController@autocompleteProvider')->name('autocompleteProvider');
  Route::get('/searchData','PurchasesController@searchDate');
  Route::get('/purchases/{id}/desable','PurchasesController@desable')->name('purchases.desable');
      
 //*************************Rutas para clientes******************************************************
  Route::resource('clients','ClientsController');
  Route::get('/searchClient','InvoicesController@searchClient');
  
 //**************************Rutas para proveedores************************************************** 
  Route::resource('providers','ProvidersController');
  Route::get('/listProducts','ProvidersController@listProducts');
  Route::get('/searchProvider','PurchasesController@searchProvider');
  Route::get('/searchProducts','PurchasesController@searchProducts');
  Route::resource('providersproducts','ProvidersProductsController');
      
  //*********************Rutas para imagenes del carrusel de la pagina web*******************************
  Route::resource('carrusel','CarruselController');

 //*******************administrar datos de pagina web****************************************************
  Route::resource('cotillon','MainPagineController');

//*************************************Rutas para pdf*****************************************************
  Route::get('pdfReport','PdfController@index')->name('pdfReport');
  Route::get('reportStock', 'PdfController@createReportStock')->name('reportStock');

  
});



Auth::routes();
//##########################################################################################################
                                    //Rutas para la pagina Web
//##########################################################################################################

Route::get('/', 'MainController@index');
Route::get('/index', 'MainController@index')->name('index');

Route::get('/aboutUs', 'AboutUsController@aboutUs')->name('aboutUs');
Route::get('/contactUs', 'ContactUsController@contactUs')->name('contactUs');
Route::get('/catalogue', 'CatalogsController@index')->name('catalogue');
Route::post('/contactForm', 'ContactUsController@contact')->name('contactForm');
Route::resource('/catalogueShow', 'CatalogsController');
Route::get('/events/{name}','CatalogsController@filtro')->name('searchEvent');
Route::get('/category/{id}/{name}','CatalogsController@searchCategoryProduct')->name('searchEventCategory');

Route::post('send', ['as' => 'send', 'uses' => 'MailController@send'] );
Route::get('contact', ['as' => 'contact', 'uses' => 'MailController@index'] );




