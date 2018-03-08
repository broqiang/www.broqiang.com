@extends('layouts.app') 

@section('title','编辑 ' . $user->name) 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('users._sidebar')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white text-muted">
                    <h4 class="my-3">基本信息</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update',$user->id) }}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">用户名</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" readonly value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">邮箱</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control-plaintext" readonly value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Github 主页</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="github" value="{{ old('github', $user->github) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">微博主页</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="weibo" value="{{ old('weibo', $user->weibo) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">个人主页</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="homepage" value="{{ old('homepage', $user->homepage) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">个人简介</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" name="introduction">{{ old('introduction', $user->introduction) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success pull-right">
                                    <i class="fa fa-save mr-2"></i>保存
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop