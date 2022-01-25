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