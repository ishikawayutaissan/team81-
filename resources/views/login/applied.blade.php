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
    <title>申請完了</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    
</head>

<body>
    <div class="container mt-5">
        <main class="mx-auto px-3 col-md-7">
            <h1 class="text-center">申請完了</h1>
           <p>申請を受け付けました。メールをご確認ください。
              パスワードはメールに記載のあるURLより再設定を行えます。
              なおURLは10分を過ぎるとアクセスができなくなります。
              ご注意ください。
              メールが届くのに数分掛かる可能性がございます。
              ご了承下さい。
           </p>       
        </main>
    </div>
</body>

</html>