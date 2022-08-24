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

// Route::get('/', function () {
//     return view('welcome');
// });

//初めからログイン画面が表示される
Route::get('/', [App\Http\Controllers\LoginController::class, 'index'])->name('login'); //////

//ログイン画面でメールアドレスとパスワードを打つとユーザーのホーム画面 or 管理者画面に表示される(ログイン→ユーザーのホーム画面 or ログイン→管理者の画面)
Route::post('/login/login', [App\Http\Controllers\LoginController::class, 'login']);


//パスワードリセット申請画面に表示される（リンク先）
Route::get('/login/pwreset', [App\Http\Controllers\LoginController::class, 'pwreset']);

//パスワードリセット申請画面でメールアドレスを打つと申請完了画面に表示される(申請→完了画面)
Route::post('/login/mail', [App\Http\Controllers\LoginController::class, 'mail']);

//urlからパスワードリセット画面が表示される(URL→リセット画面)
Route::get('/login/password/{token}', [App\Http\Controllers\LoginController::class, 'password']);

//パスワードを登録して完了画面に表示される(登録→登録完了画面)
Route::post('/login/pwregister', [App\Http\Controllers\LoginController::class, 'pwregister']);

//パスワード登録完了したらログイン画面に表示される(登録完了→ログイン画面)
Route::get('/login/top', [App\Http\Controllers\LoginController::class, 'top']);


////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
////////////////////////////////アクセス制限
Route::group(['middleware' => ['auth', 'can:user']], function () {
////////////////////////////////
////////////////////////////////////////////////////////////////////////
    


// 4. ユーザホーム画面の取得・表示
Route::get('/inquiry', [App\Http\Controllers\InquiryController::class, 'show']);

// 4-1. お問い合わせフォーム
Route::get('/inquiry/userform', [App\Http\Controllers\InquiryController::class, 'showform']);
Route::post('/inquiry/userform', [App\Http\Controllers\InquiryController::class, 'ses_put']);

// 4-2. お問い合わせ内容の確認
Route::get('/inquiry/usercertification', [App\Http\Controllers\InquiryController::class, 'ses_get']);
Route::post('/inquiry/usercertification', [App\Http\Controllers\InquiryController::class, 'inq_create']);
// 4-3. お問い合わせ登録完了通知メールの送信
Route::get('/inquiry/usermail', [App\Http\Controllers\InquiryController::class, 'send']);
// 4-4. お問い合わせ内容の登録完了
Route::get('/inquiry/userregister',[App\Http\Controllers\InquiryController::class,'show_reg']);

});

// Route::get('/inquiry/userform',[App\Http\Controllers\InquiryController::class,'showform']);

/////////////////////////////////////////
//////////////////////アクセス制限
Route::group(['middleware' => ['auth', 'can:role']], function () {
/////////////////////
/////////////////////////////////////////

//お問い合わせ検索（抽出）一覧画面の表示
Route::get('/support', [App\Http\Controllers\SupportController::class, 'index']);
//更新フォーム画面の表示
Route::get('/support/show/{id}', [App\Http\Controllers\SupportController::class, 'show'])->name('support.show');
//サポートの更新
Route::post('/support/update', [App\Http\Controllers\SupportController::class, 'update'])->name('support.update');



///////////////////////////////////////////////////////////////////////////////////////////
//ユーザー一覧画面
Route::get('/user/top', [App\Http\Controllers\UserController::class, 'top']);

//ユーザー登録画面へ
Route::get('/user/register', [App\Http\Controllers\UserController::class, 'register']);

//戻るボタンの処理
Route::get('/user/back', [App\Http\Controllers\UserController::class, 'back']);

//登録内容の確認画面へ
Route::post('/user/memberRegister', [App\Http\Controllers\UserController::class, 'memberRegister']);
Route::get('/user/memberRegister', [App\Http\Controllers\UserController::class, 'memberRegister']);

//登録確認画面 からユーザー一覧画面へ
Route::post('/user/confirm', [App\Http\Controllers\UserController::class, 'confirm']);
Route::get('/user/confirm', [App\Http\Controllers\UserController::class, 'confirm']);

//ユーザー編集
Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
Route::post('/user/memberEdit', [App\Http\Controllers\UserController::class, 'memberEdit']);
});
////////////////////////////////////////////////////////////////////////////////////////////////
//ログアウト
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout']);

