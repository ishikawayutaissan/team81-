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
    <title>ユーザー一覧</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


</head>

<body>
    <h1 class="text-center">登録ユーザー</h1>
      <div class="container mt-5 border=2">
            <div class="registerLink" style="text-align:right;">
                <!--  林さんのところへ -->
                <a href="/inquiry" class="btn btn-outline-primary">サポート概要へ</a>   
                <!-- 中田さんのところへ -->
                <a href="/support" class="btn btn-outline-info">対応画面へ</a>
                <!-- ログアウト -->
                <a href="/logout" class="btn btn-outline-danger">ログアウト</a>
            </div>
                <div class="registerLink" style="text-align:left;">
                  <a href="/user/register"> >>登録<< </a>
                </div>

        <div>
            <table class="table" border="3">
                <tr>
                    <th>ID</th>
                    <th>権限</th>
                    <th>企業名</th>
                    <th>氏名（担当者）</th>
                    <th>日付</th>

                </tr>
                @foreach($user as $value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->role}}</td>
                    <td>{{$value->company}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->updated_at->format('Y-m-d')}}</td>
                    <td><a href="/user/edit/{{$value->id}} "> >>編集<< </a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
      </div>     
</body>

</html>
