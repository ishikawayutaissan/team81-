<?php 
use App\Models\Inquiry;
use App\Models\User;
$items = Inquiry::SUPPORT_ITEM;
use Carbon\Carbon;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/support.css') }}">
    <title>サポート管理</title><br><br>
</head>

<header>
    <!-- 遷移ボタン -->
    <div class="registerLink" style="text-align:right;">
      <a href="/user/top" class="btn btn-primary">ユーザー一覧画面</a>
      <a href="/inquiry" class="btn btn-primary">サポート概要</a>   
      <a href="/logout" class="btn btn-primary">ログアウト</a><br></br>
    </div>
</header>

<body>
  <div class="border border-bottom"></div>
    <!-- //* 検索機能ここから *// -->
  <main>
    <div class="container">
      <div class="mx-auto">
        <br><h2 class="text-center">お問い合わせ検索（抽出）一覧</h2></br>
          <form action="/support" method="GET">
            @csrf
            <div class="form-inline">
                <label class="mr-sm-2" for="CustomSelect">お問い合わせ項目：</label>
                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="support" >
                    <option value="0" {{ $support === "0" ? 'selected' : '' }}>未選択</option>
                    <option value="1" {{ $support === "1" ? 'selected' : '' }}>サーバ・ネットワークに関する設定変更</option>
                    <option value="2" {{ $support === "2" ? 'selected' : '' }}>OS・ミドルウェアに関する設定変更</option>
                    <option value="3" {{ $support === "3" ? 'selected' : '' }}>バックアップリストア</option>
                    <option value="4" {{ $support === "4" ? 'selected' : '' }}>リストア</option>
                    <option value="5" {{ $support === "5" ? 'selected' : '' }}>サーバのスケール調整</option>
                    <option value="6" {{ $support === "6" ? 'selected' : '' }}>その他</option>
                </select>

                <label class="mr-sm-2" for="CustomSelect">対応状況：</label>
                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="status" >
                    <option value="0" {{ $status === "0" ? 'selected' : '' }}>未選択</option>
                    <option value="1" {{ $status === "1" ? 'selected' : '' }}>未対応</option>
                    <option value="2" {{ $status === "2" ? 'selected' : '' }}>対応中</option>
                    <option value="3" {{ $status === "3" ? 'selected' : '' }}>保  留</option>
                    <option value="4" {{ $status === "4" ? 'selected' : '' }}>対応済</option>
                </select>

                <div class="input-group">
                    <label>検索キーワード：</label>
                    <input type="text" class="form-control" name="detail" placeholder="キーワード入力" value = {{ $detail ?? '' }}></input>
                    <span class="input-group-btn"><button type="submit" class="btn btn-secondary ">検索</button></span>
                </div>
            </div>
          </from>
      </div>
    </div>

  <div class="container">
    @foreach ($rows as $row)
        {{ $row->update_at }}
    @endforeach

  <br>{{ $rows->appends(['sort' => $sort])->links('vendor.pagination.default') }}</br>

  <div id="ebillingListPagingInfo" class="m-box-field m-box-field--style_thin-gray paginginfo-box" style="display: block;">
   <div class="m-box-field " style="display: block;">
    <div class="m-container">
     <div class="m-paragraph">
      <div class="m-paragraph__body">
       @if (count($rows) >0)
       <p>全{{ $rows->total() }}件中 
          {{  ($rows->currentPage() -1) * $rows->perPage() + 1}} - 
          {{ (($rows->currentPage() -1) * $rows->perPage() + 1) + (count($rows) -1)  }}件目を表示</p>
       @else
       <p>データがありません。</p>
       @endif
      </div>
     </div>
    </div>
   </div>
  </div>

    <div class="table-responsive">
     <table class="table table-bordered" style="table-layout: auto;">
      <thead class="thead-light">
        <tr>
            <th style="width:30px;">No.</a></th>
            <th style="width:100px;">サポート項目</a></th>
            <th style="width:100px;">サポート内容</a></th>
            <th style="width:50px;">利用者名</a></th>
            <th style="width:50px;">サポート日</a></th>
            <th style="width:50px;">対応担当者</th>
            <th style="width:50px;">対応日</a></th>
            <th style="width:30px;">対応状況</a></th>
        </tr>
      </thead>

      @foreach ($rows as $row)
        @php
         $style = "c1";
         if(is_null($row->status)){$style="c1";}
         elseif($row->status==2){$style="c2";}
         elseif($row->status==3){$style="c3";}
         elseif($row->status==4){$style="c4";}
        @endphp
    
      <tbody>
        <tr>
            <td style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; max-width: 0;">{{ str_pad($row->id, 3, 0, STR_PAD_LEFT) }}</td>
            <td style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; max-width: 150px;">{{ $items[$row->support] }}</td>
            <td style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; max-width: 250px;">{{ $row->detail }}</td>
            <td style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; max-width: 80px;">{{ $row->name }}</td>
            <td style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; max-width: 60px;">{{ $row->created_at->format('y.m.d') }}</td>
            <td style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; max-width: 80px;">{{ $row->supporter_name }}</td> 
        @empty($row->status)
        <td></td>
        @else
            <td style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; max-width: 60px;">{{ $row->updated_at->format('y.m.d') }}</td>
        @endempty    
            <td style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; max-width: 50px;"><a href="{{route('support.show' , ['id'=>$row->id])}}" class="btn btn-secondary btn-sm {{$style}}">{{App\Models\Inquiry::getStatus($row->status)}}</a></td>
        </tr>
        @endforeach
      </tbody>
     </table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </main>  
</body>
</html>

