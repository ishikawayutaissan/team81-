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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.4/css/all.css">


    <title>ホーム画面/サービス・サポート概要</title>

</head>
<body>
      
    <!-- ヘッダ・タイトル部分 -->
    <header>
      <div class="container block-header">
        <div class="row">
          <div class="col-8">
            <h1>サービス・サポート概要</h1>
          </div>
          <div class="col-2 d-flex align-items-center">
            @if($role==2)
              <a class="btn btn-danger hide-sp" href="/support" role="button">管理者画面へ</a>
            @endif
          </div>
          <div class="col-2 d-flex align-items-center logout-pos">
            <a href="/logout"><img class="logout hide-sp" src="image/logout.png" alt="ログアウトボタン"></a>

            <!--▽▽ハンバーガーメニュー▽▽-->
            <div id="hamburger" class="hide-pc">
              <div class="icon">
                <span></span>
                <span></span>
                <span></span>
              </div>         
            </div>
            <!--△△ハンバーガーメニュー△△-->
          </div>
        </div>    
      </div>

      <!--▽▽ハンバーガーメニューのリスト▽▽-->
      <nav class="sm hide-pc">
      <ul>
        <li><a id="link_service1" href="javascript:void(0);">共用サーバ</a></li>
        <li><a id="link_service2" href="javascript:void(0);">専用サーバ</a></li>
        <li><a id="link_service3" href="javascript:void(0);">VPS</a></li>
        <li><a id="link_service4" href="javascript:void(0);">クラウドサービス</a></li>
        <li><a id="link_support1" href="javascript:void(0);">サーバ・ネットワークに関する設定変更</a></li>
        <li><a id="link_support2" href="javascript:void(0);">OS・ミドルウェアに関する設計変更</a></li>
        <li><a id="link_support3" href="javascript:void(0);">バックアップリストア</a></li>
        <li><a id="link_support4" href="javascript:void(0);">リストア</a></li>
        <li><a id="link_support5" href="javascript:void(0);">サーバのスケール調整</a></li>
        <li><a href="/inquiry/userform">お問い合わせフォームへ</a></li>
        <li><a href="/">ログアウト</a></li>
        @if($role == 2)
          <li><a href="/support">管理者画面へ</a></li>
        @endif
      </ul>
    </nav>
    <!--△△ハンバーガーメニューのリスト△△-->

    </header>

  <main>
    <!-- 対象サービスの説明 -->
    <div class="container">
      <h2 class="sub-title">■対象サービス</h2>
      <div class="row">
        <div class="col center-block">
          <h3 class="service" id="service1">共用サーバ</h3>
          <div class="service-image">
            <img src="image/Common-server.png" alt="共用サーバのイメージ">
          </div>
          <p class="explanation">共用サーバは1台のサーバを複数のユーザでシェアして使う、『シェアハウス』のようなサービスです。</p>
        </div>
        <div class="col">
          <h3 class="service" id="service2">専用サーバ</h3>
          <div class="service-image">
            <img src="image/exclusive-server.png" alt="専用サーバのイメージ">
          </div>
          <p class="explanation">専用サーバとは物理的なサーバをまるごと1台使えるサービスです。共用サーバが『シェアハウス』に対し専用サーバは『一戸建て』のイメージです。</p>
        </div>
          <div class="col">
            <h3 class="service" id="service3">VPS</h3>
            <div class="service-image">
              <img src="image/vps-image.png" alt="VPSのイメージ">
            </div>
            <p class="explanation">VPSとはVirtural Private Serverであり、共用サーバと専用サーバの中間のようなサービスです。</br>1台のサーバを複数のユーザでシェアして使う点は共用サーバとおなじですが、VPSではサーバ上にユーザごとの専用領域を確保しています。</p>
          </div>
          <div class="col">
            <h3 class="service" id="service4">クラウドサービス</h3>
            <div class="service-image">
              <img src="image/cloud.png" alt="クラウドサーバのイメージ">
            </div>
            <p class="explanation">クラウドサービスプラットフォームからインターネット経由でコンピューティング、データベース、ストレージ、アプリケーションをはじめとした、さまざまな IT リソースをオンデマンドで利用することができるサービスです。</p>
          </div>
      </div>
    </div>

    <!-- 対象サポートの説明 -->
    <div class="container">
      <h2 class="sub-title">■対象サポート</h2>
      <div class="row">
        <div class="col">
          <h3 class="service" id="support1">サーバ・ネットワークに関する設定変更</h3>
          <div class="service-image">
            <img src="image/server-network.png" alt="サーバ・ネットワークのイメージ">
          </div>
          <p class="explanation">運用上、必要な設定変更作業(Apacheの設定、セキュリティグループの設定追加変更など）が生じた場合、スケジュールを立てて更新作業を行います。</p>
        </div>
        <div class="col">
          <h3 class="service" id="support2">OS・ミドルウェアに関する設計変更</h3>
          <div class="service-image">
            <img src="image/OS_MiddleWare.png" alt="OS・ミドルウェア設計変更のイメージ">
          </div>
          <p class="explanation">OSに関してはLinux, Windows、ミドルウェアはApache, MySQL, RostgreSQL, PHPの設計変更をサポートいたします。その他のOS・ミドルウェアについてもご相談ください。</p>
        </div>
        <div class="col">
          <h3 class="service" id="support3">バックアップリストア</h3>
          <div class="service-image">
            <img src="image/backup.png" alt="バックアップリストアのイメージ">
          </div>
          <p class="explanation">標準では1日1回2世代分までのデータを保存、2世代以上前は新規データ保存の際に削除します。</br>バックアップをとるタイミング、世代数に関してはお客様のご要望に合わせ、オプションとしてご対応いたします。</p>
        </div>
      </div>    
      <div class="row">
        <div class="col">
          <h3 class="service" id="support4">リストア</h3>
          <div class="service-image">
            <img src="image/server-scale.png" alt="リストアのイメージ">
          </div>
          <p class="explanation">過去のデータの復旧に関するお客様のご要望に対し、標準では1世代前（バックアップされた中の最新のデータ)から復旧いたします。</br>2世代以前前のデータを復旧させる場合はお客様とのご相談の上、対応いたします。</p>
        </div>
        <div class="col">
          <h3 class="service" id="support5">サーバのスケール調整</h3>
          <div class="service-image">
            <img src="image/scale-up.png" alt="スケール調整のイメージ">
          </div>
          <p class="explanation">キャンペーン時期など、通常時よりもアクセス増によるサーバ負荷の増大が見込まれる際に、現状のリソーセス状況からインスタンスタイプの変更やサーバの増減等の対応いたします。</p>
        </div>
        <div class="col hide-sp">
        </div> 
      </div>
    </div>

    <!-- お問い合わせフォームへの遷移ボタン -->
    <div class="container mt-5 mb-5">
        <div class="d-grid gap-2 col-md-6 mx-auto btn-margin">
            <a class="btn btn-primary w-100 hide-sp" href="/inquiry/userform" role="button">お問い合わせフォームへ</a> 
        </div>
    <!--    <div class="d-grid gap-2 col-md mx-auto btn-margin">
            <a class="btn btn-outline-primary w-100 hide-pc" href="/" role="button">ログアウト</a> 
        </div>
        <div class="d-grid gap-2 col-md mx-auto btn-margin">
          @if($role==2)
            <a class="btn btn-outline-danger w-100 hide-pc" href="/" role="button">管理者画面へ</a>
          @endif 
        </div> -->

    <!-- ページトップへ戻るボタン -->
    <div id="page_top" class="hide-pc"><a href="#"></a></div>
    </div>
    
  </main>

<!--▽▽jQuery▽▽-->
<!--▽▽ハンバーガーに動きをつけるjQuery▽▽-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    $('#hamburger').on('click',function(){
      $('.icon').toggleClass('close');
      $('.sm').slideToggle();
    });
  </script>
<!--△△ハンバーガーに動きをつけるjQuery△△-->

<!--▽▽トップページに戻るボタンのjQuery▽▽-->
  <script>
    $(function(){
      var pagetop = $('#page_top');
     pagetop.hide();
      $(window).scroll(function(){
        if($(this).scrollTop() > 200){
          pagetop.fadeIn();
        }else{
          pagetop.fadeOut();
        }
      });
      pagetop.click(function(){
        $('body, html').animate({
          scrollTop: 0
        },500);
        return false;
        });
    });
  </script>
<!--△△トップページに戻るボタンのjQuery△△-->

<!--▽▽各サービス・サポートまでスクロールするjQuery▽▽ -->
<script>
  $('#link_service1').on('click',function(){
    $(window).scrollTop($('#service1').position().top);
    $('.icon').toggleClass('close');
    $('.sm').slideToggle();
  });
  $('#link_service2').on('click',function(){
    $(window).scrollTop($('#service2').position().top);
    $('.icon').toggleClass('close');
    $('.sm').slideToggle();
  });
  $('#link_service3').on('click',function(){
    $(window).scrollTop($('#service3').position().top);
    $('.icon').toggleClass('close');
    $('.sm').slideToggle();
  });
  $('#link_service4').on('click',function(){
    $(window).scrollTop($('#service4').position().top);
    $('.icon').toggleClass('close');
    $('.sm').slideToggle();
  });
  $('#link_support1').on('click',function(){
    $(window).scrollTop($('#support1').position().top);
    $('.icon').toggleClass('close');
    $('.sm').slideToggle();
  });
  $('#link_support2').on('click',function(){
    $(window).scrollTop($('#support2').position().top);
    $('.icon').toggleClass('close');
    $('.sm').slideToggle();
  });
  $('#link_support3').on('click',function(){
    $(window).scrollTop($('#support2').position().top);
    $('.icon').toggleClass('close');
    $('.sm').slideToggle();
  });
  $('#link_support4').on('click',function(){
    $(window).scrollTop($('#support4').position().top);
    $('.icon').toggleClass('close');
    $('.sm').slideToggle();
  });
  $('#link_support5').on('click',function(){
    $(window).scrollTop($('#support5').position().top);
    $('.icon').toggleClass('close');
    $('.sm').slideToggle();
  });
</script>
<!--△△各サービス・サポートまでスクロールするjQuery△△ -->
<!--△△jQuery△△-->

</body>
</html>