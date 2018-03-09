@extends('admins.app') 

@section('css')
    {!! editormd_css() !!}
@stop

@section('title', '编辑评论') 

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-white">
            <p class="text-muted">
                编辑评论              
            </p>
        </div>
        <div class="card-body p-4 text-muted">
            <div class="card-title">
                <h3>{{ $comment->post->title }}</h3>
            </div>
            <hr>
            <form method="POST" action="{{ route('admins.comments.update', $comment->id) }}">

                @csrf
                @isset($comment)
                    <input type="hidden" name="_method" value="PUT">
                @endisset

                <div class="form-group">
                    <label for="content">评论内容</label>
                    
                    <textarea  class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" rows="5" required>{{ old('content', isset($comment) ? $comment->content : '') }}</textarea>

                    @if ($errors->has('content'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('content') }}</strong>
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
@stop