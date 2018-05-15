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

// Route::post('register','User\UserController@store')->name('register');