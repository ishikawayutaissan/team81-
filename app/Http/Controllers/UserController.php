<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; //モデルの読み込み
use Illuminate\Support\Facades\Validator; //バリデータの読み込み


class UserController extends Controller
{
    //ユーザー一覧
    public function top()
    {

        $user = User::all();

        return View('user.top')->with([
            'user' => $user
        ]);
    }

    //ユーザー登録画面へ(一覧→登録画面)
    public function register()
    {


        return View('user.register');
    }


    //戻るボタンの処理
    public function back(Request $request)
    {
        
        ///セッションから取ってくる
        $data = $request->session()->all();

        return View('user.register', compact('data'));
    }


    public function memberRegister(Request $request)
    {

        //バリデーションルール
        $rules = [
            'role' => 'required',
            'company'=>'max:50',
            'department'=>'max:50',
            'position'=>'max:50',
            'name' => 'required|max:50',
            'tel' => 'required|numeric|digits_between:9,12|',
            'email' => 'required|unique:users|email|max:128',
        ];
        //バリデーションのエラーメッセージ
        $msg = [
            'role.required' => "権限にチェックをして下さい。",

            'company.max' => "50文字を超えています。",

            'department.max' => "50文字を超えています。",

            'position.max' => "50文字を超えています。",

            'name.required' => "名前は必須です。",
            'name.max' => "50文字を超えています",

            'tel.required' => "電話番号は必須です。",
            'tel.numeric' => "電話番号はハイフン無しで入力して下さい。",
            'tel.digits_between' => "電話番号は9～12桁以内でご記入下さい。",

            'email.required' => "メールアドレスは必須です。",
            'email.unique' => "メールアドレスは既に使用されています。",
            'email.email' => "有効なメールアドレスではありません。",
            'email.max' => "128文字を超えています。",
        ];

        $validator = Validator::make($request->all(), $rules, $msg);
        if ($validator->fails()) {                                                                      // 失敗したらエラーメッセージが表示される。
            return redirect('/user/register/' . $request->id)->withInput()->withErrors($validator); 
        }
        
        $role = $request->role;
        $company = $request->company;
        $department = $request->department;
        $position = $request->position;
        $name = $request->name;
        $tel = $request->tel;
        $email = $request->email;

        // データをセッションに保存する
        $request->session()->put('role',$role);
        $request->session()->put('company',$company);
        $request->session()->put('department',$department);
        $request->session()->put('position',$position);
        $request->session()->put('name',$name);
        $request->session()->put('tel',$tel);
        $request->session()->put('email',$email);


        // 確認画面に表示する値を格納
        $input_data = [
            'role' => $role,
            'company' => $company,
            'department' => $department,
            'position' => $position,
            'name' => $name,
            'tel' => $tel,
            'email' => $email
        ];


        return view('user.confirm', $input_data);
    }

    

    //登録内容確認画面
    public function confirm(Request $request)
    {

        // 戻るボタンが押された場合、３２行目のbackが動く
        if ($request->get('back')) {
            return redirect('/user/back')->withInput();
        }


        //ユーザ作成
        $role = $request->session()->get('role');
        $company = $request->session()->get('company');
        $department = $request->session()->get('department');
        $position = $request->session()->get('position');
        $name = $request->session()->get('name');
        $tel = $request->session()->get('tel');
        $email = $request->session()->get('email');

        User::create([
            'role'=>$role,
            'company'=>$company,
            'department'=>$department,
            'position'=>$position,
            'name'=>$name,
            'tel'=>$tel,
            'email'=>$email
        ]);

    
        return redirect('/user/top');
    }



    //ユーザー編集画面
    public function edit(Request $request)
    {

        $user = User::find($request->id);//IDを取ってくる。


        return View('user.edit', compact('user'));
    }

    public function memberEdit(Request $request)
    {
        //ユーザー削除
        if($request->delete){
        $user = User::find($request->id);
        $user->delete();

        return redirect('/user/top');
        }

        //バリデーションルール
        $editrules = [
            'role' => 'required',
            'company'=>'max:50',
            'department'=>'max:50',
            'position'=>'max:50',
            'name' => 'required|max:50',
            'tel' => 'required|numeric|digits_between:9,12|',
            'email' => 'required|email|max:128',
        ];
        //バリデーションのエラーメッセージ
        $editmsg = [
            'role.required' => "権限にチェックをして下さい。",

            'company.max' => "50文字を超えています。",

            'department.max' => "50文字を超えています。",

            'position.max' => "50文字を超えています。",

            'name.required' => "名前は必須です。",
            'name.max' => "50文字を超えています",

            'tel.required' => "電話番号は必須です。",
            'tel.numeric' => "電話番号はハイフン無しで入力して下さい。",
            'tel.digits_between' => "電話番号は9～12桁以内でご記入下さい。",

            'email.required' => "メールアドレスは必須です。",
            'email.email' => "有効なメールアドレスではありません。",
            'email.max' => "128文字を超えています。",

        ];
        $validator = Validator::make($request->all(), $editrules, $editmsg);
        if ($validator->fails()) {                                                           // 失敗したらエラーメッセージが表示される。
            return redirect('/user/edit/'.$request->id)->withInput()->withErrors($validator); 
        }


        //ユーザー編集
        $user = User::where('id', '=', $request->id)->first(); 
        $user->role= $request->role;
        $user->company= $request->company;       
        $user->department= $request->department;
        $user->position = $request->position;
        $user->name = $request->name;
        $user->tel = $request->tel;
        $user->email = $request->email;
        $user->save();

        return redirect('/user/top');
    }
}