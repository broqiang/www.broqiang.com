@extends('admins.app') 

@section('title', '评论管理') 

@section('content')
<div class="container-fluid">
    <div class="card text-muted">
        <div class="card-header bg-white">
            
            <div class="d-flex justify-content-between">
                <div class="p-2 bd-highlight">评论管理</div>
            </div>
        </div>
        @if(isset($comments) && count($comments))
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">评论内容</th>
                                <th scope="col">所属文章</th>
                                <th scope="col">评论用户</th>
                                <th scope="col">评论时间</th>
                                <th scope="col">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <th scope="row">{{ $comment->id }}</th>
                                    <td class="text-truncate" style="max-width: 150px;" title="{{ $comment->content }}">{{ $comment->content }}</td>
                                    <td class="text-truncate" style="max-width: 150px;" title="{{ $comment->post->title }}">
                                        <a class="text-info" href="{{ route('posts.show', $comment->post->id) }}" target="_blank">
                                            {{ $comment->post->title }}
                                        </a>
                                    </td>
                                    <td>
                                        <i class="fa fa-user mr-1 text-info"></i>
                                        <a class="text-info" href="{{ route('users.show', $comment->user->id) }}">
                                            {{ $comment->user->name }}
                                        </a>
                                    </td>
                                    <td title="{{ $comment->created_at }}">{{ $comment->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm m-1" href="{{ route('admins.comments.edit', $comment->id) }}">
                                            <i class="fa fa-edit"></i> 编辑
                                        </a>
                                        <button class="btn btn-danger btn-sm m-1 js-btn-del" data-id="12">
                                            <i class="fa fa-trash-o"></i> 删除
                                            <form class="d-none" action="{{ route('admins.comments.destroy', $comment->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                1111
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
                {{ $comments->links() }}
            </div>
        @else
            <div class="card-body">
                <p class="text-muted">
                    没有任何分类 ～
                </p>
            </div>
        @endif
    </div>
</div>
@stop

@section('script')
<script type="text/javascript">
    $('.js-btn-del').on('click',function(){
        var oForm = $(this).children('form');
        swal_delete(function(){
            oForm.submit();
        });
    });
</script>
@stop