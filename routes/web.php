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

	/*HISTORIAS CLINICAS - UROLOGIA*/
	Route::get('historias/urologia', ['as' => 'urologia', 'uses' => 'Admin\historias\UrologiaController@index']);
	Route::get('historias/urologia/create', ['as' => 'urologia.create', 'uses' => 'Admin\historias\UrologiaController@create']);
	Route::post('historias/urologia/add', ['as' => 'urologia.add', 'uses' => 'Admin\historias\UrologiaController@add']);
	Route::get('historias/urologia/edit', ['as' => 'urologia.edit', 'uses' => 'Admin\historias\UrologiaController@edit']);
	Route::post('historias/urologia/destroy', ['as' => 'urologia.destroy', 'uses' => 'Admin\historias\UrologiaController@destroy']);


});