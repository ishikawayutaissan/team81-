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
    <title>編集画面</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
   
</head>

<body>
<div style="width: 500px; text-align:center; margin: 100px auto;">
    <h4>ユーザー編集 会員ID:{{$user->id}}</h4>
    <div class="registerLink" style="text-align:right;">
    <a href="/user/top">  >>戻る << </a>
    </div>
    <form action="/user/memberEdit" method="post">
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
                        <input type="radio" name="role" value="1" {{ old('role',$user->role) == 1 ? 'checked' : '' }} >{{App\Models\User::role['1']}} 
                        <input type="radio" name="role" value="2" {{ old('role',$user->role) == 2 ? 'checked' : '' }} >{{App\Models\User::role['2']}}
                        <div class="text-center text-danger">
                         @if($errors->has('role'))<br><span class="error">{{ $errors->first('role') }}</span> @endif
                        </div>
                    </td>
                <tr>
                    <th>
                        会社名
                    </th>
                    <td>    
                        <input class="form-control" type="text" name="company" value="{{$user->company}}">
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
                        <input class="form-control" type="text" name="department" value="{{$user->department}}">
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
                        <input class="form-control" type="text" name="position" value="{{$user->position}}">
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
                        <input class="form-control" type="text" name="name" value="{{old('name',$user->name)}}">
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
                        <input class="form-control" type="text" name="tel" value="{{old('tel', $user->tel)}}">
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
                        <input class="form-control" type="text" name="email" value="{{old('email',$user->email)}}">
                        <div class="text-center text-danger">
                        @if($errors->has('email'))<br><span class="error">{{ $errors->first('email') }}</span> @endif
                        </div>
                    </td>
                </tr>        
           </tbody>
        </table>   
           <div class="form-group">
               <input type="submit" name="send" class="btn btn-primary" value="編集">
               <input type="submit" name="delete" class="btn btn-danger" value="削除">
            </div>
        <input  type="hidden" name="id" value="{{$user->id}}"> 
    </form>
   
</div>
</body>

</html>