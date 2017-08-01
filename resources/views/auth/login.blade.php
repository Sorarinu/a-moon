<!doctype html>
<head>
    <meta charset="utf-8">
    <title>ログイン</title>
    <!-- for responsive -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- bootstrap -->
    <link href="{{asset("bower_components/AdminLTE/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css"/>
    <!-- font awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!-- ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
    <!-- adminLTE style -->
    <link href="{{asset("bower_components/AdminLTE/dist/css/AdminLTE.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("bower_components/AdminLTE/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet"type="text/css"/>
    <link href="{{asset("bower_components/AdminLTE/plugins/iCheck/square/blue.css")}}" rel="stylesheet" type="text/css"/>
</head>

<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="">A-Moon</a>
        </div><!-- /.login-logo -->

        <div class="login-box-body">
            <p class="login-box-msg">ログインして下さい。</p>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                <strong>Error!</strong> ログインに失敗しました
                </div>
            @endif

            <form action="/health/login" method="post">
                {!! csrf_field() !!}
                <!-- メール -->
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Email"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <!-- パスワード -->
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="form-group">
                    <input type="checkbox" name="remember">ログイン状態を保持する
                </div>

                <!-- ボタン グリッドでセンタリング-->
                <div class="row">
                    <div class="col-xs-2">
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">ログイン</button>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <input type="button" value="新規登録" class="btn btn-danger btn-block btn-flat" onClick="location.href='http://warhol.ikulab.org/health/register'">
                    </div>
                    <div class="col-xs-2">
                    </div><!-- /.col -->
                </div>
                <br>
                <a href="/health/password/email">パスワードを忘れてしまった</a>
                <!-- token -->
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </form>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jquery -->
    <script src="{{asset("bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js")}}" type="text/javascript"></script>
    <!-- bootstrap -->
    <script src="{{asset("bower_components/AdminLTE/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
    <!-- adminLTE -->
    <script src="{{asset("bower_components/AdminLTE/dist/js/app.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("bower_components/AdminLTE/plugins/iCheck/icheck.min.js")}}" type="text/javascript"></script>

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>
</html>
