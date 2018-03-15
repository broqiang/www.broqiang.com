@extends('layouts/app')

@section('title',isset($skills) ? $skills->name : '博客列表')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-default text-muted">
                <div class="card-header bg-white">
                    <ul class="nav nav-tabs navbar-dark">
                        <li class="nav-item">
                            <a class="nav-link text-dark {{ active_class(( ! if_query('order', 'reply') )) }}" href="{{ Request::url() }}?order=default">最新发布</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark {{ active_class(( if_query('order', 'reply') )) }}" href="{{ Request::url() }}?order=reply">最后活跃</a>
                        </li>
                    </ul>
                    <div class="input-group my-3">
                        <input type="text" id="posts_search" class="form-control" placeholder="输入要搜索的内容，至少要两个字符" >
                        <div class="input-group-append">
                            <div class="input-group-text text-info bg-white">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('posts._post_list',$posts)
                </div>
                <div class="card-footer bg-white">
                    {{ $posts->appends(request()->all())->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            @include('posts._sidebar')
        </div>
    </div>        
@stop

@section('script')
    {{-- 搜索博客文章 --}}
    @include('posts._search_posts');
@stop