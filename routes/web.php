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

// Index
Route::get('/', 'IndexController@index')->name('index');

// Auth Routes
Auth::routes();

// Tareas Lista Individual
Route::get('/home', 'HomeController@index')->name('home');

// Vista para crear tarea
Route::get('/crear-tarea', function() {
    return view('crear-tarea');
})->name('crear-tarea')->middleware('auth');

// API (CRUD)
Route::apiResource('tarea', 'TareaController');
