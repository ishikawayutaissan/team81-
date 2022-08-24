<?php

use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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

//追記

//お問い合わせ検索（抽出）一覧画面の表示
Route::get('/support',[App\Http\Controllers\SupportController::class,'index']);
//更新フォーム画面の表示
Route::get('/support/show/{id}', [App\Http\Controllers\SupportController::class,'show'])->name('support.show');
//サポートの更新
Route::post('/support/update', [App\Http\Controllers\SupportController::class,'update'])->name('support.update');
//バリデーション機能
// Route::post('/support', [App\Http\Controllers\SupportController::class,'store']);
// 検索フォームの表示
// Route::get('/support/search', [App\Http\Controllers\SupportController::class,'search'])->name('search');

