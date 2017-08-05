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

	Route::post('usuarios/change_password', [
		'uses' => 'UsuariosController@change_password',
		'as' => 'admin.usuarios.change_password'
		]);

	Route::get('usuarios/busqueda', [
		'uses' => 'UsuariosController@busqueda',
		'as' => 'admin.usuarios.busqueda'
		]);

	Route::resource('usuarios','UsuariosController');

	Route::get('usuarios/{id}/destroy', [
		'uses' => 'UsuariosController@destroy',
		'as' => 'admin.usuarios.destroy'
		]); // se debe declarar despues del resource

	/*
	| Rutas Sucursales
	*/
	Route::get('sucursales/busqueda', [
		'uses' => 'SucursalesController@busqueda',
		'as' => 'admin.sucursales.busqueda'
		]);

	Route::resource('sucursales','SucursalesController');

	
	Route::get('sucursales/{id}/destroy', [
		'uses' => 'SucursalesController@destroy',
		'as' => 'admin.sucursales.destroy'
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
Route::group(['prefix'=>'sucursal', 'middleware' => ['auth', 'sucursal']],function(){
	/*
	*	Ruta principal
	*/
	Route::get('/', function(){
		return view('sucursal.index');
	});
	Route::get('inicio', function(){
		return view('sucursal.index');
	})->name('sucursal.inicio');
	/*
	| Rutas pacientes
	*/
	Route::GET('pacientes/busqueda_index',[
		'uses'	=>	'PacientesSucursalController@busqueda_index',
		'as'	=>	'sucursal.pacientes.busqueda_index'
		]);
	Route::resource('pacientes','PacientesSucursalController');
	Route::get('pacientes/{id}/destroy',[
		'uses'	=>	'PacientesSucursalController@destroy',
		'as'	=>	'sucursal.pacientes.destroy'
		]);
	/*
	| Rutas Médicos
	*/
	Route::get('medicos/pais', [
		'uses' => 'MedicosSucursalController@pais',
		'as' => 'sucursal.medicos.pais'
		]);

	Route::get('medicos/estado', [
		'uses' => 'MedicosSucursalController@estado',
		'as' => 'sucursal.medicos.estado'
		]);

	Route::get('medicos/municipio', [
		'uses' => 'MedicosSucursalController@municipio',
		'as' => 'sucursal.medicos.municipio'
		]);

	Route::get('medicos/banco', [
		'uses' => 'MedicosSucursalController@banco',
		'as' => 'sucursal.medicos.banco'
		]);
	Route::get('medicos/busqueda', [
		'uses' => 'MedicosSucursalController@busqueda',
		'as' => 'sucursal.medicos.busqueda'
		]);

	Route::resource('medicos','MedicosSucursalController');

	Route::get('medicos/{id}/destroy',[
		'uses'	=>	'MedicosSucursalController@destroy',
		'as'	=>	'sucursal.medicos.destroy'
		]);
	/*
	/*
	| Rutas productos
	*/
	Route::resource('productos','ProductosSucursalController');
	/*
	| Rutas pedidos
	*/
	Route::post('pedidos/estado',[
		'uses' 	=>	'PedidosSucursalController@estado',
		'as'	=>	'sucursal.pedidos.estado'
		]);
	Route::post('pedidos/estado',[
		'uses' 	=>	'PedidosSucursalController@estado',
		'as'	=>	'sucursal.pedidos.estado'
		]);
	Route::get('pedidos/{data}/busqueda_pacientes',[
		'uses'	=>	'PedidosSucursalController@busqueda_pacientes',
		'as'	=>	'sucursal.pedidos.busqueda_pacientes'
		]);
	Route::POST('pedidos/forma_pago', [
		'uses'	=>	'PedidosSucursalController@forma_pago',
		'as'	=>	'sucursal.pedidos.forma_pago'
		]);
	Route::POST('pedidos/confirmar',[
		'uses'	=>	'PedidosSucursalController@confirmacion',
		'as'	=>	'sucursal.pedidos.confirmacion'
		]);
	Route::GET('pedidos/busqueda_index',[
		'uses'	=>	'PedidosSucursalController@busqueda_index',
		'as'	=>	'sucursal.pedidos.busqueda_index'
		]);
	Route::resource('pedidos','PedidosSucursalController');
});

/*
| Rutas para Médico
*/

Route::group(['prefix' => 'medico'], function(){
	/*
	*	Ruta principal
	*/
	Route::get('/', function(){
		return view('medico.index');
	})->name('medico');
});
/*
| Rutas para login
*/
Route::get('/login', [
	'uses' 	=>	'Auth\AuthController@getLogin',
	'as'	=>	'login'
	]);

Route::post('/login', [
	'uses' 	=>	'Auth\AuthController@postLogin',
	'as'	=>	'login'
	]);

Route::get('/logout', [
	'uses' 	=>	'Auth\AuthController@getLogout',
	'as'	=>	'logout'
	]);