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
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::get('groups','GroupController@index')->name('groups.index');
        Route::get('create','GroupController@create')->name('groups.create');
        Route::post('create','GroupController@store')->name('groups.store');
        Route::post('show','GroupController@store_activity')->name('groups.store_activity');
    });
    Route::get('groupshow/{id}','GroupController@show')->name('groups.show');

    Route::group(['prefix' => 'groups/{id}'], function () {
        Route::post('join', 'JoinController@store')->name('group.join');
        Route::delete('quit', 'JoinController@destroy')->name('group.quit');
    });
    Route::resource('users','UserController');
});
