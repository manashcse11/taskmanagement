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
Route::get('/', 'TaskController@index')->name('home');
Route::resource('projects', 'ProjectController');
Route::get('projects/{project}/delete', 'ProjectController@delete')->name('projects.delete'); // Manually delete using GET method
Route::get('projects/{project}/task', 'ProjectController@tasks')->name('tasks_by_project');
//Route::get('/', function () {
//    return view('welcome');
//});
