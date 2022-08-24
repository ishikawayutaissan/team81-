<!DOCTYPE html>
<!-- 文字コードの設定 -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- 文字コードの設定 -->
    <meta charset="utf-8">

    <!-- 表示領域 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- タイトル（タブに表示される） -->
    <title>パスワード再設定</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
   
</head>

<body>
    <div class="container mt-5 border-1">
        <main class="mx-auto px-3 col-md-7">
            <h1 class="text-center">パスワード再設定</h1>
            <div class="text-center text-danger">
            @if($errors->has('password'))<br><span class="error">{{ $errors->first('password') }}</span> @endif
            @if($errors->has('password2'))<br><span class="error">{{ $errors->first('password2') }}</span> @endif
            </div>
            <form action="/login/pwregister" method="post">
             @csrf
                <table style="margin-left:auto; margin-right:auto; border:none">
                    <!-- パスワード欄 -->
                    <tr>
                        <th>
                            <label for="password">パスワード</label>
                        </th>
                        <td>
                            <div class="login-form-input">
                            <input type="password" class="form-control" style="width:25em;" name="password"  value="{{ old('password') }}" >
                            <!-- @if($errors->has('password'))<br><span class="error">{{ $errors->first('password') }}</span> @endif -->
                            </div>
                        </td>
                    </tr>

                    <!-- パスワード再入力欄 -->
                    <tr>
                        <th>
                            <label for="password">パスワード再入力</label>
                        </th>
                        <td>
                            <div class="login-form-input">
                            <input type="password" class="form-control" name="password2"  value="{{ old('password2') }}" >
                            <!-- @if($errors->has('password2'))<br><span class="error">{{ $errors->first('password2') }}</span> @endif -->
                            </div>
                        </td>
                    </tr>
                </table>

                <!-- 登録ボタン-->
                <div class="login-button-row text-center">
                    <div class="button-item">
                        <button type="submit" class="btn btn-hg btn btn-outline-primary" tabindex="3" id="btn-login">登録</button>
                    </div>


                    <!--パスワード説明-->
                    <div class="button-item">
                        <div class="text-danger">
                            パスワードは半角、アルファベット大文字小文字、数字を含む8文字以上で設定して下さい。
                            <br>  
                        </div>
                    </div>
                </div>

                <!--ユーザーのパスワードリセット情報をデータベースに送る-->
                <input type="hidden" name="id" value="{{$user->id}}"> 
                <input type="hidden" name="token" value="{{$user->URLtoken}}"> 
            </form>
        </main>
    </div>
    
</body>

</html>