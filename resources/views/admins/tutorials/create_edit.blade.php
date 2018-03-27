@extends('admins.app') 

@section('title', '创建教程') 

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-white">
            <p class="text-muted">
                @isset($tutorial)
                    编辑教程
                @else
                    创建教程
                @endisset
            </p>
        </div>
        
        <div class="card-body p-4 text-muted">
            <form method="POST" action="{{ isset($tutorial) ? route('admins.tutorials.update', $tutorial->slug) : route('admins.tutorials.store') }}">
                @csrf

                @isset($tutorial)
                    <input type="hidden" name="_method" value="PUT">
                @endisset

                <div class="form-group">
                    <label for="title">教程标题</label>

                    <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', isset($tutorial) ? $tutorial->title : '') }}" required autofocus placeholder="输入标题">

                    @if ($errors->has('title'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="title">slug</label>

                    <input type="text" class="form-control {{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" value="{{ old('slug', isset($tutorial) ? $tutorial->slug : '') }}" required placeholder="输入slug">

                    @if ($errors->has('slug'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('slug') }}</strong>
                        </span>
                    @endif
                    <small class="ml-2">用来访问的路径，默认值是由百度翻译自动生成，只能是 <code>字母、数字、破折号（ - ）以及下划线（ _ ）</code></small>
                </div>

                <div class="form-group">
                    <label for="category_id">分类</label>

                    <select class="form-control {{ $errors->has('category_id') ? ' is-invalid' : '' }}" name="category_id" required>
                        <option value="">请选择</option>
                        @foreach($categoris as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', isset($tutorial) ? $tutorial->category_id : '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('category_id'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                    @endif
                </div>
                        
                <div class="form-group">
                    <label for="description">描述</label>
                    
                    <textarea  class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="5" placeholder="教程的详细信息" required>{{ old('description', isset($tutorial) ? $tutorial->description : '') }}</textarea>
                    <small class="text-info">这个用于列表显示的内容</small>

                    @if ($errors->has('description'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="title">排序</label>

                    <input type="number" class="form-control {{ $errors->has('sort') ? ' is-invalid' : '' }}" name="sort" value="{{ old('sort', isset($tutorial) ? $tutorial->sort : '') }}" placeholder="输入整形数字">

                    @if ($errors->has('sort'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('sort') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="auth1" name="auth" class="custom-control-input" value="0" {{ isset($tutorial) ? ($tutorial->auth ?: 'checked') : 'checked' }}>
                        <label class="custom-control-label" for="auth1">私有（指定权限的用户可以见）</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="auth2" name="auth" class="custom-control-input" value="1" {{ isset($tutorial) ? ($tutorial->auth ? 'checked' : '') : '' }}>
                        <label class="custom-control-label" for="auth2">公开（所有人可见）</label>
                    </div>
                </div>

                <div class="form-group my-3">
                    <button type="submit" class="btn btn-success pull-right">
                        <i class="fa fa-save mr-2"></i>保存
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('script')
<script type="text/javascript">
    $('.js-btn-del').on('click',function(){
        var obj = $(this).children('form');
        swal_delete(function(){
            console.log(obj);
            obj.submit();
        });
    });

</script>
@stop