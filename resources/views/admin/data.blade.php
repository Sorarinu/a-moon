<?php
    $user = Auth::user();

    if ($user['authority'] === 0) {
        abort(403, '権限がありません');
    }
?>

@extends('layout')

@section('title')
    Ikulab Health
@stop

@section('sidebar')
    @include('sidebar')
@stop

@section('content')
    <section class="content-header">
        <h1>データ管理</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">登録データ一覧</h3>
                    </div>

                    <div class="box-body table-responsive">
                        <table id="adminDataTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>登録日</th>
                                    <th>基礎体温</th>
                                    <th>月経</th>
                                    <th>出血量</th>
                                    <th>月経痛</th>
                                    <th>鎮痛薬内服の有無</th>
                                    <th>おりもの</th>
                                    <th>量</th>
                                    <th>色</th>
                                    <th>症状</th>
                                    <th>月経時以外の出血</th>
                                    <th>からだの症状</th>
                                    <th>こころの症状</th>
                                    <th>画像</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($dataset as $d)
                                    <tr>
                                        <td>{{$d['created_at']}}</td>
                                        <td>{{$d['temperature']}}</td>
                                        <td>{{$d['menstruation']}}</td>
                                        <td>{{$d['amount_bleeding']}}</td>
                                        <td>{{$d['pain']}}</td>
                                        <td>{{$d['medicine']}}</td>
                                        <td>{{$d['discharge']}}</td>
                                        <td>{{$d['amount_discharge']}}</td>
                                        <td>{{$d['color']}}</td>
                                        <td>{{$d['behavior']}}</td>
                                        <td>{{$d['bleeding']}}</td>
                                        <td>{{$d['body']}}</td>
                                        <td>{{$d['heart']}}</td>
                                        <td><img src="{{$d['imagePath']}}"></img></td>
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
                $('#adminDataTable').DataTable({
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
