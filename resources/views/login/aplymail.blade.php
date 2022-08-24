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
    <title>メール</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    
</head>

<body>
    <div class="container mt-5 border-1">
        <main class="mx-auto px-3 col-md-7">
            <h1 class="text-center">パスワード変更のご案内</h1>
           <p>ご申請ありがとうございます。
              下記のURLより設定をお願い致します。
               なお10分過ぎるとアクセスができなくなります。
               ご注意下さい。<br>

              <!-- リセット画面に遷移するURL -->
              {{url('login/password/'.$token)}} </br>
           </p>       
        </main>
    </div>
</body>

</html>