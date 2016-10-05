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
Route::group(['prefix'=>'admin'],function(){
	Route::get('/', function(){
		return view('admin.index');
	});
	Route::get('inicio', function(){
		return view('admin.index');
	})->name('admin.inicio');
	Route::resource('productos','ProductosController');

	Route::get('productos/{id}/destroy',[
			'uses'	=>	'ProductosController@destroy',
			'as'	=>	'admin.productos.destroy'
		]);
	Route::get('pacientes/pais',[
			'uses'	=>	'PacientesController@pais',
			'as'	=>	'admin.pacientes.pais'	
		]);
	Route::get('pacientes/estado',[
		'uses'	=>	'PacientesController@estado',
		'as'	=>	'admin.pacientes.estado'	
	]);
	Route::get('pacientes/ciudad',[
		'uses'	=>	'PacientesController@ciudad',
		'as'	=>	'admin.pacientes.ciudad'	
	]);
	Route::get('pacientes/medico',[
		'uses'	=> 'PacientesController@medico',
		'as'	=>	'admin.pacientes.medico'
	]);
	Route::get('pacientes/{id}/detalles',[
		'uses'	=>	'PacientesController@detalle',
		'as'	=>	'admin.pacientes.detalles'
	]);
	Route::resource('pacientes','PacientesController');

	Route::get('pacientes/{id}/destroy',[
		'uses'	=>	'PacientesController@destroy',
		'as'	=>	'admin.pacientes.destroy'
	]);

	Route::resource('usuarios','UsuariosController');
	Route::resource('pedidos','PedidosController');
});