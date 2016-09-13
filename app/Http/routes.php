<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('nombre/{nombre}', function($nombre){
	return "Hola mi nombre es ".$nombre;
});
Route::get('controlador','PruebaController@index');
Route::get('controlador/{nombre}','PruebaController@nombre');
Route::group(['prefix'=>'admin'],function(){
	/*Route::get('view/{id?}',[
			'uses'=>'PruebaController@id',
			'name'=>'Prueba'
		]);*/
	Route::resource('productos','ProductosController');
});