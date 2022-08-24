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
    <title>パスワード再設定申請</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


</head>

<body>
    <div class="container mt-5 border-1">
        <main class="mx-auto px-3 col-md-7">
            <h1 class="text-center">パスワード再設定申請</h1>
            <div class="text-center text-danger">
            @if(session('message'))
            <p>{{session('message')}}</p>
            @endif
            </div>
            <form class="text-center" action="/login/mail" method="post">
                @csrf
                <table style="margin-left:auto; margin-right:auto; border:none">
                    <!-- メールアドレス欄 -->
                    <tr>
                        <th>
                            <label for="email">メールアドレス</label>
                        </th>
                        <td>
                            <div class="login-form-input">
                                <input type="text" class="form-control" style="width:25em;" name="email" value="{{ old('email') }}" placeholder="login@gmail.com">
                                @if($errors->has('email'))<p> class="error">{{ $errors->first('email') }}</p>@endif
                            </div>
                        </td>
                    </tr>
                </table>


                <!-- 申請ボタン-->
                <div class="login-button-row text-center">
                    <div class="button-item">
                        <button type="hidden" class="btn btn-hg btn btn-outline-primary" tabindex="3" name="URLtoken" value="{{ csrf_token() }}">申請</button>
                    </div>
                </div>
            </form>
        </main>
    </div>

</body>

</html>