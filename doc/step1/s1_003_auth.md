# 注册与登录

这个利用了 Laravel 自带的 Auth 去实现的

## make:auth 生成内容

#### 用命令行创建 auth 相关的内容

```shell
php artisan make:auth
```

这个时候会生成 路由和模板文件

#### 路由

在 `routes/web.php` 中会生成下面两个路由的配置

```php
Route::get('/', 'PagesController@home')->name('home');

// 下面两个是 make:auth 生成的

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
```

`Auth::routes()` 等价于下面内容，如果觉得看着不方便，可以删除，直接替换成下面内容

```php
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
```

`Route::get('/home', 'HomeController@index')->name('home')` 因为我们已经有了首页，所以可以将其删除

#### 模板文件

会在 `resources/views` 下面生成一个 `auth` 目录和 `layouts` 目录

- `auth` 这个目录下面是和登录注册相关的页面

- `layouts` 这个是页面布局的文件

#### 删除用不到的内容

```shell
# make:auth 生成的主页
rm app/Http/Controllers/HomeController.php
# 
rm resources/views/home.blade.php
rm resources/views/welcome.php
```

## 页面布局

编辑 `resources/views/layouts/app.blade.php`

#### head 部分

```html
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 下面两个是为了 SEO 优化 -->
    <meta name="description" content="Bro Qiang 博客">
    <meta name="author" content="Bro Qiang<broqiang@qq.com>">
   
    <link rel="icon" href="favicon.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
```

#### body 部分

将原本的 body 改成下面内容

```html
<body>
    <div id="app">
        @include('layouts._header')

        <main class="py-4">
            @yield('content')
        </main>
        
        @include('layouts._footer')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
```

#### header 部分

创建文件 `resources/views/layouts/_header.blade.php`

```html
<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a id="logo" class="navbar-brand mr-0 mr-md-2" href="{{ url('/') }}">
            <img src="http://image.broqiang.com//broqiang/logo320.png" class="img-responsive" width="36px" height="36px" alt="logo">
        </a>
        <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li><a class="nav-link" href="">主页</a></li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li>
                    <form class="form-inline my-2 my-lg-0 nav-link">
                        <i class="fa fa-search text-success"></i>
                    </form>
                </li>
                <!-- Authentication Links -->
                @guest
                <li><a class="nav-link" href="{{ route('login') }}">登录</a></li>
                <li><a class="nav-link" href="{{ route('register') }}">注册</a></li>
                @else
                <li class="nav-item dropdown">
                    <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                        <img src="http://image.broqiang.com//broqiang/logo.png" width="22px" height="22px">
                        {{ Auth::user()->name }}
                        <span class="caret">
                        </span>
                    </a>
                    <div aria-labelledby="navbarDropdown" class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            退出
                        </a>
                        <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
```

#### footer 部分

新建 `resources/views/layouts/_footer.blade.php`

```html
<footer class="footer">
    <div class="container"> 
        <i class="fa fa-heart text-danger"></i> 
        <span class="text-light">每日练习，不断精进</span>
    </div>
</footer>
```

#### 调整 css

修改 `resources/assets/sass/app.scss`

```scss
// Variables
@import "variables";

// Bootstrap
@import '~bootstrap/scss/bootstrap';

@import '~font-awesome/scss/font-awesome';

html {
    position: relative;
    min-height: 100%;
}

body {
    /* Margin bottom by footer height */
    margin-bottom: 60px;
    font-family: Hiragino Sans GB, "Hiragino Sans GB", Helvetica, "Microsoft YaHei", Arial,sans-serif;
}

/* Header */

.navbar-laravel {
    border-color: #e7e7e7;
    background-color: #fff;
    box-shadow: 0px 1px 11px 2px rgba(42, 42, 42, 0.1);
    border-top: 2px solid #00b5ad;
    margin-top: 0px;

}
    #logo {
        margin-right: 200px;
    }

/* Footer */

.footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    /* Set the fixed height of the footer here */
    height: 60px;
    line-height: 60px;
    /* Vertically center the text there */
    background-color: #3C4245;
}
```

## 创建静态页面控制器

```shell
php artisan make:controller PagesController
```

修改 `app/Http/Controllers/PagesController.php`

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
}
```

