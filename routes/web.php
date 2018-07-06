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

Route::get('/', function () {
    return view('welcome');
});

// make:authのコマンドで自動で作られた
Auth::routes();
//仮
Route::get('logout','Auth\LoginController@logout')->name('logout.get');
//
Route::get('groups','GroupController@index');
