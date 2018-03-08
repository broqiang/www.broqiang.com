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
                            <a class="nav-link text-dark {{ active_class(( if_query('order', 'reply') )) }}" href="{{ Request::url() }}?order=reply">最后回复</a>
                        </li>
                    </ul>
                    <div class="input-group my-3">
                        <input type="text" class="form-control is-valid" placeholder="搜索功能还没有实现！！！！！" >
                        <div class="input-group-append">
                            <button class="btn btn-outline-success" type="button">
                                <i class="fa fa-search"></i> 搜索
                            </button>
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