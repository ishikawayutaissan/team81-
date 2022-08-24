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
    <title>登録</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
     <!-- 独自のCSSを反映する -->
     <!-- <link rel="stylesheet" href="{{ asset('css/login.css') }}">  -->

</head>

<body>
<div style="width: 500px; text-align:center; margin: 100px auto;">
    <h4>会員登録</h4>
    <div class="registerLink" style="text-align:right;">
    <a href="/user/top">  >>戻る << </a>
    </div>
    <form action="/user/memberRegister" method="post">
        @csrf
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>
                        権限
                        <div class="text-center text-danger">
                        (必須)
                        </div>
                    </th>
                    <td>
                        <!-- oldで$dataのroleがあればroleの値を入れる、無ければ’’が入る さらに！！$dataのroleの値が1の場合はチェックが入って、値が無ければ’’が入る （無い場合の例として新規登録の時。今回はバリデーションで引っ掛かります。-->
                        <input type="radio" name="role" value="1" {{ old('role',isset($data['role'])  ? $data['role'] : '') == 1 ? 'checked' : '' }} >{{App\Models\User::role['1']}}
                        <input type="radio" name="role" value="2" {{ old('role',isset($data['role'])  ? $data['role'] : '') == 2 ? 'checked' : '' }} >{{App\Models\User::role['2']}}
                        <div class="text-center text-danger">
                         @if($errors->has('role'))<br><span class="error">{{ $errors->first('role') }}</span> @endif
                        </div>
                    </td>
                </tr>    
                <tr>
                    <th>
                        企業名
                    </th>
                    <td>    
                        <input class="form-control" type="text" name="company"  placeholder="企業名"  value="{{ old('company',isset($data['company']) ? $data['company'] : '' )}}">
                        <div class="text-center text-danger">
                        @if($errors->has('company'))<br><span class="error">{{ $errors->first('company') }}</span> @endif
                        </div>
                    </td>
                </tr>   
                <tr>
                    <th>
                        部署名
                    </th>
                    <td>    
                        <input class="form-control" type="text" name="department" placeholder="部署名" value="{{ old('department',isset($data['department']) ? $data['department'] : '' )}}">
                        <div class="text-center text-danger">
                        @if($errors->has('department'))<br><span class="error">{{ $errors->first('department') }}</span> @endif
                        </div>
                    </td>
                </tr>   
                <tr>
                    <th>
                        役職
                    </th>
                    <td>    
                        <input class="form-control" type="text" name="position"  placeholder="役職"  value="{{ old('position',isset($data['position']) ? $data['position'] : '' )}}">
                        <div class="text-center text-danger">
                        @if($errors->has('position'))<br><span class="error">{{ $errors->first('position') }}</span> @endif
                        </div>
                    </td>
                </tr>   
                <tr>
                    <th>
                        氏名
                        <div class="text-center text-danger">
                        (必須)
                        </div>
                    </th>
                    <td>    
                        <input class="form-control" type="text" name="name"  placeholder="担当者名"  value="{{ old('name',isset($data['name']) ? $data['name'] : '' )}}">  
                        <div class="text-center text-danger">
                        @if($errors->has('name'))<br><span class="error">{{ $errors->first('name') }}</span> @endif
                        </div>
                    </td>
                </tr>   
                <tr>
                    <th>
                        電話番号
                        <div class="text-center text-danger">
                        (必須)
                        </div>
                    </th>
                    <td>    
                        <input class="form-control" type="text" name="tel"  placeholder="電話番号"  value="{{ old('tel',isset($data['tel']) ? $data['tel'] : '' )}}">
                        <div class="text-center">
                            (電話番号はハイフン無しで記入して下さい。)
                        </div>  
                        <div class="text-center text-danger">
                        @if($errors->has('tel'))<br><span class="error">{{ $errors->first('tel') }}</span> @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        メールアドレス
                        <div class="text-center text-danger">
                        (必須)
                        </div>
                    </th>
                    <td>    
                        <input class="form-control" type="text" name="email"  placeholder="メールアドレス"  value="{{ old('email',isset($data['email']) ? $data['email'] : '' )}}">
                        <div class="text-center text-danger">
                        @if($errors->has('email'))<br><span class="error">{{ $errors->first('email') }}</span> @endif
                        </div>
                    </td>
                </tr>                        
           </tbody>
        </table>   
        <input type="submit" class="btn btn-secondary" value="確認">
    </form>
</div>

</body>

</html>