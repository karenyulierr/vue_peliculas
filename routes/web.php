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


Route::resource('/','App\Http\Controllers\PeliculasController');
Route::get('/getCategorias', 'App\Http\Controllers\CategoriasController@getCategorias')->name('getCategorias');
Route::get('/getPeliculas','App\Http\Controllers\PeliculasController@getPeliculas');
Route::get('/getCalificar/{id}', 'App\Http\Controllers\PeliculasController@getCalificar')->name('getCalificar');
Route::post('/calificar', 'App\Http\Controllers\PeliculasController@calificar')->name('calificar');
Route::get('/getCalificaciones','App\Http\Controllers\PeliculasController@getCalificaciones');
Route::post('/crearPelicula', 'App\Http\Controllers\PeliculasController@crearPelicula')->name('crearPelicula');
Route::post('/aregar_categoria', 'App\Http\Controllers\CategoriasController@aregar_categoria')->name('calificar');
Route::get('/getAgregar/{id}', 'App\Http\Controllers\CategoriasController@getAgregar')->name('getAgregar');
Route::get('/getListaCategorias','App\Http\Controllers\CategoriasController@getListaCategorias');

