@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron bg-light">
        <h1 class="display-3 text-secondary">
            Hello, Laravel !
        </h1>
        <p class="lead">
            你好，这里是首页，现在正在开始制作，还没有更多的功能
        </p>
        <hr class="my-5">
            <p class="lead">
                点击
                <a class="btn btn-success btn-lg" href="#" role="button">
                    注册
                </a>
                开始 Laravel 之旅
            </p>
        </hr>
    </div>
    {{--
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-default">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <h1>
                        Hello World
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Hello
                    </div>
                </div>
            </div>
        </div>
    </div>
    --}}
</div>
@endsection
