<?php

Route::get('/hello', 'HelloController@hello');



/**
 * 認証系API
 */

// 登録
Route::post('/user/register', 'AuthController@register');
// ログイン
Route::post('/user/login', 'AuthController@login');
// ログアウト
Route::post('/user/logout', 'AuthController@logout')->middleware('auth.bearer');



/**
 * カプセル操作系API
 */

Route::group(['middleware' => 'auth.bearer', 'prefix' => 'capsule'], function () {
    // 埋めたカプセル一覧の取得
    Route::get('/list/buried', 'CapsuleController@buriedList');
    // 掘り起こしたカプセル一覧の取得
    Route::get('/list/dug', 'CapsuleController@dugList');
    // カプセルを開く
    Route::get('/open', 'CapsuleController@open');
    // カプセルを埋める
    Route::post('/bury', 'CapsuleController@bury');
    // カプセルを探す
    Route::get('/search', 'CapsuleController@search');
    // カプセルを掘り出す
    Route::post('/dig', 'CapsuleController@dig');
});