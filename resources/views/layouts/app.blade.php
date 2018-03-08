<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    
        <main class="py-4">
            
            @include('common._error')
            @include('common._message')

            @yield('content')
        </main>
        
        @include('layouts._footer')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('script')
</body>

</html>