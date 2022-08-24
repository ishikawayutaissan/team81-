<?php

use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SupportController;

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

Route::get('/support', function () {
    return view('welcome');
});

//追記
Route::group(['prefix'=>'support'], function () {
    //お問い合わせ検索（抽出）一覧画面の表示
    Route::get('/index',[SupportController::class,'index']);
    //更新フォーム画面の表示
    Route::post('/update/{id}', [SupportController::class,'update'])->name('support.update');
    //備考欄（詳細ボタン）の表示
    Route::get('/show/{id}', [SupportController::class,'show'])->name('support.show');
});

