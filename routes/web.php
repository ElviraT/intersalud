<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth'], function () {
	/*DASHBOARD*/
	Route::get('/home', 'HomeController@index')->name('home');
	//CONFIGURACIÓN-DIRECCIÓN-PAIS
	Route::get('pais', ['as' => 'pais', 'uses' => 'Admin\configuracion\direccion\PaisController@index']);
	Route::post('pais/add', ['as' => 'pais.add', 'uses' => 'Admin\configuracion\direccion\PaisController@add']);
	Route::get('pais/edit', ['as' => 'pais.edit', 'uses' => 'Admin\configuracion\direccion\PaisController@edit']);
	Route::post('pais/destroy', ['as' => 'pais.destroy', 'uses' => 'Admin\configuracion\direccion\PaisController@destroy']);

	//CONFIGURACIÓN-DIRECCIÓN-ESTADO
	Route::get('estado', ['as' => 'estado', 'uses' => 'Admin\configuracion\direccion\EstadoController@index']);
	Route::post('estado/add', ['as' => 'estado.add', 'uses' => 'Admin\configuracion\direccion\EstadoController@add']);
	Route::get('estado/edit', ['as' => 'estado.edit', 'uses' => 'Admin\configuracion\direccion\EstadoController@edit']);
	Route::post('estado/destroy', ['as' => 'estado.destroy', 'uses' => 'Admin\configuracion\direccion\EstadoController@destroy']);

	//CONFIGURACIÓN-DIRECCIÓN-CIUDAD
	Route::get('ciudad', ['as' => 'ciudad', 'uses' => 'Admin\configuracion\direccion\CiudadController@index']);
	Route::post('ciudad/add', ['as' => 'ciudad.add', 'uses' => 'Admin\configuracion\direccion\CiudadController@add']);
	Route::get('ciudad/edit', ['as' => 'ciudad.edit', 'uses' => 'Admin\configuracion\direccion\CiudadController@edit']);
	Route::post('ciudad/destroy', ['as' => 'ciudad.destroy', 'uses' => 'Admin\configuracion\direccion\CiudadController@destroy']);

	//CONFIGURACIÓN-DIRECCIÓN-MUNICIPIO
	Route::get('municipio', ['as' => 'municipio', 'uses' => 'Admin\configuracion\direccion\MunicipioController@index']);
	Route::post('municipio/add', ['as' => 'municipio.add', 'uses' => 'Admin\configuracion\direccion\MunicipioController@add']);
	Route::get('municipio/edit', ['as' => 'municipio.edit', 'uses' => 'Admin\configuracion\direccion\MunicipioController@edit']);
	Route::post('municipio/destroy', ['as' => 'municipio.destroy', 'uses' => 'Admin\configuracion\direccion\MunicipioController@destroy']);

	//CONFIGURACIÓN-DIRECCIÓN-PARROQUIA
	Route::get('parroquia', ['as' => 'parroquia', 'uses' => 'Admin\configuracion\direccion\ParroquiaController@index']);
	Route::post('parroquia/add', ['as' => 'parroquia.add', 'uses' => 'Admin\configuracion\direccion\ParroquiaController@add']);
	Route::get('parroquia/edit', ['as' => 'parroquia.edit', 'uses' => 'Admin\configuracion\direccion\ParroquiaController@edit']);
	Route::post('parroquia/destroy', ['as' => 'parroquia.destroy', 'uses' => 'Admin\configuracion\direccion\ParroquiaController@destroy']);

	//CONFIGURACIÓN-PREFIJO DNI
	Route::get('prefijo', ['as' => 'prefijo', 'uses' => 'Admin\configuracion\PrefijoDniController@index']);
	Route::post('prefijo/add', ['as' => 'prefijo.add', 'uses' => 'Admin\configuracion\PrefijoDniController@add']);
	Route::get('prefijo/edit', ['as' => 'prefijo.edit', 'uses' => 'Admin\configuracion\PrefijoDniController@edit']);
	Route::post('prefijo/destroy', ['as' => 'prefijo.destroy', 'uses' => 'Admin\configuracion\PrefijoDniController@destroy']);

	//CONFIGURACIÓN-SEXO
	Route::get('sexo', ['as' => 'sexo', 'uses' => 'Admin\configuracion\SexoController@index']);
	Route::post('sexo/add', ['as' => 'sexo.add', 'uses' => 'Admin\configuracion\SexoController@add']);
	Route::get('sexo/edit', ['as' => 'sexo.edit', 'uses' => 'Admin\configuracion\SexoController@edit']);
	Route::post('sexo/destroy', ['as' => 'sexo.destroy', 'uses' => 'Admin\configuracion\SexoController@destroy']);

	//CONFIGURACIÓN-ESTADO CIVIL
	Route::get('civil', ['as' => 'civil', 'uses' => 'Admin\configuracion\CivilController@index']);
	Route::post('civil/add', ['as' => 'civil.add', 'uses' => 'Admin\configuracion\CivilController@add']);
	Route::get('civil/edit', ['as' => 'civil.edit', 'uses' => 'Admin\configuracion\CivilController@edit']);
	Route::post('civil/destroy', ['as' => 'civil.destroy', 'uses' => 'Admin\configuracion\CivilController@destroy']);

	//CONFIGURACIÓN-STATUS-STATUS MEDICO
	Route::get('status_m', ['as' => 'status_m', 'uses' => 'Admin\configuracion\status\StatusMController@index']);
	Route::post('status_m/add', ['as' => 'status_m.add', 'uses' => 'Admin\configuracion\status\StatusMController@add']);
	Route::get('status_m/edit', ['as' => 'status_m.edit', 'uses' => 'Admin\configuracion\status\StatusMController@edit']);
	Route::post('status_m/destroy', ['as' => 'status_m.destroy', 'uses' => 'Admin\configuracion\status\StatusMController@destroy']);

	//CONFIGURACIÓN-STATUS-STATUS CONSULTA
	Route::get('status_c', ['as' => 'status_c', 'uses' => 'Admin\configuracion\status\StatusCController@index']);
	Route::post('status_c/add', ['as' => 'status_c.add', 'uses' => 'Admin\configuracion\status\StatusCController@add']);
	Route::get('status_c/edit', ['as' => 'status_c.edit', 'uses' => 'Admin\configuracion\status\StatusCController@edit']);
	Route::post('status_c/destroy', ['as' => 'status_c.destroy', 'uses' => 'Admin\configuracion\status\StatusCController@destroy']);

	//CONFIGURACIÓN-USUARIOS-MEDICO
	Route::get('usuario_m', ['as' => 'usuario_m', 'uses' => 'Admin\configuracion\usuarios\UsuarioMController@index']);
	Route::get('usuario_m/create', ['as' => 'usuario_m.create', 'uses' => 'Admin\configuracion\usuarios\UsuarioMController@create']);
	Route::post('usuario_m/add', ['as' => 'usuario_m.add', 'uses' => 'Admin\configuracion\usuarios\UsuarioMController@add']);
	Route::get('usuario_m/edit/{id}', ['as' => 'usuario_m.edit', 'uses' => 'Admin\configuracion\usuarios\UsuarioMController@edit']);
	
		//seniat-medico
		Route::post('usuario_m/seniat', ['as' => 'usuario_m.seniat', 'uses' => 'Admin\configuracion\usuarios\UsuarioMController@seniat']);
		Route::post('usuario_m/update-seniat', ['as' => 'usuario_m.update_seniat', 'uses' => 'Admin\configuracion\usuarios\UsuarioMController@update_seniat']);

		//login-medico
		Route::post('usuario_m/login', ['as' => 'usuario_m.login', 'uses' => 'Admin\configuracion\usuarios\UsuarioMController@login']);


	Route::post('usuario_m/destroy', ['as' => 'usuario_m.destroy', 'uses' => 'Admin\configuracion\usuarios\UsuarioMController@destroy']);

	/*HISTORIAS CLINICAS - UROLOGIA*/
	Route::get('historias/urologia', ['as' => 'urologia', 'uses' => 'Admin\historias\UrologiaController@index']);
	Route::get('historias/urologia/create', ['as' => 'urologia.create', 'uses' => 'Admin\historias\UrologiaController@create']);
	Route::post('historias/urologia/add', ['as' => 'urologia.add', 'uses' => 'Admin\historias\UrologiaController@add']);
	Route::get('historias/urologia/edit', ['as' => 'urologia.edit', 'uses' => 'Admin\historias\UrologiaController@edit']);
	Route::post('historias/urologia/destroy', ['as' => 'urologia.destroy', 'uses' => 'Admin\historias\UrologiaController@destroy']);


});