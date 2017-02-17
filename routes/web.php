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

//Usuario
Route::post('/register/user','UserController@create');
Route::post('/profile/update/picture','UserController@profilePicture');
Route::post('/profile/update/phone','UserController@updatePhone');
Route::post('/profile/update/email','UserController@updateEmail');
Route::post('/profile/update/password','UserController@updatePassword');
Route::post('/profile/create/password','UserController@createPassword');
Route::post('/profile/create/cedula','UserController@createCedula');
Route::post('/profile/vehicle/create','UserController@createVehicle');
Route::post('/profile/vehicle/delete','UserController@deleteVehicle');

Route::get('/como-funciona','MueveteController@comoFunciona');

Route::get('/que-es','MueveteController@queEs');

Auth::routes();

//Route::get('/home', 'HomeController@index');
Route::get('mi-cuenta/perfil','HomeController@perfil');

Route::get('publicar','HomeController@publicarViaje');

Route::post('publicar/viaje','HomeController@createViaje');
Route::post('eliminar/viaje','HomeController@deleteViaje');

Route::get('mi-cuenta/mis-viajes-publicados','HomeController@viajesPublicados');
Route::get('mi-cuenta/mis-viajes-pasajero','HomeController@viajesPasajero');
Route::get('mi-cuenta/calificaciones-enviadas','HomeController@calificacionesEnviadas');
Route::get('mi-cuenta/calificaciones-recibidas','HomeController@calificacionesRecibidas');
Route::get('mi-cuenta/notificaciones','HomeController@notificaciones');

Route::get('viajes/busqueda','MueveteController@buscarViaje');

Route::get('viajes/id/{id}','MueveteController@verViaje')->where('id','[0-9]+');


//Preguntas y Respuestas
Route::post('viajes/id/{id}/preguntas/create','PreguntasController@create')->where('id','[0-9]+');
Route::post('viajes/id/{id}/respuestas/create','PreguntasController@reply')->where('id','[0-9]+');
Route::post('viajes/id/{id}/preguntas/delete','PreguntasController@deletePregunta')->where('id','[0-9]+');
Route::post('viajes/id/{id}/respuestas/delete','PreguntasController@deleteRespuesta')->where('id','[0-9]+');

//Reservas
Route::post('viajes/id/{id}/reservas/create','ReservasController@create')->where('id','[0-9]+');
Route::post('mi-cuenta/reservas/aceptar','ReservasController@aceptar')->where('id','[0-9]+');
Route::post('mi-cuenta/reservas/rechazar','ReservasController@rechazar')->where('id','[0-9]+');
Route::post('mi-cuenta/reservas/cancelar','ReservasController@cancelar')->where('id','[0-9]+');

//Socialite
Route::get('auth/facebook', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallback');

//PerfilPublico
Route::get('public/perfil/{id}','UserController@publicProfile')->where('id','[0-9]+');