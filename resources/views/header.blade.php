<?php $user = Auth::user(); ?>


<!-- トップメニュー -->
<header class="main-header">
    <a href="/health" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>M</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">A-Moon</span>
    </a>

    <!-- トップメニュー -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- サイドバー制御 -->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <!-- 右メニュー -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!--<li><a href="/health"><i class="fa fa-user"></i>{{$user['email']}}</a></li>-->
                <li><a href="/health/logout"><i class="fa fa-sign-out"></i> ログアウト</a></li>
            </ul>
        </div>
    </nav>
</header><!-- end header -->
