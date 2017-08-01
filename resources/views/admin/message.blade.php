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
        <h1>メッセージ作成</h1>
    </section>

    <section class="content">
        @if (isset($status))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i>お知らせ</h4>
                送信しました
            </div>
        @endif

        <form action="/health/message" method="post">
            {!! csrf_field() !!}

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body pad">
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" placeholder="Subject:">
                            <br>
                            <textarea class="textarea" name="body" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div style="text-align: right">
                            <input type="submit" class="btn btn-primary" value="送信">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@stop
