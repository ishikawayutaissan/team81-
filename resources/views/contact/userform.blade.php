<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- css -->
    <link rel="stylesheet" href="../css/style.css">
 
    <title>お問い合わせフォーム画面</title>

</head>
<body>
   <!-- ヘッダ・タイトル部分 -->
    <header>
      <div class="container block-header">
        <div class="row">
          <div class="col-8">
            <h1>お問い合わせフォーム</h1>
          </div>
          <div class="col-2 d-flex align-items-center">
            @if($role==2)
                <a class="btn btn-danger hide-sp" href="/support" role="button">管理者画面へ</a>
            @endif
          </div>
          <div class="col-2 d-flex align-items-center logout-pos">
            <a href="/logout"><img class="logout hide-sp" src="../image/logout.png" alt="ログアウトボタン"></a>
          </div>  
      </div>
    </header>

    <!-- メイン部分 -->
    <main>
        <div class="container">
            @if (count($errors) > 0)
                <p class="color-red message">入力に誤りがあります。再入力をお願いします。</p>
            @endif
             <form action="/inquiry/userform" method="post">
                @csrf 
                <table class="table table-bordered">
               
                    <tbody>
                        <tr>
                            <th>
                                対象サポート<p class="color-red"> 必須 </p>
                            </th>
                            <td>
                            @error('usersupport')
                                 <p class="color-red">  {{$message}} </p></br>
                                @enderror
                                <!-- <input type="radio" name="usersupport" value="1" {{ old('usersupport') == 1 ? 'checked' : ($support ==1 || !isset($support) ? 'checked' : '') }} >{{App\Models\Inquiry::SUPPORT_ITEM['1']}}</br>
                                <input type="radio" name="usersupport" value="2" {{ old('usersupport') == 2 ? 'checked' : ($support ==2 ? 'checked' : '') }} >{{App\Models\Inquiry::SUPPORT_ITEM['2']}}</br>
                                <input type="radio" name="usersupport" value="3" {{ old('usersupport') == 3 ? 'checked' : ($support ==3 ? 'checked' : '') }} >{{App\Models\Inquiry::SUPPORT_ITEM['3']}}</br>
                                <input type="radio" name="usersupport" value="4" {{ old('usersupport') == 4 ? 'checked' : ($support ==4 ? 'checked' : '') }} >{{App\Models\Inquiry::SUPPORT_ITEM['4']}}</br>
                                <input type="radio" name="usersupport" value="5" {{ old('usersupport') == 5 ? 'checked' : ($support ==5 ? 'checked' : '') }} >{{App\Models\Inquiry::SUPPORT_ITEM['5']}}</br>
                                <input type="radio" name="usersupport" value="6" {{ old('usersupport') == 6 ? 'checked' : ($support ==6 ? 'checked' : '') }} >{{App\Models\Inquiry::SUPPORT_ITEM['6']}}</br> -->
                                <input type="radio" name="usersupport" value="1" {{ old('usersupport',$support) == 1 ? 'checked' : '' }} >{{App\Models\Inquiry::SUPPORT_ITEM['1']}}</br>
                                <input type="radio" name="usersupport" value="2" {{ old('usersupport',$support) == 2 ? 'checked' : '' }} >{{App\Models\Inquiry::SUPPORT_ITEM['2']}}</br>
                                <input type="radio" name="usersupport" value="3" {{ old('usersupport',$support) == 3 ? 'checked' : '' }} >{{App\Models\Inquiry::SUPPORT_ITEM['3']}}</br>
                                <input type="radio" name="usersupport" value="4" {{ old('usersupport',$support) == 4 ? 'checked' : '' }} >{{App\Models\Inquiry::SUPPORT_ITEM['4']}}</br>
                                <input type="radio" name="usersupport" value="5" {{ old('usersupport',$support) == 5 ? 'checked' : '' }} >{{App\Models\Inquiry::SUPPORT_ITEM['5']}}</br>
                                <input type="radio" name="usersupport" value="6" {{ old('usersupport',$support) == 6 ? 'checked' : '' }} >{{App\Models\Inquiry::SUPPORT_ITEM['6']}}</br>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                具体的な内容<p class="color-red"> 必須 </p></br>
                                <p class="notice">1000文字以内でご記入ください。</p>
                            </th>
                            <td>
                                @error('userdetail')
                                 <p class="color-red">  {{$message}} </p></br>
                                @enderror
                                <textarea name="userdetail" class="form-control" rows="3" maxlength="1000">{{old('userdetail',isset($detail) ? $detail : '')}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>
                               氏名<p class="color-red">必須</p> 
                            </th>
                            <td>
                                @error('username')
                                    <p class="color-red notice"> {{$message}} </p></br>
                                @enderror
                                <input type="text" name="username" class="form-control" value="{{old('username', isset($name) ? $name : '')}}">
                            </td>
                        </tr>
                        <tr>
                            <th>
                               電話番号<p class="color-red">必須</p> 
                            </th>
                            <td>
                                @error('usertel')
                                    <p class="color-red notice"> {{$message}} </p></br>
                                @enderror
                                <input type="text" name="usertel" class="form-control" value="{{old('usertel',isset($tel) ? $tel : '')}}">
                            </td>
                        </tr>
                        <tr>
                            <th>
                               メールアドレス<p class="color-red">必須</p> 
                            </th>
                            <td>
                                @error('useremail1')
                                    <p class="color-red notice">{{$message}}</p></br>
                                @enderror
                                <input type="email" name="useremail1" class="form-control" value="{{old('useremail1',isset($email) ? $email : '')}}">
                            </td>
                        </tr>
                        <tr>
                            <th>
                               メールアドレス 確認用<p class="color-red">必須</p> 
                            </th>
                            <td>
                                @error('useremail2')
                                    <p class="color-red notice">{{$message}}</p></br>
                                @enderror
                                <input type="email" name="useremail2" class="form-control" value="{{old('useremail2',isset($email) ? $email : '')}}">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end"> 
                    <div class="row">
                        <div class="col-md-6 btn-margin">
                            <a href="/inquiry" class="btn btn-primary me-md-2 w-100" type="button">ホーム画面へ戻る</a>
                        </div>
                        <div class="col-md-6 btn-margin">
                            <input type="submit" class="btn btn-primary me-md-2 w-100" value="入力内容のご確認へ">   
                        </div>
                        <div class="col-md-6 btn-margin hide-pc">
                            <a href="/" class="btn btn-outline-primary me-md-2 w-100" type="button">ログアウト</a>
                        </div>
                        <div class="col-md-6 btn-margin hide-pc">
                            @if($role==2)
                                <a href="/support" class="btn btn-outline-danger me-md-2 w-100" type="button">管理者画面へ</a>
                            @endif
                            </div>
                    </div> 
                </div>

                <!-- <div class="container mt-5 mb-5">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <input type="submit" class="btn btn-primary" value="入力内容のご確認へ">
                    </div>
                </div> -->
            </form> 
        </div>
    </main>
</body>
</html>