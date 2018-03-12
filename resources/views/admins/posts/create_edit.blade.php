@extends('admins.app') 

@section('css')
    {!! editormd_css() !!}
@stop

@section('title', '写文章') 

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-white">
            <p class="text-muted">
                @isset($post)
                    编辑文章
                @else
                    写文章
                @endisset                
            </p>
        </div>
        <div class="card-body p-4 text-muted">
            <form method="POST" action="{{ isset($post) ? route('admins.posts.update', $post->id) : route('admins.posts.store') }}">
                @csrf

                @isset($post)
                    <input type="hidden" name="_method" value="PUT">
                @endisset

                <div class="form-group">
                    <label for="title">文章标题</label>

                    <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', isset($post) ? $post->title : '') }}" required autofocus placeholder="输入标题">

                    @if ($errors->has('title'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="skill_id">所属技能</label>

                    <select class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="skill_id">
                        <option value="">请选择</option>
                        @foreach($skills as $skill)
                            <option value="{{ $skill->id }}" {{ old('skill_id', isset($post) ? $post->skill_id : '') == $skill->id ? 'selected' : '' }}>{{ $skill->name }}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('skill_id'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('skill_id') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="excerpt">简介</label>
                    
                    <textarea  class="form-control {{ $errors->has('excerpt') ? ' is-invalid' : '' }}" name="excerpt" rows="5">{{ old('excerpt', isset($post) ? $post->excerpt : '') }}</textarea>
                    <small class="text-info">这个用于列表显示的内容</small>

                    @if ($errors->has('excerpt'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('excerpt') }}</strong>
                        </span>
                    @endif
                </div>
                        
                <div class="form-group">
                    <label for="body">内容</label>
                    <div id="editormd_id">
                        <textarea class="d-none" name="body" cols="3" placeholder="xxxxxx">{{ old('body', isset($post) ? $post->body : '') }}</textarea>
                    </div>

                    @if ($errors->has('body'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('body') }}</strong>
                        </span>
                    @endif
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

{!! editormd_js(isset($post)) !!}

@stop