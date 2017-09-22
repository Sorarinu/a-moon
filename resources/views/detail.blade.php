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
        <h1>詳細表示</h1>
    </section>

    <ol class="breadcrumb">
        <li><a href="http://warhol.ikulab.org/health/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> グラフ表示</a></li>
        <li class="active">詳細表示</li>
    </ol>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$dataset['date']}}</h3>
                    </div>

                    <div class="box-body">
                        <div class="list-group">
                            <ul class="list-group-item">
                                <h4 class="list-group-item-heading" style="font-weight: bold;">基礎体温</h4>
                                <p class="list-group-item-text">{{$dataset['temperature']}}</p>
                            </ul>
                            <ul class="list-group-item">
                                <h4 class="list-group-item-heading" style="font-weight: bold;">月経</h4>
                                <p class="list-group-item-text">{{$dataset['menstruation']}}</p>
                            </ul>
                            <ul class="list-group-item">
                                <h4 class="list-group-item-heading" style="font-weight: bold;">出血量</h4>
                                <p class="list-group-item-text">{{$dataset['amount_bleeding']}}</p>
                            </ul>
                            <ul class="list-group-item">
                                <h4 class="list-group-item-heading" style="font-weight: bold;">月経痛</h4>
                                <p class="list-group-item-text">{{$dataset['pain']}}</p>
                            </ul>
                            <ul class="list-group-item">
                                <h4 class="list-group-item-heading" style="font-weight: bold;">鎮痛薬内服の有無</h4>
                                <p class="list-group-item-text">{{$dataset['medicine']}}</p>
                            </ul>
                            <ul class="list-group-item">
                                <h4 class="list-group-item-heading" style="font-weight: bold;">おりもの</h4>
                                <p class="list-group-item-text">{{$dataset['discharge']}}</p>
                            </ul>
                            <ul class="list-group-item">
                                <h4 class="list-group-item-heading" style="font-weight: bold;">量</h4>
                                <p class="list-group-item-text">{{$dataset['amount_discharge']}}</p>
                            </ul>
                            <ul class="list-group-item">
                                <h4 class="list-group-item-heading" style="font-weight: bold;">色</h4>
                                <p class="list-group-item-text">{{$dataset['color']}}</p>
                            </ul>
                            <ul class="list-group-item">
                                <h4 class="list-group-item-heading" style="font-weight: bold;">症状</h4>
                                <p class="list-group-item-text">{{$dataset['behavior']}}</p>
                            </ul>
                            <ul class="list-group-item">
                                <h4 class="list-group-item-heading" style="font-weight: bold;">月経時以外の出血</h4>
                                <p class="list-group-item-text">{{$dataset['bleeding']}}</p>
                            </ul>
                            <ul class="list-group-item">
                                <h4 class="list-group-item-heading" style="font-weight: bold;">からだの症状</h4>
                                <p class="list-group-item-text">{{$dataset['body']}}</p>
                            </ul>
                            <ul class="list-group-item">
                                <h4 class="list-group-item-heading" style="font-weight: bold;">こころの症状</h4>
                                <p class="list-group-item-text">{{$dataset['heart']}}</p>
                            </ul>
                            <ul class="list-group-item">
                                <h4 class="list-group-item-heading" style="font-weight: bold;">画像</h4>
                                <p class="list-group-item-text">
                                    <img alt='画像なし' src="../{{$dataset['imagePath']}}"></img>
                                </p>
                            </ul>
                        </div>
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
