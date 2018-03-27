@extends('admins.app') 

@section('title', '教程列表') 

@section('content')
<div class="container-fluid">
    <div class="card text-muted">
        <div class="card-header bg-white">
            
            <div class="d-flex justify-content-between">
                <div class="p-2 bd-highlight">教程列表</div>
                <div class="p-2 bd-highlight">
                    <a href="{{ route('admins.tutorials.create') }}" class="btn btn-success"><i class="fa fa-plus mr-1"></i> 创建</a>
                </div>
            </div>
        </div>
        @if(isset($tutorials) && count($tutorials))
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">标题</th>
                                <th scope="col">描述</th>
                                <th scope="col">封面</th>
                                <th scope="col">所属分类</th>
                                <th scope="col">排序</th>
                                <th scope="col">文章数量</th>
                                <th scope="col">创建时间</th>
                                <th scope="col">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tutorials as $tutorial)
                                <tr>
                                    <th scope="row">{{ $tutorial->id }}</th>
                                    <td>
                                        <a class="text-info" href="{{ route('tutorials.show', $tutorial->slug) }}" target="_blank">
                                            {{ $tutorial->title }}
                                        </a>
                                    </td>
                                    <td class="text-truncate" style="max-width: 150px;" title="{{ $tutorial->description }}">{{ $tutorial->description }}</td>
                                    <td>
                                        @if($tutorial->title_page)
                                            <a href="{{ $tutorial->title_page }}" target="_blank">
                                                <img src="{{ $tutorial->title_page }}" alt="封面图片" width="32">
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $tutorial->category->name }}</td>
                                    <td title="按照从大到小排序">{{ $tutorial->sort }}</td>
                                    <td>{{ $tutorial->article_counts }}</td>
                                    <td title="{{ $tutorial->created_at }}">{{ $tutorial->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a class="btn btn-dark btn-sm m-1" href="{{ route('admins.tutorials.show', $tutorial->slug) }}">
                                            <i class="fa fa-sign-in"></i> 进入
                                        </a>
                                        <button class="btn btn-secondary btn-sm m-1 js-upload-button" data-id="{{ $tutorial->slug }}">
                                            <i class="fa fa-upload"></i> 上传封面
                                        </button>
                                        
                                        <a class="btn btn-info btn-sm m-1" href="{{ route('admins.tutorials.edit', $tutorial->slug) }}">
                                            <i class="fa fa-edit"></i> 编辑
                                        </a>
                                        <button class="btn btn-danger btn-sm m-1 js-btn-del" data-id="12">
                                            <i class="fa fa-trash-o"></i> 删除
                                            <form class="d-none" action="{{ route('admins.tutorials.destroy', $tutorial->slug) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                {{ $tutorials->links() }}
            </div>
        @else
            <div class="card-body">
                <p class="text-muted">
                    没有任何教程 ～
                </p>
            </div>
        @endif
    </div>
</div>

<div class="modal fade bd-upload-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-label">上传封面图片</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
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
    $('.js-btn-del').on('click',function(){
        var oForm = $(this).children('form');
        swal_delete(function(){
            oForm.submit();
        });
    });

    $('.js-upload-button').on('click', function(){
        var id = $(this).data('id');
        
        var myForm = '\
        <form class="js-modal-form" method="POST" enctype="multipart/form-data" action="{{ asset('backend/tutorials/') }}/'+id+'/upload">\
            <div class="form-group">\
                @csrf\
                <input type="file" class="form-control" id="js-modal-file" name="title_page">\
            </div>\
        </form>';
        
        $('.modal-body').html(myForm);

        $('.bd-upload-modal-sm').modal('show');
    });

    $('.js-modal-save').on('click', function(){
        $('.js-modal-form').ajaxSubmit(function(json){
            if(!json.success) {
                swal({
                    title: "上传失败！",
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
                title: "上传成功！",
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