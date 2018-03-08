<ul class="navbar-nav ml-auto">                
    <!-- Authentication Links -->
    @guest
    <li><a class="nav-link" href="{{ route('login') }}">登录</a></li>
    <li><a class="nav-link" href="{{ route('register') }}">注册</a></li>
    @else
    
    <li class="mr-3">
        <a class="nav-link secondary" href="#">
            <i class="fa fa-bell"></i>
            <span class="badge badge-light">0</span>
        </a>
    </li>

    <li class="nav-item dropdown">
        <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
            <span class="mr-1">
                <img src="{{ Auth::user()->avatar ?: 'http://image.broqiang.com//broqiang/empty-white.png' }}" width="22px" height="22px">
            </span>
            <span>
                {{ Auth::user()->name }}
            </span>
            <span class="caret">
            </span>
        </a>
        <div aria-labelledby="navbarDropdown" class="dropdown-menu">
            @if(Auth::user()->is_admin)
                <a class="dropdown-item" href="{{ route('admins.index') }}">
                    <i class="fa fa-cog fa-fw mr-1"></i>
                    后台管理
                </a>
            @endif

            <a class="dropdown-item" href="{{ route('users.show',Auth::id()) }}">
                <i class="fa fa-user fa-fw mr-1"></i>
                个人中心
            </a>
             <a class="dropdown-item" href="{{ route('users.edit',Auth::id()) }}">
                <i class="fa fa-edit fa-fw mr-1"></i>
                编辑资料
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out fa-fw mr-1"></i>
                退出
            </a>
            <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
    @endguest
</ul>