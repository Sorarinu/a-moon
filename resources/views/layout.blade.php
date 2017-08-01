<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>Health</title>
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
        <!-- for responsive -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- bootstrap -->
        <link href="{{asset("bower_components/AdminLTE/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- font awesome -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- adminLTE style -->
        <link href="{{asset("bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{asset("bower_components/AdminLTE/plugins/select2/select2.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{asset("bower_components/AdminLTE/dist/css/skins/_all-skins.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{asset("bower_components/AdminLTE/plugins/morris/morris.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{asset("bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{asset("bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{asset("bower_components/AdminLTE/plugins/datepicker/datepicker3.css")}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset("css/style.css")}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
        @yield('addcss')
        <style>
            #chartdiv {
                width: 100%;
                height: 500px;
            }
        </style>
    </head>

    <body class="skin-black-light sidebar-mini">
        <div class="wrapper">
            @include('header')
            @yield('sidebar')

            <div class="content-wrapper">
                @yield('content')
            </div>

            @include("footer")
        </div>

        <!-- jquery -->
        <script src="{{asset("bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js")}}" type="text/javascript"></script>
        <!-- bootstrap -->
        <script src="{{asset("bower_components/AdminLTE/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
        <!-- adminLTE -->
        <script src="{{asset("bower_components/AdminLTE/dist/js/app.min.js")}}" type="text/javascript"></script>

        <script src="{{asset("bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.js")}}"></script>
        <script src="{{asset("bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js")}}"></script>
        <script src="{{asset("bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js")}}"></script>
        <script src="{{asset("bower_components/AdminLTE/plugins/select2/select2.full.min.js")}}"></script>
        <script src="{{asset("bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js")}}" type="text/javascript"></script>
        <script src="{{asset("bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js")}}" type="text/javascript"></script>
        <script src="{{asset("bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}}" type="text/javascript"></script>
        <script src="{{asset("bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js")}}" type="text/javascript"></script>
        <script src="{{asset("bower_components/AdminLTE/plugins/datepicker/locales/bootstrap-datepicker.ja.js")}}" type="text/javascript"></script>

        @yield('addjs')

        <script>
            $(function () {
                $(".select2").select2();

                $("[data-mask]").inputmask();

                if ($('select[name="menstruation"] option:selected').val() == 'あり') $("[id=menstruationDetail]").css('display', 'block');
                else $("[id=menstruationDetail]").css('display', 'none');

                if ($('select[name="discharge"] option:selected').val() == 'あり') $("[id=dischargeDetail]").css('display', 'block');
                else $("[id=dischargeDetail]").css('display', 'none');

                $('select[name="menstruation"]').change(function () {
                    if ($('select[name="menstruation"] option:selected').val() == 'あり') $("[id=menstruationDetail]").css('display', 'block');
                    else $("[id=menstruationDetail]").css('display', 'none');
                });

                $('select[name="discharge"]').change(function () {
                    if ($('select[name="discharge"] option:selected').val() == 'あり') $("[id=dischargeDetail]").css('display', 'block');
                    else $("[id=dischargeDetail]").css('display', 'none');
                });

                $('#dataTable').DataTable({
                    paging: true,
                    lengthChange: false,
                    searching: false,
                    ordering: false,
                    info: true,
                    autoWidth: true,
                    scrollX: true,
                });

                $(".textarea").wysihtml5();


                $('#datepicker').datepicker({
                    autoclose: true,
                    language: 'ja'
                });

            });
        </script>
    </body>
</html>
