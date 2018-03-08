@extends('layouts.app')

@section('title',$user->name . '的个人中心')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('users._show_info')
        </div>
        <div class="col-md-8">
            @include('users._follow_articles')
            @include('users._comments')
        </div>
    </div>
</div>
@stop