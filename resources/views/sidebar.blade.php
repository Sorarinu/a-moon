<?php $user = Auth::user(); ?>

<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">メニュー</li>

            <li>
                <a href="/health">
                    <i class="fa fa-dashboard"></i> <span>グラフ表示</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>

            <li>
                <a href="/health/profile">
                    <i class="fa fa-user"></i> <span>プロフィール</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>

            <li>
                <a href="/health/regist">
                    <i class="fa fa-plus"></i> <span>データ登録</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>

            <li>
                <a href="/health/viewData">
                    <i class="fa fa-database"></i> <span>登録データ</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>

            @if($user['email'] === 'c01143125b@edu.teu.ac.jp')
            <li>
                <a href="/health/settings">
                    <i class="fa fa-gears"></i> <span>設定</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>

            <li>
                <a href="/health/todo">
                    <i class="fa fa-question-circle"></i> <span>TODO</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
            @endif

            @if($user['authority'] === 1)
                <li class="header">管理者メニュー</li>

                <li>
                    <a href="/health/data">
                        <i class="fa fa-database"></i> <span>データ管理</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>

                <li>
                    <a href="/health/message">
                        <i class="fa fa-envelope"></i> <span>メッセージ作成</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>

                @if($user['email'] === 'c01143125b@edu.teu.ac.jp')
                <li>
                    <a href="/health/users">
                        <i class="fa fa-group"></i> <span>ユーザ管理</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                @endif
            @endif
        </ul>
    </section>
</aside>
