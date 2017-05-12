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
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
//Rutas para la pagina web
Route::get('/home', 'MainController@home')->name('home');
Route::get('/homeCon', 'MainController@homeCon')->name('homeCon');
Route::get('/aboutUs', 'AboutUsController@aboutUs')->name('aboutUs');
Route::get('/contactUs', 'ContactUsController@contactUs')->name('contactUs');
Route::post('/contactForm', 'ContactUsController@contact')->name('contactForm');
Route::resource('cotillon','AboutUsController');
//para el mapa
Route::get('/mapa',function(){
	return view('main.pagine.add');
})->name('mapa');

	
Route::post('send', ['as' => 'send', 'uses' => 'MailController@send'] );
Route::get('contact', ['as' => 'contact', 'uses' => 'MailController@index'] );
