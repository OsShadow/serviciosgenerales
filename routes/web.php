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

Route::resource('reportes/compresor','compresorController');

Route::resource('reportes/agua','waterController');

Route::resource('reportes/desechos','trashController');

Route::resource('emergencias','emergenciesController');

