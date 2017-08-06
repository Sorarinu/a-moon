<?php $user = Auth::user(); ?>

@extends('layout')

@section('title')
    Ikulab Health
@stop

@section('sidebar')
    @include('sidebar')
@stop

@section('content')
    <section class="content-header">
        <h1>TODO Lists</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                ・レジメ，スライドを作る（優先度：高）<br>
                ・月経日，排卵日予測<br>
                ・グラフのプロットを項目数ごとに色分け<br>
                ・データ登録画面より，画像をアップロードできるように<br>
                ・管理者ユーザから各ユーザごとのグラフを閲覧できるようにする<br>
                ・アドバイス機能（優先度：低）
            </div>
        </div>
    </section>
@stop
@section('script')
    <script src="{{asset("bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js")}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
@stop
