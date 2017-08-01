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
        <h1>プロフィール<small>タイムライン(直近10件まで)</small></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="image/person.png" alt="User profile picture">
                        <h3 class="profile-username text-center">{{$user['nickname']}}</h3>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Email</b> <a class="pull-right">{{$user['email']}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>誕生日</b> <a class="pull-right">{{$user['birthday']}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>身長</b> <a class="pull-right">{{$user['height']}} cm</a>
                            </li>
                            <li class="list-group-item">
                                <b>体重</b> <a class="pull-right">{{$user['weight']}} kg</a>
                            </li>
                            <li class="list-group-item">
                                <b>登録日</b> <a class="pull-right">{{$user['created_at']}}</a>
                            </li>
                        </ul>
<!--
                        <div style="text-align: right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modifyProfile">修正</button>
                        </div>

                        <div class="modal" id="modifyProfile" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="modalLabel">修正</h4>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Email</label><br>
                                            <input type="email" class="form-control" name="email" value="{{$user['email']}}">
                                        </div>

                                        <div class="form-group">
                                            <label>身長</label><br>
                                            <input type="number" class="form-control" name="height" value="{{$user['height']}}">
                                        </div>

                                        <div class="form-group">
                                            <label>体重</label><br>
                                            <input type="weight" class="form-control" name="weight" value="{{$user['weight']}}">
                                        </div>
                                    </div>

                                    <div class="modal-footer">

                                    </div>
                                </div>
                            </div>
                        </div>
                        -->
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <ul class="timeline">
                    @foreach($timeline as $data)
                        <li>
                            @if($data['type'] === 'user')
                                <i class="fa fa-{{$data['type']}} bg-yellow"></i>
                            @elseif($data['type'] === 'envelope')
                                <i class="fa fa-{{$data['type']}} bg-blue"></i>
                            @endif

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> {{$data['created_at']}}</span>

                                @if($data['message'] !== '')
                                    <h3 class="timeline-header">{{$data['title']}}</h3>
                                    <div class="timeline-body">{!! $data['message'] !!}</div>
                                @else
                                    <h3 class="timeline-header no-border">{{$data['title']}}</h3>
                                @endif
                            </div>
                        </li>
                    @endforeach
                    <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                    </li>
                </ul>
            </div>
        </div>
    </section>
@stop
@section('script')
    <script src="{{asset("bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js")}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
@stop
