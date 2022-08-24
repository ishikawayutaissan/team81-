<!DOCTYPE html>
<!-- 文字コードの設定 -->
<html lang="ja">
<head>
    <!-- 文字コードの設定 -->
    <meta charset="utf-8">

    <!-- 表示領域 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- タイトル（タブに表示される） -->
    <title>ログイン画面</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    <!-- 独自のCSSを反映する -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> 

</head>

<body>
    <div class="container mt-5">
        <main class="mx-auto px-3 col-md-7">
            <h1 class="text-center">ログイン</h1>
            <div class="text-center text-danger">
            @if(session('login_error'))
             <p>{{session('login_error')}}</p>
            @endif
            </div>
            <form class="text-center" action="/login/login" method="post">
            @csrf
                <table style="margin-left:auto; margin-right:auto; border:none">
                  <tbody>
                    <!-- メールアドレス欄 -->
                    <tr>
                        <th>
                            <label for="email">メールアドレス</label>
                        </th>
                        <td>
                            <div class="login-form-input">
                                <input type="text" class="form-control" style="width:25em;" name="email"  value="{{ old('email') }}" placeholder="login@gmail.com">
                            </div>
                        </td>
                    </tr>

                    <!-- パスワード欄 -->
                    <tr>
                        <th>
                            <label for="password">パスワード</label>
                        </th>
                        <td>
                            <div class="login-form-input">
                                <input type="password" class="form-control" name="password"  value="{{ old('password') }}" >
                            </div>
                        </td>
                    </tr>
                  </tbody>
                </table>

                <!-- ログインボタン-->
                <div class="login-button-row text-center">
                    <div class="button-item">
                        <button type="submit" class="btn btn-hg btn btn-outline-primary" tabindex="3" id="btn-login">ログイン</button>
                    </div>

                    <!--パスワード未設定説明-->
                    <div class="button-item">
                        <div class="text-danger">
                            パスワードをお忘れの方は下記のリンクを押して下さい。
                        </div>
                    </div>
                </div>
            </form>
            <!-- パスワード設定・再設定リンク -->
            <p class="login-form-link text-center">
                <a href="/login/pwreset">パスワード再設定</a>
            </p>
        </main>
    </div>
</body>

</html>