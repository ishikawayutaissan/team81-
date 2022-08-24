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
 
    <title>お問い合わせ受付完了</title>

</head>

<body>
    <!-- ヘッダ・タイトル部分 -->
    <header>
      <div class="container block-header">
        <div class="row">
          <div class="col-8">
            <h1>お問い合わせ受付完了</h1>
          </div>
          <div class="col-2 d-flex align-items-center">
            @if($role == 2)
              <a class="btn btn-danger hide-sp" href="/support" role="button">管理者画面へ</a>
            @endif
          </div>
          <div class="col-2 d-flex align-items-center logout-pos">
            <a href="/logout"><img class="logout hide-sp" src="../image/logout.png" alt="ログアウトボタン"></a>
          </div>  
      </div>
    </header>

    <main>
        <div class="container">
            <h4 class="color-grey">お問い合わせ内容を受け付けました。</br>メールにてお問い合わせ内容をご確認願います。</h4>
        </div>

        <!-- 画面遷移ボタン -->
        <div class="container mt-5 mb-5">
          <div class="d-grid gap-2 col-md-6 mx-auto btn-margin">
            <a class="btn btn-primary w-100" href="/inquiry" role="button">ホーム画面へ</a> 
          </div>
          <div class="d-grid gap-2 col-md mx-auto btn-margin">
            <a class="btn btn-outline-primary w-100 hide-pc" href="/" role="button">ログアウト</a> 
          </div>
          <div class="d-grid gap-2 col-md mx-auto btn-margin">
            @if($role == 2)
              <a class="btn btn-outline-danger w-100 hide-pc" href="/support" role="button">管理者画面へ</a>
            @endif 
          </div>
        </div>
    </main>
</body>
</html>