<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a id="logo" class="navbar-brand mr-0 mr-md-2" href="{{ url('/') }}">
            <img src="http://image.broqiang.com//broqiang/logo320.png" class="img-responsive" width="36px" height="36px" alt="logo">
        </a>
        <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ml-4" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="mx-2 {{ active_class(if_route('posts.index')) }}">
                    <a class="nav-link" href="{{ route('posts.index') }}">全部</a>
                </li>
                @if(isset($skills))
                    @foreach($skills as $skill)
                        <li class="mx-2 {{ active_class((if_route('skills.show') && if_route_param('skill', $skill->id))) }}">
                            <a class="nav-link" href="{{ route('skills.show', $skill->id) }}">{{ $skill->name }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
            <!-- Right Side Of Navbar -->
            @include('layouts._header_right')
        </div>
    </div>
</nav>