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
/*
| Rutas para administrador
*/
Route::group(['prefix'=>'admin'],function(){

	Route::get('/', function(){
		return view('admin.index');
	});

	Route::get('inicio', function(){
		return view('admin.index');
	})->name('admin.inicio');

	/*
	| Rutas para productos
	*/

	Route::resource('productos','ProductosController');

	Route::get('productos/{id}/destroy',[
		'uses'	=>	'ProductosController@destroy',
		'as'	=>	'admin.productos.destroy'
		]);

	/*
	| Rutas para pacientes
	*/

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

	Route::get('pacientes/{id}/medico',[
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

	/*
	| Rutas para usuarios
	*/

	Route::get('usuarios/pais', [
		'uses' => 'UsuariosController@pais',
		'as' => 'admin.usuarios.pais'
		]);

	Route::get('usuarios/estado', [
		'uses' => 'UsuariosController@estado',
		'as' => 'admin.usuarios.estado'
		]);

	Route::get('usuarios/municipio', [
		'uses' => 'UsuariosController@municipio',
		'as' => 'admin.usuarios.municipio'
		]);

	Route::get('usuarios/banco', [
		'uses' => 'UsuariosController@banco',
		'as' => 'admin.usuarios.banco'
		]);

	Route::get('usuarios/medicos',[
		'uses' => 'UsuariosController@medicos',
		'as' => 'admin.usuarios.medicos'
 		]);
	
	Route::get('usuarios/adminsucursal', [
		'uses' => 'UsuariosController@adminsucursal',
		'as' => 'admin.usuarios.adminsucursal'
		]);

	Route::get('usuarios/{id}/adminsucursal_edit', [
		'uses' => 'UsuariosController@adminsucursal_edit',
		'as' => 'admin.usuarios.adminsucursal_edit'
		]);

	Route::resource('usuarios','UsuariosController');

	Route::get('usuarios/{id}/destroy', [
		'uses' => 'UsuariosController@destroy',
		'as' => 'admin.usuarios.destroy'
		]); // se debe declarar despues del resource

	/*
	| Rutas pedidos
	*/
	Route::post('pedidos/estado',[
		'uses' 	=>	'PedidosController@estado',
		'as'	=>	'admin.pedidos.estado'
		]);
	Route::get('pedidos/{data}/productos',[
		'uses'	=>	'PedidosController@productos',
		'as'	=>	'admin.pedidos.productos'
		]);
	Route::POST('pedidos/confirmar',[
		'uses'	=>	'PedidosController@confirmacion',
		'as'	=>	'admin.pedidos.confirmacion'
		]);
	Route::POST('pedidos/forma_pago', [
		'uses'	=>	'PedidosController@forma_pago',
		'as'	=>	'admin.pedidos.forma_pago'
		]);

	Route::get('pedidos/{data}/busqueda_pacientes',[
			'uses'	=>	'PedidosController@busqueda_pacientes',
			'as'	=>	'admin.pedidos.busqueda_pacientes'
		]);
	Route::resource('pedidos','PedidosController');
});

/*
| Rutas para administrador de Sucursal
*/
Route::group(['prefix'=>'sucursal'],function(){
	/*
	*	Ruta principal
	*/
	Route::get('/', function(){
		return view('sucursal.index');
	});
	/*
	| Rutas pacientes
	*/
	Route::resource('pacientes','PacientesSucursalController');
	Route::get('pacientes/{id}/destroy',[
	'uses'	=>	'PacientesSucursalController@destroy',
	'as'	=>	'sucursal.pacientes.destroy'
	]);
	/*
	| Rutas productos
	*/
	Route::resource('productos','ProductosSucursalController');
});