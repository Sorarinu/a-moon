<!doctype html>
<head>
<meta charset="utf-8">
<title>パスワードリセット</title>
<!-- for responsive -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- bootstrap -->
<link href="{{asset("bower_components/AdminLTE/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet"
type="text/css"/>
<!-- font awesome -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
type="text/css"/>
<!-- ionicons -->
<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
<!-- adminLTE style -->
<link href="{{asset("bower_components/AdminLTE/dist/css/AdminLTE.css")}}" rel="stylesheet" type="text/css"/>
<link href="{{asset("bower_components/AdminLTE/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet"
type="text/css"/>
</head>
<body class="login-page">
<div class="login-box">

<div class="login-logo">
<a href="">A-Moon</a>
</div><!-- /.login-logo -->

<div class="login-box-body">
<p class="login-box-msg">パスワードをリセットするメールアドレスを入力してください．</p>

@if (count($errors) > 0)
    <div class="alert alert-danger">
    <strong>Error!</strong> ユーザが見つかりません
    </div>
    @endif

    <form action="/health/password/email" method="post">
{!! csrf_field() !!}

<!-- メール -->
<div class="form-group has-feedback">
<input type="email" name="email" class="form-control" placeholder="Input your Email"/>
<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
</div>

<!-- ボタン グリッドでセンタリング-->
<div class="row">
<div class="col-xs-4">
</div><!-- /.col -->
<div class="col-xs-4">
<button type="submit" class="btn btn-primary btn-block btn-flat">送信</button>
</div><!-- /.col -->
<div class="col-xs-4">
</div><!-- /.col -->
</div>
</form>

</div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<!-- JS -->

<!-- jquery -->
<script src="{{asset("bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js")}}" type="text/javascript"></script>
<!-- bootstrap -->
<script src="{{asset("bower_components/AdminLTE/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
<!-- adminLTE -->
<script src="{{asset("bower_components/AdminLTE/dist/js/app.min.js")}}" type="text/javascript"></script>

</body>
</html>
