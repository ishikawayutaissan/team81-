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
</head>
<body>
<p>{{ $name }}様</p>
</br>
<p>お問い合わせいただき、ありがとうございます。</p>   
<p>以下の内容でお問い合わせを受け付けました。</p>
<p>担当の者より後ほどご連絡を差し上げますので、今しばらくお待ちください</p>
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
</div>
</body>
</html>
