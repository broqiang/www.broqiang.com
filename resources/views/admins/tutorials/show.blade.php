@extends('admins.app') 

@section('title', '教程列表') 

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card text-muted">
                <div class="card-header bg-transparent">
                    <div class="d-flex justify-content-between">
                        <div class="p-2 bd-highlight"><h3>{{ $tutorial->title }}</h3></div>
                        <div class="p-2 bd-highlight">
                            <a  class="js-add-article" title="添加文章" href="javascript:void(0);" data-url="{{ route('admins.articles.create', $tutorial->alias) }}">
                                <i class="fa fa-plus text-success" ></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card text-muted">
                <div class="card-body bg-transparent">
                    djsakdjlksajlksda
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-article-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-muted">添加新的文章</h5>
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

<script src="https://cdn.bootcss.com/jquery.form/4.2.2/jquery.form.min.js"></script>

<script type="text/javascript">
    $('.js-add-article').on('click',function(){
        var _url = $(this).data('url');
        $('.modal-body').load(_url);
        $('.bd-article-modal-sm').modal('show');
    });

    $('.js-modal-save').on('click', function(){
        $('.js-modal-form').ajaxSubmit(function(json){
            if(!json.success) {
                swal({
                    title: "失败！",
                    text: json.message,
                    icon: "error",
                    buttons: {
                        cancel: '关闭',
                    },
                    timer: 5000
                });
                return false;
            }

            swal({
                title: "成功！",
                text: json.message,
                icon: "success",
                buttons: {
                    confirm: '确定',
                },
                timer: 2000
            }).then(function(){
                $('.bd-upload-modal-sm').modal('hide');

                location.reload();
            });
        });
    });
    
</script>

@stop