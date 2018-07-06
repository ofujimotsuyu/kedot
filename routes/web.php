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

// make:authのコマンドで自動で作られた　詳しくは '$php artisan route:list'
Auth::routes();

//navbarに入る機能だから仮に作った
Route::get('logout','Auth\LoginController@logout')->name('logout.get');

//グループ作成ページに飛ぶ
Route::group(['middleware' => ['auth']], function () { 
    Route::get('groups','GroupController@index');
    Route::get('create','GroupController@create')->name('groups.create');
    Route::post('create','GroupController@store')->name('groups.store');
});