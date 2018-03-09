<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Bro Qiang 后台">
    <meta name="author" content="Bro Qiang<broqiang@qq.com>">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','标题') - 后台</title>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    
    @yield('css')

</head>

<body>
    <div id="app" class="{{ route_class() }}-page">
        @include('admins._admins_header')
    
        <main class="py-4">
            
            @include('common._error')
            @include('common._message')

            @yield('content')
        </main>
        
        @include('layouts._footer')
    </div>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    
    @yield('script')
</body>

</html>