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
        Route::post('groups','GroupController@store')->name('groups.store');
        Route::post('show','GroupController@store_activity')->name('groups.store_activity');
    });
    Route::get('search','GroupController@search')->name('groups.search');

    Route::group(['prefix' => 'groups/{id}'], function () {
        Route::get('show','GroupController@show')->name('groups.show');
        Route::delete('delete','GroupController@destroy')->name('group.delete');
        Route::post('join', 'JoinController@store')->name('group.join');
        Route::delete('quit', 'JoinController@destroy')->name('group.quit');
        Route::put('update', 'GroupController@update')->name('group.update');
        Route::get('edit', 'GroupController@edit')->name('group.edit');
        Route::get('requests/{request_id}', 'JoinController@admit')->name('join.admit');
        Route::get('requests', 'JoinController@index')->name('join.index');
        Route::put('cancel', 'JoinController@cancel')->name('join.cancel');
    });
    Route::resource('users','UserController');
});
