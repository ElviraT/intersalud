<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::match(['get','post'],'/ciudad.json', 'Controller@ciudad')->name('ciudad_dependiente');
Route::match(['get','post'],'/municipio.json', 'Controller@municipio')->name('municipio_dependiente');
Route::match(['get','post'],'/parroquia.json', 'Controller@parroquia')->name('parroquia_dependiente');
Route::match(['get','post'],'/especialidad.json', 'Controller@especialidad')->name('especialidad_dependiente');
Route::match(['get','post'],'/consultar_horario.json', 'Controller@consultar_horario')->name('consultar_horario');
Route::match(['get','post'],'/paciente_dependiente.json', 'Controller@paciente_especial')->name('paciente_dependiente');
Route::match(['get','post'],'/consultorio.json', 'Controller@consultorio')->name('consultorio_dependiente');
Route::match(['get','post'],'/datos_agenda.json', 'Controller@datos_agenda')->name('datos_agenda');
Route::match(['get','post'],'/horario_datos.json', 'Controller@horario_datos')->name('horario_datos');
Route::match(['get','post'],'/disponibilidad.json', 'Controller@disponibilidad')->name('disponibilidad');
Route::match(['get','post'],'/buscar_paciente.json', 'Admin\ConsultaOController@buscar_paciente')->name('buscar_paciente');
Route::match(['get','post'],'/buscarP.json', 'Admin\ConsultaController@buscarP')->name('buscarP');
Route::match(['get','post'],'/duracion_servicio.json', 'Controller@duracion_servicio')->name('duracion_servicio');
Route::match(['get','post'],'/paciente_medico.json', 'Controller@paciente_medico')->name('paciente_medico');
Route::match(['get','post'],'/paciente_datos.json', 'Controller@paciente_datos')->name('paciente_datos');