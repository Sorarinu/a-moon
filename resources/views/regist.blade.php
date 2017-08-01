<?php
$user = Auth::user();
$dt = \Carbon\Carbon::now();
?>

@extends('layout')

@section('addcss')
    <link href="{{asset("bower_components/AdminLTE/plugins/iCheck/all.css")}}" rel="stylesheet" type="text/css"/>
@stop

@section('title')
    Ikulab Health
@stop

@section('sidebar')
    @include('sidebar')
@stop

@section('content')
    <section class="content-header">
        <h1>データ登録</h1>
    </section>

    <section class="content">
        @if (isset($status))
            @if ($status === 'regist')
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i>お知らせ</h4>
                    登録が完了しました
                </div>
            @endif

            @if ($status === 'error')
                <div class="alert alert-danger">
                    <strong>Error!</strong> 既に登録されています！
                </div>
            @endif
        @endif

        <form action="/health/regist" method="post">
            {!! csrf_field() !!}

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label>登録日</label><br>
                            <p>
                                <label>
                                    <input type="radio" name="registDay" class="flat-red" value="{!!$dt->format('Y-m-d')!!}" checked> 今日
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="radio" name="registDay" class="flat-red" value="{!!$dt->subDay()->format('Y-m-d')!!}"> 昨日
                                </label>
                            </p>
                        </div>

                        <div class="form-group">
                            <label>基礎体温</label>
                            <input type="text" class="form-control" name="temperature" data-inputmask='"mask": "99.99"' data-mask>
                        </div>

                        <div class="form-group">
                            <label>月経</label>
                            <select class="form-control select2" name="menstruation" style="width: 100%;">
                                <option value="あり">あり</option>
                                <option value="なし" selected="selected">なし</option>
                            </select>
                        </div>

                        <div class="box" id="menstruationDetail" style="background-color: #CEF6F5; display: none;">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>出血量</label>
                                    <select class="form-control select2" name="amount_bleeding" style="width: 100%;">
                                        <option value="">選択してください</option>
                                        <option value="少ない">少ない</option>
                                        <option value="普通">普通</option>
                                        <option value="多い">多い</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>月経痛</label>
                                    <select class="form-control select2" name="pain" style="width: 100%;">
                                        <option value="">選択してください</option>
                                        <option value="ない">ない</option>
                                        <option value="少し痛い">少し痛い</option>
                                        <option value="ひどく痛い">ひどく痛い</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>鎮痛薬内服の有無</label>
                                    <select class="form-control select2" name="medicine" style="width: 100%;">
                                        <option value="">選択してください</option>
                                        <option value="あり">あり</option>
                                        <option value="なし">なし</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>おりもの</label>
                            <select class="form-control select2" name="discharge" style="width: 100%;">
                                <option value="あり">あり</option>
                                <option value="なし" selected="selected">なし</option>
                            </select>
                        </div>

                        <div class="box" id="dischargeDetail" style="background-color: #CEF6F5; display: none;">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>量</label>
                                    <select class="form-control select2" name="amount_discharge" style="width: 100%;">
                                        <option value="">選択してください</option>
                                        <option value="少ない">少ない</option>
                                        <option value="やや多い">やや多い</option>
                                        <option value="多い">多い</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>色</label>
                                    <select class="form-control select2" name="color" style="width: 100%;">
                                        <option value="">選択してください</option>
                                        <option value="透明">透明</option>
                                        <option value="白っぽい">白っぽい</option>
                                        <option value="黄色っぽい">黄色っぽい</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>症状</label>
                                    <select class="form-control select2" name="behavior" style="width: 100%;">
                                        <option value="">選択してください</option>
                                        <option value="サラサラ">サラサラ</option>
                                        <option value="普通">普通</option>
                                        <option value="ネバネバ">ネバネバ</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>月経時以外の出血</label>
                            <select class="form-control select2" name="bleeding" style="width: 100%;">
                                <option value="あり">あり</option>
                                <option value="なし" selected="selected">なし</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>からだの症状</label>
                            <select class="form-control select2" name="body[]" multiple="multiple" data-placeholder="症状を選択" style="width: 100%;">
                                <option value="頭痛" >頭痛</option>
                                <option value="乳房痛" >乳房痛</option>
                                <option value="むくみ" >むくみ</option>
                                <option value="腹痛" >腹痛</option>
                                <option value="腰痛" >腰痛</option>
                                <option value="腹部膨満" >腹部膨満</option>
                                <option value="肌荒れ" >肌荒れ</option>
                                <option value="吐き気" >吐き気</option>
                                <option value="気分不良" >気分不良</option>
                                <option value="便秘" >便秘</option>
                                <option value="下痢" >下痢</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>こころの症状</label>
                            <select class="form-control select2" name="heart[]" multiple="multiple" data-placeholder="症状を選択" style="width: 100%;">
                                <option value="イライラ" >イライラ</option>
                                <option value="憂鬱" >憂鬱</option>
                                <option value="無気力" >無気力</option>
                                <option value="集中できない" >集中できない</option>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="userId" value="{{$user['email']}}">

                    <div class="box-footer">
                        <div style="text-align: right">
                            <input type="submit" class="btn btn-primary" value="登録">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@stop

@section('addjs')
    <script src="{{asset("bower_components/AdminLTE/plugins/iCheck/icheck.min.js")}}" type="text/javascript"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });

            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
    </script>
@stop
