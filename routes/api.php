<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', 'User\UserController@getUser');

Route::resource('users', 'User\UserController', ['except'=>['create', 'edit']]);

Route::post('login', 'User\UserController@login')->name('login');

Route::middleware('auth:api')->post('/password','User\UserController@changePassword');

Route::middleware('auth:api')->resource('fiscales', 'Api\User\UserDomFiscalController', ['except'=>['create','show','edit']]);

Route::middleware('auth:api')->resource('domicilios', 'Api\User\UserDomEnvioController', ['except'=>['create','edit']]);

Route::middleware('auth:api')->resource('cards', 'Api\User\UserTarjetasController', ['except'=>['create','update','edit']]);
Route::middleware('auth:api')->resource('motos','Api\User\UserMotoController',['except'=>['create','edit']]);
Route::middleware('auth:api')->resource('motos.fotomotos','Api\User\UserMotoFotoMotoController',['except'=>['create','edit']]);
Route::middleware('auth:api')->resource('productos','Api\User\UserProductosController', ['except'=>['create','edit','show']]);
Route::get('marcas','Api\Moto\MarcaController@index');
Route::get('marcas/{marca}/modelos','Api\Moto\MarcaModeloController@index');
Route::get('modelos/{modelo}/versions','Api\Moto\ModeloVersionController@index');
// Route::post('register','User\UserController@store')->name('register');