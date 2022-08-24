<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\Inquiry;

use App\Http\Requests\InquiryRequest;

use Illuminate\Support\Facades\Auth; //Authの読み込み

class InquiryController extends Controller
{
    // 4-0. ホーム画面の表示
    public function show(Request $request){
       //$request->session()->flush();  /* ホーム画面に遷移した際は一旦sessionをクリアしておく　*/
        $role = Auth::user()->role;
        /* flush()メソッドだと、ログインユーザ情報まで削除する恐れがあるため個別に削除する */
        $request->session()->forget('contact_name');
        $request->session()->forget('contact_tel');
        $request->session()->forget('contact_detail');
        $request->session()->forget('contact_email');
        $request->session()->forget('contact_support');
        return view('contact/userhome',['role' => $role]); 
        // return view('contact/userhome');
    }

    // 4-1. validatoinおよびerrorチェック前のsession登録と表示
    // 初回読み込み時はブランクになるが、修正が入る場合はsessionに記憶したデータを取得・表示する

    public function showform(Request $request){
        $previous = url()->previous(); /* 直前のURLを取得する */
        
        if(strpos($previous,'inquiry/usercertification') !== false)
        {
            // 前回入力したデータをsessionから呼び出し、フォーム画面に表示させる
            $sesname = $request->session()->get('contact_name');
            $sestel = $request->session()->get('contact_tel');
            $sesdetail = $request->session()->get('contact_detail');
            $sesemail = $request->session()->get('contact_email');
            $sessupport = $request->session()->get('contact_support');
        }else{
            // お問い合わせ内容確認画面以外からフォームが呼ばれた場合はフォームを空欄にする
            $sesname = null;
            $sestel = null;
            $sesdetail = null;
            $sesemail = null;
            $sessupport = null;
        }
         $role = Auth::user()->role; /*　headerを統一すれば個別に記入する必要ないため、後ほどまとめる　*/
        return view('contact/userform',[
            'detail' => $sesdetail,
            'name' => $sesname,
            'tel' => $sestel,
            'email' => $sesemail,
            'support' => $sessupport,
            'role' => $role
        ]);

    }

    public function ses_get(Request $request){ 
    // 『戻る』ボタンによるエラー対応
    //   登録完了画面から『戻る』ボタンを押下された場合、sessionデータが削除されているためエラー発生
    
        if($request->session()->exists('contact_support'))
        {
            $sesname = $request->session()->get('contact_name');
            $sestel = $request->session()->get('contact_tel');
            $sesemail = $request->session()->get('contact_email');
            $sessupport = $request->session()->get('contact_support');
            $sesdetail = $request->session()->get('contact_detail'); 

            $role = Auth::user()->role; /*　headerを統一すれば個別に記入する必要ないため、後ほどまとめる　*/

            return view('contact/usercertification', 
                ['name' => $sesname,
                'tel' => $sestel,
                'email' => $sesemail,
                'support' => $sessupport,
                'detail' => $sesdetail,
                'role' => $role
            ]);
        }
        else
        {
            //sessionに値がない場合はホーム画面に遷移させる
            return redirect('/inquiry');
        }
    }

    // 取得したデータをsessionに保存する
    public function ses_put(InquiryRequest $request){
        // userform.blade.phpのフォーム機能から送信したデータを格納する
        $name = $request->username;
        $tel = $request->usertel;
        $email = $request->useremail1;
        $support = $request->usersupport;
        $detail = $request->userdetail;

        //　格納したデータをセッションに保存する
        $request->session()->put('contact_name',$name);
        $request->session()->put('contact_tel',$tel);
        $request->session()->put('contact_email',$email);
        $request->session()->put('contact_support',$support);
        $request->session()->put('contact_detail',$detail);

        return redirect('/inquiry/usercertification');
    }

    // セッションに一旦、保存した入力データをデータベースに登録する
    public function inq_create(Request $request)
    {        
        //ユーザ作成
        $sesname = $request->session()->get('contact_name');
        $sestel = $request->session()->get('contact_tel');
        $sesemail = $request->session()->get('contact_email');
        $sessupport = $request->session()->get('contact_support');
        $sesdetail = $request->session()->get('contact_detail'); 

        $inquiry = Inquiry::create([
            'user_id' => Auth::user()->id,
            'name' => $sesname,
            'tel' => $sestel,
            'email' => $sesemail,
            'support' => $sessupport,
            'detail' => $sesdetail,
            ]);
            //【方法1-2】inquiriesテーブルからIDで検索しメールアドレスを取得する
            // ブラウザのURLの?id=...を書き換えられると外部からメール送信できてしまい
            // セキュリティ上の問題あり
            // return redirect('/usermail?id='.$inquiry->id);
        return redirect('/inquiry/usermail');
        
    }
    
    // クライアントの入力内容をメールにて送信する
    public function send(Request $request)
    {
        $sesname = $request->session()->get('contact_name');
        $sestel = $request->session()->get('contact_tel');
        $sesemail = $request->session()->get('contact_email');
        $sessupport = $request->session()->get('contact_support');
        $sesdetail = $request->session()->get('contact_detail'); 

        $data = [
                'name'=>$sesname,
                 'tel'=>$sestel,
                 'email'=>$sesemail,
                 'support'=>$sessupport,
                 'detail'=>$sesdetail
                ];

        // 自分で定義した変数(この場合、$sesemail)はglobal宣言(?)しても
        // Mailファサードに引き渡すことができないので注意
        // $sesemail = $request->session()->get('email');

        // 【参考】var_dumpを使って変数に格納されたデータを確認する方法
        // var_dump($sesemail);
        // exit;
        
        Mail::send('contact/email', $data, function($message){

            //【方法1-1】テーブルをcreated_atで降順に並び替えてデータを取得する
            //  →同時に作成されたデータが存在する場合を効力すると好ましくない
            // $item = Inquiry::orderBy('created_at','desc')->first();

            //【方法1-2】inquiriesテーブルからIDで検索しメールアドレスを取得する
            // $item = Inquiry::find($request->input('id'));

            // Mailファサード内では通常$requestはスコープ外なのでglobal宣言で取得
             global $request;
                         
            //【方法1-2】inquiriesテーブルからIDで検索しメールアドレスを取得する 
            // input()はあってもなくてもOK
            // $item = Inquiry::find($request->id);
            // $item = Inquiry::find($request->input('id'));
            // var_dump("item=".$item);
            // exit;

            // 自分で定義した変数($sesemail)はglobal宣言してもMailファサードに
            // に引き渡すことができないので、$requestをglobal宣言する
            // global $sesemail;
            //【方法2】セッションからメールアドレスを取得する
            $sesemail = $request->session()->get('contact_email');
            // $request->session()->flush(); 後はメールの送信のみでセッションの値は不要のため削除する
            
            // flush()メソッドだと、ログインユーザ情報まで削除する恐れがあるため個別に削除する 
            $request->session()->forget('contact_name');
            $request->session()->forget('contact_tel');
            $request->session()->forget('contact_detail');
            $request->session()->forget('contact_email');
            $request->session()->forget('contact_support');
            
            //var_dump($sesemail);
            //exit;
            // $message->to($item->email)
            $message->to($sesemail)
                    ->subject('お問い合わせ内容の登録完了');
        });

        return redirect('/inquiry/userregister');
    }


    // お問い合わせ内容の受付けが完了したことを表示する
    public function show_reg(){
        $role = Auth::user()->role; /*　headerを統一すれば個別に記入する必要ないため、後ほどまとめる　*/

        return view('contact/userregister',['role' => $role]);
    }

}
