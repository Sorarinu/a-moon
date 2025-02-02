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
        <h1>グラフ表示-{{$userId}}</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">基礎体温グラフ</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>

                    <div class="box-body chart-responsive">
                        <div class="chart" id="chartdiv" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
    <script src="{{asset("bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js")}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js" type="text/javascript"></script>
    <script src="{{asset("bower_components/AdminLTE/plugins/morris/morris.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js")}}" type="text/javascript"></script>
    <script src="{{asset("bower_components/AdminLTE/plugins/datepicker/locales/bootstrap-datepicker.ja.js")}}" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script>
        $(function () {
            "use strict";

            var chart = AmCharts.makeChart("chartdiv", {
                "type": "serial",
                "theme": "light",
                "dataProvider": [
                    <?php foreach($dataset as  $data) { ?>
                        {
                            <?php
                                $tmp = json_decode(json_encode($data), true);

                                foreach($tmp as $key => $value) {
                                    if($key === 'menstruation' && $value === 'あり') {
                                        echo '"' . $key . '": "<font color=\"red\">' . $value . '</font>",';
                                    } else {
                                        echo '"' . $key . '": "' . $value . '",';
                                    }

                                    if ($key === 'plot') {
                                        echo '"customBullet": "image/' . $value . '",';
                                    }
                                }
                            ?>
                        },
                    <?php } ?>
                ],
                "valueAxes": [{
                    "axisAlpha": 0,
                    "dashLength": 1,
                    "position": "left",
                    "guides": [{
                        "dashLength": 6,
                        "inside": true,
                        "label": "36.7℃",
                        "lineAlpha": 1,
                        "lineColor": "#d1655d",
                        "value": 36.7
                    }],
                }],
                "graphs": [{
                    "useLineColorForBulletBorder": true,
                    "id": "g1",
                    "lineColor": "#637dd6",
                    "lineThickness": 2,
                    "bulletSize": 18,
                    "connect": false,
                    "customBullet": "image/dotpoint.png",
                    "customBulletField": "customBullet",
                    "valueField": "temperature",
                    "balloonText": "<div style='margin:10px; text-align:left;'><span style='font-size:10px'>[[category]]</span><br><br><span style='font-size:13px'>基礎体温:[[value]]℃<br>月経:[[menstruation]]<br>出血量:[[amount_bleeding]]<br>月経痛:[[pain]]<br>鎮痛薬内服の有無:[[medicine]]<br>おりもの:[[discharge]]<br>量:[[amount_discharge]]<br>色:[[color]]<br>症状:[[behavior]]<br>月経時以外の出血:[[bleeding]]<br>からだの症状:[[body]]<br>こころの症状:[[heart]]</span></div>",
                }],
                "chartCursor": {
                    "cursorPosition": "mouse",
                    "graphBulletSize": 1.5,
                    "zoomable": false,
                    "valueZoomable": false,     //縦ズーム設定
                    "cursorAlpha": 0,
                    "valueLineEnabled": true,
                    "valueLineBalloonEnabled": true,
                    "valueLineAlpha": 0.2,
                    "categoryBalloonFunction": 
                        function(date) {
                            return date.toLocaleDateString();
                        }
                },
                "autoMargins": true,
                "dataDateFormat": "YYYY-MM-DD",
                "categoryField": "date",
                "categoryAxis": {
                    "parseDates": true,
                    "dashLength": 1,
                    "minorGridEnabled": true,
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "inside": false,
                    "tickLength": 0,
                    "labelFunction":
                        function(valueText, date, categoryAxis) {
                            return date.toLocaleDateString();
                        }
                },
                "chartScrollbar": {
                    "graph": "g1",
                    "oppositeAxis": false,
                    "offset": 30,
                    "scrollbarHeight": 80,
                    "backgroundAlpha": 0,
                    "selectedBackgroundAlpha": 0.1,
                    "selectedBackgroundColor": "#888888",
                    "graphFillAlpha": 0,
                    "graphLineAlpha": 0.5,
                    "selectedGraphFillAlpha": 0,
                    "selectedGraphLineAlpha": 1,
                    "autoGridCount": true,
                    "color": "#AAAAAA"
                },
                "export": {
                    "enabled": true
                }
            });

            // プロットクリック時の処理
            /*chart.addListener("init", function () {
                chart.addListener("clickGraphItem", function (e) {
                    //console.dir(e);
                    //window.location.href = 'http://warhol.ikulab.org/health/detail/' + e.item.values["date"];
                });
            });*/

            chart.addListener("rendered", zoomChart);
            zoomChart();

            function zoomChart() {
                chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
            }
        });
    </script>
