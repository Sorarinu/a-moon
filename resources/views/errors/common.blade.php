<!DOCTYPE html>
<html>
    <head>
        <title>Be right back.</title>
        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>

    <body>
        <?php
        $status_code = $exception->getStatusCode();
        $message = $exception->getMessage();

        if (!$message) {
            switch ($status_code) {
                case 400:
                    $message = 'Bad Request...';
                    break;

                case 403:
                    $message = 'Forbidden...';
                    break;

                case 404:
                    $message = 'Not Found...';
                    break;

                case 503:
                    $message = 'メンテナンス中です．';
                    break;

                default:
                    $message = 'Error...';
                    break;
            }
        }
        ?>
        <div class="container">
            <div class="content">
                <div class="title">{{$status_code}} {{$message}}</div>
            </div>
        </div>
    </body>
</html>
