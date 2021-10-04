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
	/*HISTORIAS CLINICAS*/
	/*UROLOGIA*/
	Route::get('historias/urologia', ['as' => 'urologia', 'uses' => 'Admin\historias\UrologiaController@index']);
	Route::get('historias/urologia/create', ['as' => 'urologia.create', 'uses' => 'Admin\historias\UrologiaController@create']);
	Route::post('historias/urologia/add', ['as' => 'urologia.add', 'uses' => 'Admin\historias\UrologiaController@add']);
	Route::get('historias/urologia/edit', ['as' => 'urologia.edit', 'uses' => 'Admin\historias\UrologiaController@edit']);
	Route::post('historias/urologia/destroy', ['as' => 'urologia.destroy', 'uses' => 'Admin\historias\UrologiaController@destroy']);


});