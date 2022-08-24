<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\SupportController;
use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; //Authの読み込み


class SupportController extends Controller
{
    //お問い合わせ一覧に関するコントローラ
    public function index(Request $request)
    {
        //dd($request);
        //入力される中身の定義をする
        $queryId = $request->input('support');//サポート項目
        $searchWord = $request->input('detail'); //検索キーワード（具体的な内容）
        $status = $request->input('status');//対応状況

        // dd($queryId,$searchWord);
        //Inquiryテーブルのsupporter_idとUserテーブルのidを紐づけUserテーブルのnameを画面表示する
        $query = Inquiry::
        select(['inquiries.*','users.name as supporter_name'])
        ->leftJoin('users', 'users.id', '=', 'inquiries.supporter_id');
        //->get();

        //検索項目が選択された場合、inquiriesテーブルからsupportが一致する項目を$queryに代入
        if (isset($queryId)&& $queryId!="0") {
            $query->where('support', $queryId);
        }
        //検索キーワードが入力された場合、inquiriesテーブルから一致する検索キーワードを$queryに代入
        if (!empty($searchWord)) {
            // $query->where('detail', 'like', '%' . self::escapeLike($searchWord) . '%');←エラーが出るため今回コメントアウト。チーム開発終了後，講師に確認すること。
            $query->where('detail', 'like', '%' . $searchWord . '%');
        }
        //対応状況が選択された場合、inquiriesテーブルからstatusが一致する項目を$queryに代入
        if (isset($status)&& $status!="0") {
            if($status =="1"){
                $query->whereNull('status');
            }else{
                $query->where('status', $status);
            }            
        }
        // dd($status);
        //ページネーションと並び替え
        Paginator::useBootstrap();
        $sort = $request->sort;
        if(!$request->sort) {
            $sort = 'status';
        } else {
            $sort = $request->sort;
        }
        // dd($query->toSql());
        // dd($query->get());
        $rows = $query->orderBy($sort,'asc')->paginate(10);
        $param = ['rows' => $rows, 'sort' => $sort, 'support'=> $queryId, 'detail'=> $searchWord, 'status'=> $status];
    // dd($param);   
        return view('support.index',$param);
    }

    public function show($id)
    {
        $inquiry = Inquiry::find($id);
        $user = User::where('id',$inquiry->user_id)->first(); //userテーブルからidを紐づけUserテーブルの情報を画面表示する
        // dd($inquiry);
        //サポート更新画面に遷移する
        return view('support.update', compact('inquiry', 'user'));
    }

    public function update(Request $request )
    {
        // Validationを行うロジックを記述する
        $rulus = [
            'reply' => 'required|max:255',
            'status' => 'required',
            'note' => 'required|max:255',
        ];

        $message = [
            'reply.required' => '対応内容を入力してください。',
            'status.required' => '対応状況を選択してください。',
            'note.required' => '備考欄に入力してください。例）連絡事項など',            
        ];

         $validator = Validator::make($request->all(), $rulus, $message);

        // validateメソッドによるリダイレクト
        // 記述方法：Validator::make('値の配列', '検証ルールの配列');
        // 記述方法：['検証の値'=>'検証ルール1 | 検証ルール2',]
        // もしくは、['検証の値'=>['検証ルール1', '検証ルール2'],]
        //dd($validator->fails());
        if ($validator->fails()) {
            return redirect()->route('support.show',$request->id)
            ->withErrors($validator)
            ->withInput();
          } else {
        
        // 更新処理
        $inquiry = Inquiry::find($request->id);
        $inquiry->reply = $request->input('reply');
        $inquiry->status = $request->input('status');
        $inquiry->note = $request->input('note');
        $inquiry->supporter_id = Auth::id();
        $inquiry->save();       
        
            return redirect('support')->with('success', '更新しました'); //更新されたデータをお問い合わせ一覧画面に遷移させる
          }
    }
}
