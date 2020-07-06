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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('usuarios', 'userController');

Route::resource('reportes','ReportesController');

Route::get('reportes/agua/crear','ReportesController@crearReporteAgua');

Route::get('reportes/compresor/crear','ReportesController@crearReporteCompresor');

Route::get('reportes/deshechos/crear','ReportesController@crearReporteDeshechos');

Route::get('reportes/agua/ver','ReportesController@verReporteAgua');

Route::get('reportes/compresor/ver','ReportesController@verReporteCompresor');

Route::get('reportes/deshechos/ver','ReportesController@verReporteDeshechos');

Route::resource('/notas/todas','NotasController');

Route::get('/notas/favoritas','NotasController@favoritas');

Route::get('/notas/archivadas','NotasController@archivadas');