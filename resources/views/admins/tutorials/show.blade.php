@extends('admins.app') 

@section('title', '教程列表') 

@section('css')
    {!! editormd_css() !!}
    <style>
        .swal-text {
            background-color: #FEFAE3;
            padding: 17px;
            border: 1px solid #F0E1A1;
            display: block;
            margin: 22px;
            text-align: left;
            color: #61534e;
        }
    </style>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card text-muted">
                <div class="card-header bg-transparent">
                    <div class="d-flex justify-content-between">
                        <div class="p-2 bd-highlight">
                            <h3><a href="{{ route('admins.tutorials.show', $tutorial->slug) }}" class="text-muted">{{ $tutorial->title }}</a></h3>
                        </div>
                        <div class="p-2 bd-highlight">
                            <a  class="js-add-article" title="添加文章" href="javascript:void(0);" data-url="{{ route('admins.articles.create', $tutorial->slug) }}">
                                <i class="fa fa-plus text-success" ></i>
                            </a>
                        </div>
                    </div>
                </div>
                @if(count($tutorial->articles))
                    <div class="card-body">
                        <nav class="nav flex-column">
                            @foreach($tutorial->articles as $tarticle)
                                <a class="nav-link font-weight-bold text-truncate 
                                    {{ isset($article) && $tarticle->id === $article->id ? 'bg-dark text-light' : 'text-muted' }}" 
                                    href="{{ route('admins.articles.edit', [$tutorial->slug, $tarticle->id]) }}" 
                                    title="{{ $tarticle->title }} -- {{ $tarticle->slug }}">
                                    <i class="fa fa-folder mr-1 text-info"></i>
                                    {{ $tarticle->title }}
                                    <span class="pull-right">{{ $tarticle->sort }}</span>
                                </a>
                                @if(count($tarticle->children_articles))
                                    @foreach($tarticle->children_articles as $children_article)
                                        <a class="3 nav-link font-weight-bold text-truncate {{ isset($article) && $children_article->id === $article->id ? 'bg-dark text-light' : 'text-muted' }}" href="{{ route('admins.articles.edit', [$tutorial->slug, $children_article->id]) }}" title="{{ $children_article->title }} -- {{ $children_article->slug }}">
                                            <i class="fa fa-file-text mr-1 ml-4"></i>
                                            {{ $children_article->title }}
                                            <span class="pull-right">{{ $children_article->sort }}</span>
                                        </a>
                                    @endforeach
                                @endif
                            @endforeach
                        </nav>                        
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-9">
            @isset($article)
                <div class="card text-muted">
                    <div class="card-header bg-transparent">
                        <div class="d-flex justify-content-between">
                            <div class="p-2 bd-highlight">
                                <h4>{{ $article->title }}</h4>
                            </div>
                            <div class="p-2 bd-highlight">
                                <button class="btn btn-success btn-sm js-article-save">
                                    <i class="fa fa-save"></i> 保存
                                </button>
                                <button class="js-add-article btn btn-info btn-sm" title="编辑文章" data-url="{{ route('admins.articles.edit_title', [$tutorial->slug, $article->id]) }}">
                                    <i class="fa fa-edit" ></i> 编辑
                                </button>
                                <button class="js-btn-del btn btn-danger btn-sm" title="删除文章">
                                    <i class="fa fa-trash-o" ></i> 删除
                                    <form class="d-none" action="{{ route('admins.articles.destroy', [$tutorial->slug, $article->id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </button>

                                @if($article->pid == 0)
                                    <button class="js-add-article ml-1 btn btn-success btn-sm" title="添加子文章" data-url="{{ route('admins.articles.create', $tutorial->slug) }}?pid={{ $article->id }}">
                                        <i class="fa fa-plus" ></i> 添加下级文章
                                    </button>
                                @endif
                                
                            </div>
                        </div>
                        
                    </div>
                        <div id="editormd_id">
                            <textarea class="d-none" name="body">{{ old('body', isset($article) ? $article->body : '') }}</textarea>
                        </div>
                </div>
            @else
                <div class="card text-muted">
                    <div class="card-body bg-transparent">
                            {!! $tutorial->description !!}
                            <hr>
                            点击左侧的 <i class="fa fa-plus text-success" ></i> 号按钮添加新的文章，点击文章标题可以编辑文章
                    </div>
                </div>
            @endisset
        </div>
    </div>
</div>

<div class="modal fade bd-article-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-muted">编辑文章</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary js-modal-save">保存</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')

@isset ($article)
<script src="https://cdn.bootcss.com/jquery.form/4.2.2/jquery.form.min.js"></script>
{!! editormd_js($article->body,750) !!}
@endisset

<script type="text/javascript">    
    @isset ($article)
        $('.js-article-save').on('click', function(){
            var _url = "{{ route('admins.articles.update', [$tutorial->slug, $article->id]) }}";

            var formData = {
                body: editormd_id.getMarkdown(),
                _token: "{{ csrf_token() }}",
                _method: "PATCH"
            }

            laravel_ajax(_url, formData);
        });
    @endisset
    

    $('.js-add-article').on('click',function(){
        var _url = $(this).data('url');
        $('.modal-body').load(_url);
        $('.bd-article-modal-sm').modal('show');
    });

    $('.js-modal-save').on('click', function(){
        var formObj = $('.js-modal-form');
        var _url = formObj.prop('action');
        var formData = formObj.serializeArray();

        laravel_ajax(_url, formData);

    });

    $('.js-btn-del').on('click',function(){
        var oForm = $(this).children('form');
        swal_delete(function(){
            oForm.submit();
        });
    });

    function laravel_ajax(_url, formData)
    {
        $.ajax({
            type: 'POST',
            url: _url,
            data: formData,
            dataType: 'json',
            success: function(json){
                swal({
                    title: "保存成功！",
                    text: json.message,
                    icon: "success",
                    buttons: {
                        confirm: '确定',
                    },
                    timer: 2000
                }).then(function(){
                    $('.bd-upload-modal-sm').modal('hide');

                    location.href=json.url;
                });
            },
            // Laravel 会返回 422，所以在这里捕捉错误信息
            error: function(json){
                if(json.status != 200) {
                    var errors = json.responseJSON;
                    var message = '系统内部错误！';

                    if(!!errors) {
                        message = '';
                        $.each(errors.errors,function(key, val){
                            message += val + "\n\n";
                        });

                        swal({
                            title: "保存失败！",
                            text: message,
                            icon: "error",
                            buttons: {
                                cancel: '关闭',
                            },
                            timer: 5000
                        });
                    }
                }
            }
        });
    }
    
</script>

@stop