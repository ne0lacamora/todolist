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

// Formulario de tarea
Route::get('/home', 'HomeController@index')->name('home');

// Tareas generales
Route::get('/mis-tareas', 'TareaIndividualController@index')->name('mis-tareas');

// ...
Route::apiResource('tareas', 'TareaController');
