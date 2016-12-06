<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'MueveteController@index');
Route::get('/home', 'MueveteController@index');


Route::get('/register','MueveteController@register');
Route::post('/register/user','UserController@create');


Route::get('/como-funciona','MueveteController@comoFunciona');

Route::get('/que-es','MueveteController@queEs');

Auth::routes();

//Route::get('/home', 'HomeController@index');
Route::get('mi-cuenta/perfil','HomeController@perfil');

Route::get('publicar','HomeController@publicarViaje');

Route::post('publicar/viaje','HomeController@createViaje');

Route::get('mi-cuenta/mis-viajes-publicados','HomeController@viajesPublicados');
Route::get('mi-cuenta/mis-viajes-pasajero','HomeController@viajesPasajero');

Route::get('viajes/busqueda','MueveteController@buscarViaje');

