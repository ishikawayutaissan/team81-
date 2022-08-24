<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;  // ファサードを読み込み

use Illuminate\Support\Str; //Strの読み込み

use App\Mail\SendTestMail; //Mail→SendTestMail.phpの読み込み

use Illuminate\Support\Facades\Validator;//バリデータの読み込み

use Illuminate\Support\Facades\Hash;//ハッシュの読み込み

use Illuminate\Support\Facades\Auth;//Authの読み込み

use App\Models\User;//モデルのuser.php読み込み




class LoginController extends Controller
{
    //最初にログイン画面が表示される
    public function index(Request $request)
    {


        return view('login.login');
    }



    // ログインボタンを押すとユーザーのホーム画面か管理者側のサポート画面が表示される(ログイン→ユーザーのホーム画面 or ログイン→管理者のホーム画面)
     public function login(Request $request)
     {
        $user= User::where('email','=',$request->email)->first(); //データベースからメールアドレスを取得
        if($user){
            $cred =$request->only('email','password');

            //権限の確認
            if (Auth::attempt($cred)) {              //パスワードがあるかチェック
                $request->session()->regenerate();   
                if($user->role >= 1){                 //roleが1以上の場合はサポートのホーム画面へ→概要欄から対応画面へ
                    return redirect('/inquiry');
                }
                //  elseif($user->role ==2){             //roleが2の場合は管理者専用の画面へ
                //     return redirect('/user/top');
                //  }
            }
        }   
        return back()->with([
            'login_error' => 'メールアドレス又はパスワードが違います。',
        ]);
    }
      
   

    //パスワードリセット申請画面が表示される（リンク）
    public function pwreset(Request $request)
    {
        

        return view('login.apply');
    }


    //申請画面でメールアドレスを打つと申請完了画面に表示される。（申請ボタン→完了→メールが送られる。)
    public function mail(Request $request)
    {
      //データベースからメールアドレスがあるかどうか引っ張ってくる
       $user= User::where('email','=',$request->email)->first();


        //  メールアドレスが登録されていない時のエラー表示
        if(!$user){
            session()->flash('message','メールアドレスの登録がありません。メールアドレスのご確認をお願いします。');
            return redirect('/login/pwreset');
        }
        
        // トークン生成   ハッシュする  40文字ランダムでバラバラにする   .envからAPP_KEY(3つで複雑な暗号化を行う。)
        $token = hash_hmac('sha256', Str::random(40), config('app.key'));
         
        //URL、発行時間をデータベースに保存
        $user = User::where('email', $request->email)->first(); //ユーザーのデータベースからメールを取ってくる
        $user->URLtoken = $token;                               //トークン保存
        $user->applied_at = date('Y-m-d H:i:s');                // 発行時間を保存
        $user->save();                                          //保存
        



        //配列でトークンを送るようにする
        $data = ['token' =>$token];

        //送り先
        $to = $request->email;

        //新しくメールを送る(リクエストのあったどの人にでも送れる)
        Mail::to($to)->send(new SendTestMail($data));
    
        return view('login.applied');
    }


    
    //URLからパスワードリセット画面に遷移する
    public function password(Request $request){

        //データベースと照合
        $user = User::where('URLtoken', $request->token )->first(); // データベースからトークン(トークン)を取ってくる

        //URLからアクセスする時間の制限処理
         if($user){
            if((time() - strtotime($user->applied_at))<= 600){          //現在の時間 - URLの時間発行時間(データベースから発行時間を取る) < 10分  以内ならパスワードリセット画面を表示する
                return view('login.password',compact('user'));          //パスワードリセット画面の表示、  パスワード変更の際にデータベースの情報が必要なのでパスワードリセット画面にデータベースの情報を渡してあげる(ユーザ情報の配列を受け渡す)
            } 
         }
          return redirect('/');     //10分過ぎていたらログイン画面表示される  
    }
    
    //パスワード登録ボタンをしたら完了画面が表示される
    public function pwregister(Request $request)
    {
    //バリデーションのルール
    $rules = [
            // パイプ使わない書き方           ↓大文字1つ ↓小文字1つ  ↓数字1つ  ↓半角英数字のみ（空文字OK）
            'password'=>['required','regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/'],
                                                                                        //↑8文字以上
            'password2'=>['required','same:password'],
                                         //↑パスワードと同じか           
    ];
    //バリデーションのエラーメッセージ
    $msg = [
        'password.required' => "パスワードは必須です。",
        'password.regex' => "パスワードは半角、アルファベット大文字小文字、数字を1つを含んでいません。又は8文字以上ではありません。",
        'password2.required' => "パスワード再入力は必須です。",
        'password2.same' => "パスワードが同じものではありません。",
    ];

    $validator = Validator::make($request->all(),$rules,$msg);
    if($validator->fails()){                                                                      // 失敗したらパスワード設定画面でエラーメッセージが表示される。
        return redirect('/login/password/'.$request->token)->withInput()->withErrors($validator); //トークン付けて
    }

        // パスワードリセット処理
         $user = User::where('id', $request->id)->first();
         $user->password = Hash::make( $request->password);
         $user->save();
        
        return view('login.passcomp');
    }



    //パスワード登録完了したらログイン画面が表示される
    public function top(Request $request)
    {


        return view('login.login');
    }


    //ログアウト
    public function logout(Request $request){

      Auth::logout();
      $request->session()->invalidate();     //セッション削除
      $request->session()->regenerateToken();  //セッション再生成

     return redirect('/');
    }


    //林さんのとこへ
    public function inquiry(Request $request)
    {


        return view('contact.userhome');
    }

    //中田さんのとこへ

    public function support(Request $request)
    {


        return view('support.index');
    }

}
