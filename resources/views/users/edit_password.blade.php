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
                    <h4 class="my-3">修改密码</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update',$user->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">邮箱</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control-plaintext" readonly value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">新密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">确认密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password_confirmation">
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