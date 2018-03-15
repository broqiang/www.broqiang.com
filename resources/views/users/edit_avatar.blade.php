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
                    <h4 class="my-3">上传头像</h4>
                </div>
                <div class="card-body">
                    <img class="rounded mx-auto my-2 img-thumbnail" src="{{ $user->avatar ?: 'https://image.broqiang.com//broqiang/empty-white.png' }}" alt="avatar">
                    <div class="dropdown-divider my-3"></div>
                    <form method="POST" action="{{ route('users.update',$user->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label >请点击选择文件上传头像</label>
                            <input type="file" class="form-control-file" name="avatar">
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