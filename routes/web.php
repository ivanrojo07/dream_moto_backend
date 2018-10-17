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
Route::get('servicios',function(){
	return View::make('servicios.index');
})->name("servicios");
Route::get('servicios/create',function(){
	return View::make('servicios.create');
});

// VUEJS
Route::prefix('precargas')->group(function(){
	Route::get('revisiones','Web\Precargas\RevisionController@getRevisiones')->name('revisiones');
	Route::get('refacciones','Web\Precargas\RefaccionController@getRefacciones')->name('refacciones');
	Route::resource('revision', 'Web\Precargas\RevisionController');
	Route::resource('refaccion','Web\Precargas\RefaccionController');
});
Route::get('getService','Web\Servicio\ServicioController@index');
Route::post('searchUser','User\UserController@searchEmail');
Route::post('saveUser','User\UserController@saveUser');
Route::post('user/{user}/searchMoto', 'User\UserController@searchMoto');
Route::post('user/{user}/saveMoto','User\UserController@saveMoto');
Route::post('saveService','Web\Servicio\ServicioController@store');
Route::put('updateService/{servicio}','Web\Servicio\ServicioController@update');
Route::post('inServicio/{servicio}/revision','Web\Servicio\ServicioController@setRevision');
Route::post('inServicio/{servicio}/refaccion','Web\Servicio\ServicioController@setRefaccion');
Route::delete('inServicio/{servicio}/delete/{inServicio}', "Web\Servicio\ServicioController@deleteInServicio");
// fin vue
Route::resource('tiendas','Web\Tienda\TiendaController');
Route::resource('tiendas.productos','Web\Tienda\TiendaProductoController');
Route::resource('tiendas.productos.fotos','Web\Tienda\TiendaProductoFotoController',['only'=>['index','destroy']]);
Route::resource('handbooks','Web\Handbook\HandbookController');