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

Route::get('/alpha', function () {
    return view('alpha');
});

Route::get('/beta', function () {
    return view('beta');
});

Route::group(['prefix' => 'tasks'], function () {
    Route::get('/{task}','TaskController@show');
    Route::post('/create', 'TaskController@create_task');
    Route::patch('{task}/complete', 'TaskController@mark_task_as_completed');
    Route::delete('/{id}', 'TaskController@destroy');
});