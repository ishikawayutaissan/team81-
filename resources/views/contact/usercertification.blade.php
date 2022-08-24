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
 
    <title>お問い合わせ内容のご確認</title>

</head>
<body>
   <!-- ヘッダ・タイトル部分 -->
    <header>
      <div class="container block-header">
        <div class="row">
          <div class="col-8">
            <h1>お問い合わせ内容のご確認</h1>
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
        <div class="container mb-3">
            <p class="color-blue message">以下の内容でお問い合わせ内容を登録いたします。</br>よろしいですか？</p>
        </div>
        <div class="container">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>
                                対象サポート
                            </th>
                            <td>
                                <p>{{ App\Models\Inquiry::SUPPORT_ITEM[$support] }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                具体的な内容    
                            </th>
                            <td>
                                {{ $detail }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                               氏名 
                            </th>
                            <td>
                                {{ $name }}
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
                                {{ $email }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end"> 
                    <div class="row">
                        <div class="col-md-6 btn-margin">
                            <a href="/inquiry/userform" class="btn btn-primary me-md-2 w-100" type="button">入力内容を修正</a>
                        </div>
                        <div class="col-md-6 btn-margin">
                            <form action="/inquiry/usercertification" method ="post">
                                @csrf
                                <input type="submit" class="btn btn-primary me-md-2 w-100" value="入力内容を登録">   
                            </form>
                        </div>
                        <div class="col-md-6 btn-margin hide-pc">
                            <a href="/logout" class="btn btn-outline-primary me-md-2 w-100" type="button">ログアウト</a>
                        </div>
                        <div class="col-md-6 btn-margin hide-pc">
                            @if($role==2)
                                <a href="/support" class="btn btn-outline-danger me-md-2 w-100" type="button">管理者画面へ</a>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
    </main>
</body>
</html>