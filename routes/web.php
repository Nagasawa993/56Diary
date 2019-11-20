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

// GET送信をしていて、かつ/だった場合
// このURLだったとき,この処理
Route::get('/', 'DiaryController@index')->name('diary.index');
//
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    //この中に書かれたルートはログインしていないと見れなくなる。
    Route::get('/diary/create', 'DiaryController@create')->name('diary.create');
    // Route::get('/diary/create', 'DiaryController@create')->('好きな名前');
    Route::post('/diary/store', 'DiaryController@store')->name('diary.store');
    Route::delete('/diary/{id}', 'DiaryController@destroy')->name('diary.destroy');
    // {}は中身を置き換えてねの意味
    Route::get('/diary/{diary}/edit', 'DiaryController@edit')->name('diary.edit');
    Route::put('/diary/{id}/update', 'DiaryController@update')->name('diary.update');
    // deleteは削除、putは更新
    
    Route::post('/diary/{id}/like','DiaryController@like')
    ->name('diary.like');
    Route::post('/diary/{id}/dislike','DiaryController@dislike')
    ->name('diary.dislike');
});