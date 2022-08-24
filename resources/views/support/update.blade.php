<!DOCTYPE html>
<html lang="ja">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <title>サポート管理</title>
   
</head>

<body>
 <main>
  <form action="/support/update" method="post" >
    <div class="container mt-4">
      <div class="border p-4">
        <br><h2 class="h4 mb-4 font-weight-bold">--更新フォーム--</h2></br>
        <h5>お問い合わせ対応内容の更新入力をしてください。</h5>
        @csrf
<!--{{-- エラー表示開始--}} -->
      @if(count($errors) > 0)
      <p class="text-danger">入力に問題があります。再入力してください。</p>
      @endif
       {{ @csrf_field()}}

      @if ($errors->has('name'))
       <div class="alert alert-danger">
        @foreach ($errors->get('name') as $error)
        <li>{{ $error }}</li>
        @endforeach
       </div>
      @endif
     <br></br>

        <div class="form-group">
            <label for="inputEmail4" class="form-label">お問い合わせ記入者氏名：{{ $inquiry->name }}</label>
        </div>


      @if ($errors->has('company'))
       <div class="alert alert-danger">
        @foreach ($errors->get('company') as $error)
        <li>{{ $error }}</li>
        @endforeach
       </div>
      @endif

       <div class="form-group">
         <label for="exampleFormControlTextarea1">企業名：{{ $user->company }}</label>
       </div>


      @if ($errors->has('department'))
       <div class="alert alert-danger">
        @foreach ($errors->get('department') as $error)
        <li>{{ $error }}</li>
        @endforeach
       </div>
      @endif

       <div class="form-group">
         <label for="exampleFormControlTextarea1">部署名：{{ $user->department }}</label>
       </div>
 

     @if ($errors->has('position'))
       <div class="alert alert-danger">
         @foreach ($errors->get('position') as $error)
         <li>{{ $error }}</li>
         @endforeach
       </div>
      @endif 

        <div class="form-group">
          <label for="exampleFormControlTextarea1">役職名：{{ $user->position }}</label>
        </div>

     @if ($errors->has('detail'))
       <div class="alert alert-danger">
         @foreach ($errors->get('detail') as $error)
         <li>{{ $error }}</li>
         @endforeach
       </div>
      @endif 

        <div class="form-group">
          <label for="exampleFormControlTextarea1">問い合わせ内容：{{ $inquiry->detail }}</label>
        </div>

     @if ($errors->has('reply'))
       <div class="alert alert-danger">
         @foreach ($errors->get('reply') as $error)
         <li>{{ $error }}</li>
         @endforeach
       </div>
      @endif 

        <div class="form-group">
          <label for="exampleFormControlTextarea1">対応内容：</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" cols="20" name="reply">{{ old('reply', $inquiry->reply) }}</textarea>
        </div>


      @if ($errors->has('status'))
       <div class="alert alert-danger">
         @foreach ($errors->get('status') as $error)
         <li>{{ $error }}</li>
         @endforeach
       </div>
      @endif
   
        <div class="dropdown">
            <label for="exampleFormControlSelect1">対応状況：</label>
             <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="status">
                <option value="">選択してください</option>
                <option value="2" <?php if( old('status', $inquiry->status) == 2) { echo 'selected'; } ?>>対応中</option>
                <option value="3" <?php if( old('status', $inquiry->status) == 3) { echo 'selected'; } ?>>保留</option>
                <option value="4" <?php if( old('status', $inquiry->status) == 4) { echo 'selected'; } ?>>対応済</option>
             </select>
        </div>


      @if ($errors->has('note'))
       <div class="alert alert-danger">
         @foreach ($errors->get('note') as $error)
         <li>{{ $error }}</li>
         @endforeach
       </div>
      @endif
<!--{{-- エラー終了--}} --> 
      
         <div class="form-group">
            <label for="exampleFormControlTextarea1">備考欄：</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="note">{{ old('note', $inquiry->note) }}</textarea>
         </div>        
            <input type="submit" class="btn btn-secondary" value="更新"></input>
            <input type="button" class="btn btn-secondary" value="キャンセル" onclick="history.back()"></input>
            <input type="hidden" name="id" value="{{ $inquiry->id}}"></input>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
      </div>
    </div>
  </from>
 </main>
</body>
</html>

