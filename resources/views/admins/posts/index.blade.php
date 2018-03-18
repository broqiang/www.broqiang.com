@extends('admins.app') 

@section('title', '博客列表') 

@section('content')
<div class="container-fluid">
    <div class="card text-muted">
        <div class="card-header bg-white">
            
            <div class="d-flex justify-content-between">
                <div class="p-2 bd-highlight">博客列表</div>
                <div class="p-2 bd-highlight">
                    <a href="{{ route('admins.posts.create') }}" class="btn btn-success"><i class="fa fa-plus mr-1"></i> 写文章</a>
                </div>
            </div>
        </div>
        @if(isset($posts) && count($posts))
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">标题</th>
                                <th scope="col">作者</th>
                                <th scope="col">所属技能</th>
                                <th scope="col">评论</th>
                                <th scope="col">关注</th>
                                <th scope="col">PV</th>
                                <th scope="col">发布时间</th>
                                <th scope="col">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <th scope="row">{{ $post->id }}</th>
                                    <td class="text-truncate" style="max-width: 150px;" title="{{ $post->title }}">
                                        <a class="text-info" href="{{ route('posts.show', $post->id) }}" target="_blank">
                                            {{ $post->title }}
                                        </a>
                                    </td>
                                    <td>
                                        <i class="fa fa-user mr-1 text-info"></i>
                                        <a class="text-info" href="{{ route('users.show', $post->user->id) }}">
                                            {{ $post->user->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-info" href="{{ route('admins.skills.show', $post->skill->id) }}">
                                            {{ $post->skill->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-info" href="{{ route('admins.comments.index') }}?post_id={{ $post->id }}">
                                            {{ $post->comment_count }}
                                        </a>
                                    </td>
                                    <td>{{ $post->follow_count }}</td>
                                    <td>{{ $post->visitCounts() }}</td>
                                    <td title="{{ $post->created_at }}">{{ $post->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm m-1" href="{{ route('admins.posts.edit', $post->id) }}">
                                            <i class="fa fa-edit"></i> 编辑
                                        </a>
                                        <button class="btn btn-danger btn-sm m-1 js-btn-del" data-id="12">
                                            <i class="fa fa-trash-o"></i> 删除
                                            <form class="d-none" action="{{ route('admins.posts.destroy', $post->id) }}" method="POST">
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
                {{ $posts->links() }}
            </div>
        @else
            <div class="card-body">
                <p class="text-muted">
                    没有任何文章 ～
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