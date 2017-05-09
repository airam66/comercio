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


Auth::routes();


//Rutas para la pagina web

Route::get('/home', 'MainController@home')->name('home');

Route::get('/aboutUs', 'AboutUsController@aboutUs')->name('aboutUs');

Route::get('/contactUs', 'ContactUsController@contactUs')->name('contactUs');


Route::resource('cotillon','AboutUsController');