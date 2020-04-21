<?php

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
Route::resource('tasks', 'TaskController');
Route::get('/', 'TaskController@index')->name('home');
Route::get('tasks/{task}/delete', 'TaskController@delete')->name('tasks.delete'); // Manually delete using GET method
Route::resource('projects', 'ProjectController');
Route::get('projects/{project}/delete', 'ProjectController@delete')->name('projects.delete'); // Manually delete using GET method
//Route::get('/', function () {
//    return view('welcome');
//});
