<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name=”keywords” Content=”PHP,Linux,Laravel,Go,博客,BroQiang″>
    <meta name="description" content="Bro Qiang 博客">
    <meta name="author" content="Bro Qiang<broqiang@qq.com>">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','title') - {{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @yield('css')
</head>

<body>
    <div id="app" class="{{ route_class() }}-page">
        @include('layouts._header')
        <header class="bs-docs-nav navbar navbar-static-top" id="top"></header>

        <main class="py-4">
            
            @include('common._error')
            @include('common._message')

            @yield('content')

        </main>
        <div style="position:fixed; right:50px; bottom:80px;"><a href="#top" class="btn btn-outline-info">返回顶部</a></div>
        @include('layouts._footer')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('script')

    @include('layouts._baidutongji')
</body>

</html>