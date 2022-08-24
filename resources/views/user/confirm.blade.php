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
    <title>登録内容確認画面</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    

</head>

<body>
<div style="width: 500px; text-align:center; margin: 100px auto;">
    <h4>確認画面</h4>
    <form action="/user/confirm" method="post">
        @csrf
        <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>
                                権限
                            </th>
                            <td>
                                {{ App\Models\User::role[$role] }}
                            </td>
                        </tr> 
                        <tr>
                            <th>
                                企業名
                            </th>
                            <td>
                                {{$company}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                部署名
                            </th>
                            <td>
                                {{$department}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                役職
                            </th>
                            <td>
                                {{$position}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                               氏名 
                            </th>
                            <td>
                                {{$name}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                               電話番号
                            </th>
                            <td>
                                {{ $tel }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                               メールアドレス 
                            </th>
                            <td>
                                {{$email}}
                            </td>
                        </tr>
                    </tbody>
                </table>
                     <input type="submit" class="btn btn-secondary"  value="登録">
                      <button type="submit" class="btn btn-primary" name="back" value="true">戻る</button>
    </form>
</div>


</body>
</html>