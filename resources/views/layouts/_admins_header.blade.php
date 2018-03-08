<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a id="logo" class="navbar-brand mr-0 mr-md-2 text-info" href="{{ route('admins.index') }}">
            后台
        </a>
        <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ml-4" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="mx-2 {{ active_class(if_route('admins.index')) }}">
                    <a class="nav-link" href="{{ route('admins.index') }}">控制面板</a>
                </li>
                
                <li class="nav-item dropdown mx-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    内容管理
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admins.posts.index') }}">
                            <i class="fa fa-file-o mr-2 text-info"></i>博客列表
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-bell-o mr-2 text-info"></i>回复列表
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown  mx-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    用户管理
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="javascript: void(0);">
                            <i class="fa fa-user-o mr-2 text-info"></i>暂时没有此功能
                        </a>
                    </div>
                </li>
                <li class="mx-2">
                    <a class="nav-link text-success" href="{{ route('posts.index') }}" target="_blank">预览前台</a>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            @include('layouts._header_right')
        </div>
    </div>
</nav>