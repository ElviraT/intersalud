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
	Route::get('/home', 'HomeController@index')->middleware('can:home')->name('home');

	//CONFIGURACIÓN-ROLES
	Route::get('rol', ['as' => 'rol', 'uses' => 'Admin\configuracion\RolController@index']);
	Route::get('rol/create', ['as' => 'rol.create', 'uses' => 'Admin\configuracion\RolController@create']);
	Route::post('rol/add', ['as' => 'rol.add', 'uses' => 'Admin\configuracion\RolController@add']);
	Route::get('rol/edit/{role}', ['as' => 'rol.edit', 'uses' => 'Admin\configuracion\RolController@edit']);
	Route::put('rol/update/{role}', ['as' => 'rol.update', 'uses' => 'Admin\configuracion\RolController@update']);
	Route::post('rol/destroy', ['as' => 'rol.destroy', 'uses' => 'Admin\configuracion\RolController@destroy']);

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

	//CONFIGURACIÓN-STATUS-STATUS FACTURA
	Route::get('status_f', ['as' => 'status_f', 'uses' => 'Admin\configuracion\status\StatusFController@index']);
	Route::post('status_f/add', ['as' => 'status_f.add', 'uses' => 'Admin\configuracion\status\StatusFController@add']);
	Route::get('status_f/edit', ['as' => 'status_f.edit', 'uses' => 'Admin\configuracion\status\StatusFController@edit']);
	Route::post('status_f/destroy', ['as' => 'status_f.destroy', 'uses' => 'Admin\configuracion\status\StatusFController@destroy']);

	//CONFIGURACIÓN-STATUS-STATUS TASAS
	Route::get('status_t', ['as' => 'status_t', 'uses' => 'Admin\configuracion\status\StatusTController@index']);
	Route::post('status_t/add', ['as' => 'status_t.add', 'uses' => 'Admin\configuracion\status\StatusTController@add']);
	Route::get('status_t/edit', ['as' => 'status_t.edit', 'uses' => 'Admin\configuracion\status\StatusTController@edit']);
	Route::post('status_t/destroy', ['as' => 'status_t.destroy', 'uses' => 'Admin\configuracion\status\StatusTController@destroy']);

	//CONFIGURACIÓN-STATUS-STATUS
	Route::get('status', ['as' => 'status', 'uses' => 'Admin\configuracion\status\StatusController@index']);
	Route::post('status/add', ['as' => 'status.add', 'uses' => 'Admin\configuracion\status\StatusController@add']);
	Route::get('status/edit', ['as' => 'status.edit', 'uses' => 'Admin\configuracion\status\StatusController@edit']);
	Route::post('status/destroy', ['as' => 'status.destroy', 'uses' => 'Admin\configuracion\status\StatusController@destroy']);

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

	//CONFIGURACIÓN-USUARIOS-ASISTENTE
	Route::get('usuario_a', ['as' => 'usuario_a', 'uses' => 'Admin\configuracion\usuarios\UsuarioAController@index']);
	Route::get('usuario_a/create', ['as' => 'usuario_a.create', 'uses' => 'Admin\configuracion\usuarios\UsuarioAController@create']);
	Route::post('usuario_a/add', ['as' => 'usuario_a.add', 'uses' => 'Admin\configuracion\usuarios\UsuarioAController@add']);
	Route::get('usuario_a/edit/{id}', ['as' => 'usuario_a.edit', 'uses' => 'Admin\configuracion\usuarios\UsuarioAController@edit']);
	Route::post('usuario_a/update', ['as' => 'usuario_a.update', 'uses' => 'Admin\configuracion\usuarios\UsuarioAController@update']);
	Route::post('usuario_a/login', ['as' => 'usuario_a.login', 'uses' => 'Admin\configuracion\usuarios\UsuarioAController@login']);
	Route::post('usuario_a/destroy', ['as' => 'usuario_a.destroy', 'uses' => 'Admin\configuracion\usuarios\UsuarioAController@destroy']);

	//CONFIGURACIÓN-USUARIOS-PACIENTES
	Route::get('usuario_p', ['as' => 'usuario_p', 'uses' => 'Admin\configuracion\usuarios\UsuarioPController@index']);
	Route::get('usuario_p/create', ['as' => 'usuario_p.create', 'uses' => 'Admin\configuracion\usuarios\UsuarioPController@create']);
	Route::post('usuario_p/add', ['as' => 'usuario_p.add', 'uses' => 'Admin\configuracion\usuarios\UsuarioPController@add']);
	Route::get('usuario_p/edit/{id}', ['as' => 'usuario_p.edit', 'uses' => 'Admin\configuracion\usuarios\UsuarioPController@edit']);
	Route::post('usuario_p/update', ['as' => 'usuario_p.update', 'uses' => 'Admin\configuracion\usuarios\UsuarioPController@update']);
	Route::post('usuario_p/login', ['as' => 'usuario_p.login', 'uses' => 'Admin\configuracion\usuarios\UsuarioPController@login']);
	Route::post('usuario_p/destroy', ['as' => 'usuario_p.destroy', 'uses' => 'Admin\configuracion\usuarios\UsuarioPController@destroy']);

	//CONFIGURACIÓN-BANCOS
	Route::get('banco', ['as' => 'banco', 'uses' => 'Admin\configuracion\BancosController@index']);
	Route::post('banco/add', ['as' => 'banco.add', 'uses' => 'Admin\configuracion\BancosController@add']);
	Route::get('banco/edit', ['as' => 'banco.edit', 'uses' => 'Admin\configuracion\BancosController@edit']);
	Route::post('banco/destroy', ['as' => 'banco.destroy', 'uses' => 'Admin\configuracion\BancosController@destroy']);

	//CONFIGURACIÓN-TIPOS DE CUENTAS
	Route::get('tipoC', ['as' => 'tipoC', 'uses' => 'Admin\configuracion\TipoCuentaController@index']);
	Route::post('tipoC/add', ['as' => 'tipoC.add', 'uses' => 'Admin\configuracion\TipoCuentaController@add']);
	Route::get('tipoC/edit', ['as' => 'tipoC.edit', 'uses' => 'Admin\configuracion\TipoCuentaController@edit']);
	Route::post('tipoC/destroy', ['as' => 'tipoC.destroy', 'uses' => 'Admin\configuracion\TipoCuentaController@destroy']);

	//CONFIGURACIÓN-CRIPTO
	Route::get('cripto', ['as' => 'cripto', 'uses' => 'Admin\configuracion\CriptosController@index']);
	Route::post('cripto/add', ['as' => 'cripto.add', 'uses' => 'Admin\configuracion\CriptosController@add']);
	Route::get('cripto/edit', ['as' => 'cripto.edit', 'uses' => 'Admin\configuracion\CriptosController@edit']);
	Route::post('cripto/destroy', ['as' => 'cripto.destroy', 'uses' => 'Admin\configuracion\CriptosController@destroy']);

	//CONFIGURACIÓN-BILLETERAS CRIPTO
	Route::get('billetera', ['as' => 'billetera', 'uses' => 'Admin\configuracion\BilleteraCriptosController@index']);
	Route::post('billetera/add', ['as' => 'billetera.add', 'uses' => 'Admin\configuracion\BilleteraCriptosController@add']);
	Route::get('billetera/edit', ['as' => 'billetera.edit', 'uses' => 'Admin\configuracion\BilleteraCriptosController@edit']);
	Route::post('billetera/destroy', ['as' => 'billetera.destroy', 'uses' => 'Admin\configuracion\BilleteraCriptosController@destroy']);

	//CONFIGURACIÓN-CUENTA-BANCO BS
	Route::get('cuenta_banco', ['as' => 'cuenta_banco', 'uses' => 'Admin\configuracion\CuentaBancoController@index']);
	Route::post('cuenta_banco/add', ['as' => 'cuenta_banco.add', 'uses' => 'Admin\configuracion\CuentaBancoController@add']);
	Route::get('cuenta_banco/edit', ['as' => 'cuenta_banco.edit', 'uses' => 'Admin\configuracion\CuentaBancoController@edit']);
	Route::post('cuenta_banco/destroy', ['as' => 'cuenta_banco.destroy', 'uses' => 'Admin\configuracion\CuentaBancoController@destroy']);

	//CONFIGURACIÓN-CUENTA-USD
	Route::get('cuentaUSD', ['as' => 'cuentaUSD', 'uses' => 'Admin\configuracion\CuentaUSDController@index']);
	Route::post('cuentaUSD/add', ['as' => 'cuentaUSD.add', 'uses' => 'Admin\configuracion\CuentaUSDController@add']);
	Route::get('cuentaUSD/edit', ['as' => 'cuentaUSD.edit', 'uses' => 'Admin\configuracion\CuentaUSDController@edit']);
	Route::post('cuentaUSD/destroy', ['as' => 'cuentaUSD.destroy', 'uses' => 'Admin\configuracion\CuentaUSDController@destroy']);

	//CONFIGURACIÓN-CUENTA-ENTIDADES USD
	Route::get('entidad', ['as' => 'entidad', 'uses' => 'Admin\configuracion\EntidadesUSDController@index']);
	Route::post('entidad/add', ['as' => 'entidad.add', 'uses' => 'Admin\configuracion\EntidadesUSDController@add']);
	Route::get('entidad/edit', ['as' => 'entidad.edit', 'uses' => 'Admin\configuracion\EntidadesUSDController@edit']);
	Route::post('entidad/destroy', ['as' => 'entidad.destroy', 'uses' => 'Admin\configuracion\EntidadesUSDController@destroy']);

	//CONFIGURACIÓN-CONFG. MEDICOS- ESPECIALIDAD MEDICA
	Route::get('especialidad', ['as' => 'especialidad', 'uses' => 'Admin\configuracion\EspecialidadController@index']);
	Route::post('especialidad/add', ['as' => 'especialidad.add', 'uses' => 'Admin\configuracion\EspecialidadController@add']);
	Route::get('especialidad/edit', ['as' => 'especialidad.edit', 'uses' => 'Admin\configuracion\EspecialidadController@edit']);
	Route::post('especialidad/destroy', ['as' => 'especialidad.destroy', 'uses' => 'Admin\configuracion\EspecialidadController@destroy']);

	//CONFIGURACIÓN-CONFG. MEDICOS - CONSULTORIOS
	Route::get('consultorio', ['as' => 'consultorio', 'uses' => 'Admin\configuracion\ConsultorioController@index']);
	Route::post('consultorio/add', ['as' => 'consultorio.add', 'uses' => 'Admin\configuracion\ConsultorioController@add']);
	Route::get('consultorio/edit', ['as' => 'consultorio.edit', 'uses' => 'Admin\configuracion\ConsultorioController@edit']);
	Route::post('consultorio/destroy', ['as' => 'consultorio.destroy', 'uses' => 'Admin\configuracion\ConsultorioController@destroy']);

	/*HISTORIAS CLINICAS - UROLOGIA*/
	Route::get('historias/urologia', ['as' => 'urologia', 'uses' => 'Admin\historias\UrologiaController@index']);
	Route::get('historias/urologia/create', ['as' => 'urologia.create', 'uses' => 'Admin\historias\UrologiaController@create']);
	Route::post('historias/urologia/add', ['as' => 'urologia.add', 'uses' => 'Admin\historias\UrologiaController@add']);
	Route::get('historias/urologia/edit', ['as' => 'urologia.edit', 'uses' => 'Admin\historias\UrologiaController@edit']);
	Route::post('historias/urologia/destroy', ['as' => 'urologia.destroy', 'uses' => 'Admin\historias\UrologiaController@destroy']);


});