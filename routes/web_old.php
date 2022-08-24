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

/* Route::get('/', function () {
     return view('welcome');
 }); */

 /* Route::get('/', function () {
    return view('contact/userhome');
}); */

// 4. ユーザホーム画面の取得・表示
Route::get('/inquiry', [App\Http\Controllers\InquiryController::class,'show']);

// 4-1.　お問い合わせフォーム
Route::get('/inquiry/userform',[App\Http\Controllers\InquiryController::class,'showform']);
Route::post('/inquiry/userform',[App\Http\Controllers\InquiryController::class,'ses_put']);

// 4-2. お問い合わせ内容の確認
Route::get('/inquiry/usercertification',[App\Http\Controllers\InquiryController::class,'ses_get']);
Route::post('/inquiry/usercertification',[App\Http\Controllers\InquiryController::class,'inq_create']);

// 4-3. お問い合わせ登録完了通知メールの送信
Route::get('/inquiry/usermail',[App\Http\Controllers\InquiryController::class,'send']);

// 4-4. お問い合わせ内容の登録完了
Route::get('/inquiry/userregister',[App\Http\Controllers\InquiryController::class,'show_reg']);
