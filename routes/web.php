<?php

// 写真ダウンロード
Route::get('/photos/{photo}/download', 'PhotoController@download');

// APIのURL以外のリクエストに対してはindexテンプレートを返す
// 画面遷移はフロントエンドのVueRouterが制御する
Route::get('/{any?}', function () {
    return view('index');
})->where('any', '.+');
