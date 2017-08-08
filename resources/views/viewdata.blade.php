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
        <h1>登録データ</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body table-responsive">
                        <table id="userViewDataTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>日付</th>
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
                                    <th>からだ</th>
                                    <th>こころ</th>
                                    <th>画像</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($dataset as $d)
                                    <?php
                                        $bodyData = explode(',', $d->body);
                                        $heartData = explode(',', $d->heart);
                                    ?>
                                    <tr>
                                        <form action="/health/viewData" method="post">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="userId" value="{{$user->email}}">
                                            <input type="hidden" name="id" value="{{$d->id}}">
                                            <input type="hidden" name="date" value="{{$d->date}}">

                                            <td>
                                                <div style="text-align: center">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modify-{{$d->id}}">修正</button>
                                                </div>

                                                <div class="modal" id="modify-{{$d->id}}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <h4 class="modal-title" id="modalLabel">修正　<small><font style="color: red;">新規に入力された内容で上書きします</font></small></h4>
                                                            </div>

                                                            <div class="modal-body">
                                                                <p>
                                                                    <div class="form-group">
                                                                        <label>基礎体温</label><br>
                                                                        <input type="text" class="form-control" name="temperature" data-inputmask='"mask": "99.99"' data-mask value="{{$d->temperature}}">
                                                                    </div>
                                                                </p>

                                                                <p>
                                                                    <div class="form-group">
                                                                        <label>月経</label><br>
                                                                        <select class="form-control select2" name="menstruation" style="width: 100%;">
                                                                            <option value="あり" <?php echo ($d->menstruation === 'あり') ? 'selected' : ''; ?>>あり</option>
                                                                            <option value="なし" <?php echo ($d->menstruation === 'なし') ? 'selected' : ''; ?>>なし</option>
                                                                        </select>
                                                                    </div>
                                                                </p>

                                                                <p>
                                                                    <div class="box" style="background-color: #CEF6F5;">
                                                                        <div class="box-body">
                                                                            <div class="form-group">
                                                                                <label>出血量</label><br>
                                                                                <select class="form-control select2" name="amount_bleeding" style="width: 100%;">
                                                                                    <option value="">選択してください</option>
                                                                                    <option value="少ない" <?php echo ($d->amount_bleeding === '少ない') ? 'selected' : ''; ?>>少ない</option>
                                                                                    <option value="普通" <?php echo ($d->amount_bleeding === '普通') ? 'selected' : ''; ?>>普通</option>
                                                                                    <option value="多い" <?php echo ($d->amount_bleeding === '多い') ? 'selected' : ''; ?>>多い</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>月経痛</label><br>
                                                                                <select class="form-control select2" name="pain" style="width: 100%;">
                                                                                    <option value="">選択してください</option>
                                                                                    <option value="ない" <?php echo ($d->pain === 'ない') ? 'selected' : ''; ?>>ない</option>
                                                                                    <option value="少し痛い" <?php echo ($d->pain === '少し痛い') ? 'selected' : ''; ?>>少し痛い</option>
                                                                                    <option value="ひどく痛い" <?php echo ($d->pain === 'ひどく痛い') ? 'selected' : ''; ?>>ひどく痛い</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>鎮痛薬内服の有無</label><br>
                                                                                <select class="form-control select2" name="medicine" style="width: 100%;">
                                                                                    <option value="">選択してください</option>
                                                                                    <option value="あり" <?php echo ($d->medicine === 'あり') ? 'selected' : ''; ?>>あり</option>
                                                                                    <option value="なし" <?php echo ($d->medicine === 'なし') ? 'selected' : ''; ?>>なし</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </p>

                                                                <p>
                                                                    <div class="form-group">
                                                                        <label>おりもの</label><br>
                                                                        <select class="form-control select2" name="discharge" style="width: 100%;">
                                                                            <option value="あり" <?php echo ($d->discharge === 'あり') ? 'selected' : ''; ?>>あり</option>
                                                                            <option value="なし" <?php echo ($d->discharge === 'なし') ? 'selected' : ''; ?>>なし</option>
                                                                        </select>
                                                                    </div>
                                                                </p>

                                                                <p>
                                                                    <div class="box" style="background-color: #CEF6F5;">
                                                                        <div class="box-body">
                                                                            <div class="form-group">
                                                                                <label>量</label><br>
                                                                                <select class="form-control select2" name="amount_discharge" style="width: 100%;">
                                                                                    <option value="">選択してください</option>
                                                                                    <option value="少ない" <?php echo ($d->amount_discharge === '少ない') ? 'selected' : ''; ?>>少ない</option>
                                                                                    <option value="やや多い" <?php echo ($d->amount_discharge === 'やや多い') ? 'selected' : ''; ?>>やや多い</option>
                                                                                    <option value="多い" <?php echo ($d->amount_discharge === '多い') ? 'selected' : ''; ?>>多い</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>色</label><br>
                                                                                <select class="form-control select2" name="color" style="width: 100%;">
                                                                                    <option value="">選択してください</option>
                                                                                    <option value="透明" <?php echo ($d->color === '透明') ? 'selected' : ''; ?>>透明</option>
                                                                                    <option value="白っぽい" <?php echo ($d->color === '白っぽい') ? 'selected' : ''; ?>>白っぽい</option>
                                                                                    <option value="黄色っぽい" <?php echo ($d->color === '黄色っぽい') ? 'selected' : ''; ?>>黄色っぽい</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>症状</label><br>
                                                                                <select class="form-control select2" name="behavior" style="width: 100%;">
                                                                                    <option value="">選択してください</option>
                                                                                    <option value="サラサラ" <?php echo ($d->behavior === 'サラサラ') ? 'selected' : ''; ?>>サラサラ</option>
                                                                                    <option value="普通" <?php echo ($d->behavior === '普通') ? 'selected' : ''; ?>>普通</option>
                                                                                    <option value="ネバネバ" <?php echo ($d->behavior === 'ネバネバ') ? 'selected' : ''; ?>>ネバネバ</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </p>

                                                                <p>
                                                                    <div class="form-group">
                                                                        <label>月経時以外の出血</label><br>
                                                                        <select class="form-control select2" name="bleeding" style="width: 100%;">
                                                                            <option value="あり" <?php echo ($d->bleeding === 'あり') ? 'selected' : ''; ?>>あり</option>
                                                                            <option value="なし" <?php echo ($d->bleeding === 'なし') ? 'selected' : ''; ?>>なし</option>
                                                                        </select>
                                                                    </div>
                                                                </p>

                                                                <p>
                                                                    <div class="form-group">
                                                                        <label>からだの症状</label><br>
                                                                        <select class="form-control select2" name="body[]" multiple="multiple" data-placeholder="症状を選択" style="width: 100%;">
                                                                            <option value="頭痛" <?php echo in_array('頭痛', $bodyData) ? 'selected' : ''; ?> >頭痛</option>
                                                                            <option value="乳房痛" <?php echo in_array('乳房痛', $bodyData) ? 'selected' : ''; ?> >乳房痛</option>
                                                                            <option value="むくみ" <?php echo in_array('むくみ', $bodyData) ? 'selected' : ''; ?> >むくみ</option>
                                                                            <option value="腹痛" <?php echo in_array('腹痛', $bodyData) ? 'selected' : ''; ?> >腹痛</option>
                                                                            <option value="腰痛" <?php echo in_array('腰痛', $bodyData) ? 'selected' : ''; ?> >腰痛</option>
                                                                            <option value="腹部膨満" <?php echo in_array('腹部膨満', $bodyData) ? 'selected' : ''; ?> >腹部膨満</option>
                                                                            <option value="肌荒れ" <?php echo in_array('肌荒れ', $bodyData) ? 'selected' : ''; ?> >肌荒れ</option>
                                                                            <option value="吐き気" <?php echo in_array('吐き気', $bodyData) ? 'selected' : ''; ?> >吐き気</option>
                                                                            <option value="気分不良" <?php echo in_array('気分不良', $bodyData) ? 'selected' : ''; ?> >気分不良</option>
                                                                            <option value="便秘" <?php echo in_array('便秘', $bodyData) ? 'selected' : ''; ?> >便秘</option>
                                                                            <option value="下痢" <?php echo in_array('下痢', $bodyData) ? 'selected' : ''; ?> >下痢</option>
                                                                        </select>
                                                                    </div>
                                                                </p>

                                                                <p>
                                                                    <div class="form-group">
                                                                        <label>こころの症状</label><br>
                                                                        <select class="form-control select2" name="heart[]" multiple="multiple" data-placeholder="症状を選択" style="width: 100%;">
                                                                            <option value="イライラ" <?php echo in_array('イライラ', $heartData) ? 'selected' : ''; ?> >イライラ</option>
                                                                            <option value="憂鬱" <?php echo in_array('憂鬱', $heartData) ? 'selected' : ''; ?> >憂鬱</option>
                                                                            <option value="無気力" <?php echo in_array('無気力', $heartData) ? 'selected' : ''; ?> >無気力</option>
                                                                            <option value="集中できない" <?php echo in_array('集中できない', $heartData) ? 'selected' : ''; ?> >集中できない</option>
                                                                        </select>
                                                                    </div>
                                                                </p>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                                                                <input type="submit" class="btn btn-primary" value="登録">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$d->date}}</td>
                                            <td>{{$d->temperature}}</td>
                                            @if($d->menstruation === 'なし')
                                                <td>{{$d->menstruation}}</td>
                                            @else
                                                <td style="color: red;">{{$d->menstruation}}</td>
                                            @endif
                                            <td>{{$d->amount_bleeding}}</td>
                                            <td>{{$d->pain}}</td>
                                            <td>{{$d->medicine}}</td>
                                            <td>{{$d->discharge}}</td>
                                            <td>{{$d->amount_discharge}}</td>
                                            <td>{{$d->color}}</td>
                                            <td>{{$d->behavior}}</td>
                                            <td>{{$d->bleeding}}</td>
                                            <td>{{$d->body}}</td>
                                            <td>{{$d->heart}}</td>
                                            <td><img src="{{$d->imagePath}}"></td>
                                        </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
@stop

@section('addjs')
    <script>
        $( function () {
                $('#userViewDataTable').DataTable({
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
