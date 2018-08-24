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

Route::get('/panel', function () {
    return view('panel');
});

Route::get('/prueba', function () {
    return view('prueba');
});

Route::resource('usuario','UsuarioController');
Route::post('login/{email}','UsuarioController@muestra');
Route::post('historial/{id}','SolicitudController@historial');

