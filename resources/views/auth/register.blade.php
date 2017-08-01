<!doctype html>
<head>
    <meta charset="utf-8">
    <title>新規登録</title>
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
    <link href="{{asset("bower_components/AdminLTE/plugins/iCheck/all.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("bower_components/AdminLTE/plugins/datepicker/datepicker3.css")}}" rel="stylesheet" type="text/css"/>
</head>

<body class="register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="">A-Moon</a>
        </div><!-- /.register-logo -->

        <div class="register-box-body">
            <p class="register-box-msg">ユーザ登録を行います<br><font style="color: red;">※登録されたデータは後から変更できません</font></p>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Error!</strong> 登録に失敗しました
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/health/register" method="post">
                {!! csrf_field() !!}

                <p>
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" name="email" placeholder="メールアドレス">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="nickname" placeholder="ニックネーム">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" id="datepicker" name="birthday" placeholder="生年月日">
                        <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="number" class="form-control" name="height" placeholder="身長">
                        <span class="glyphicon glyphicon-heart-empty form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="number" class="form-control" name="weight" placeholder="体重">
                        <span class="glyphicon glyphicon-heart-empty form-control-feedback"></span>
                    </div>
                </p>

                <p>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" placeholder="パスワード">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="パスワード（確認）">
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>

                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label><input type="checkbox" name="agree"><a href="#modal-agreement" data-toggle="modal">利用規約</a>に同意する</label>
                            </div>
                        </div>
                            <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">登録</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </p>

                <input type="hidden" name="authority" value="0">
            </form>
            <a href="/health/login" class="text-center">すでに登録済みの方はこちら</a>
        </div><!-- /.register-box-body -->

        <div class="modal" id="modal-agreement">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">個人情報取り扱いについて</h4>
                    </div>
                    <div class="modal-body">
                        <p>{!!$privacyPolicy!!}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.register-box -->

    <!-- jquery -->
    <script src="{{asset("bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js")}}" type="text/javascript"></script>
    <!-- bootstrap -->
    <script src="{{asset("bower_components/AdminLTE/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
    <!-- adminLTE -->
    <script src="{{asset("bower_components/AdminLTE/dist/js/app.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("bower_components/AdminLTE/plugins/iCheck/icheck.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js")}}" type="text/javascript"></script>
    <script src="{{asset("bower_components/AdminLTE/plugins/datepicker/locales/bootstrap-datepicker.ja.js")}}" type="text/javascript"></script>

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });

            $('#datepicker').datepicker({
                autoclose: true,
                language: 'ja'
            });

            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
    </script>
</body>
</html>
