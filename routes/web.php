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

Route::get('/home', 'HomeController@index')->name('home');
//---------------------------------------------------------
Route::get('contacto',function(){

	return View::make('contacto.index');
});
Route::get('tienda',function(){

	return View::make('tiendas.index');
});
Route::get('nosotros',function(){

	return View::make('nosotros.index');
});