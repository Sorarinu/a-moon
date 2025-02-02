<?php
    $user = Auth::user();

    if ($user['authority'] === 0) {
        abort(403, '権限がありません');
    }
?>

@extends('layout')

@section('addcss')
    <style>
        .toggle-btn input {
            display: none;
        }

        .toggle-btn label {
            display: block;
            float: left;
            cursor: pointer;
            width: 70px;
            margin: 0;
            padding: 8px;
            background: #bdc3c7;
            color: #869198;
            font-size: 16px;
            text-align: center;
            line-height: 1;
            transition: .2s;
        }

        .toggle-btn label:first-of-type{
            border-radius: 3px 0 0 3px;
        }

        .toggle-btn label:last-of-type{
            border-radius: 0 3px 3px 0;
        }

        .toggle-btn input[type="radio"]:checked + .switch-on {
            background-color: #a1b91d;
            color: #fff;
        }

        .toggle-btn input[type="radio"]:checked + .switch-off {
            background-color: #e67168;
            color: #fff;
        }
    </style>
@stop

@section('title')
    Ikulab Health
@stop

@section('sidebar')
    @include('sidebar')
@stop

@section('content')
    <section class="content-header">
        <h1>ユーザ管理</h1>
    </section>

    <section class="content">
        @if (isset($status))
            @if ($status === 'ok')
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i>お知らせ</h4>
                    ユーザ情報を更新しました
                </div>
            @endif
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">登録ユーザ一覧</h3>
                    </div>

                    <div class="box-body table-responsive">
                        <table id="userDataTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>メールアドレス</th>
                                    <th>ニックネーム</th>
                                    <th>権限</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <form method="post" action="/health/viewUserGraph">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="userId" value="{{$user['email']}}">
                                                <input type="submit" class="btn btn-primary" value="グラフ閲覧">
                                            </form>
                                        </td>
                                        <td>{{$user['email']}}</td>
                                        <td>{{$user['nickname']}}</td>
                                        <td>
                                            <?php echo $user['authority'] === 1 ? '管理者' : '一般'; ?>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('script')
    <script src="{{asset("bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js")}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js" type="text/javascript"></script>
@stop

@section('addjs')
    <script>
        $( function () {
                $('#userDataTable').DataTable({
                    paging: true,
                    lengthChange: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                    scrollX: true,
                });
        });
    </script>
@stop
