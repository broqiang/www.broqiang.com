@extends('admins.app') 

@section('title', '用户列表') 

@section('content')
<div class="container-fluid">
    <div class="card text-muted">
        <div class="card-header bg-white">
            
            <div class="d-flex justify-content-between">
                <div class="p-2 bd-highlight">用户列表</div>
            </div>
        </div>
        @if(isset($users) && count($users))
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">姓名</th>
                                <th scope="col">邮箱</th>
                                <th scope="col">头像</th>
                                <th scope="col">关注</th>
                                <th scope="col">评论</th>
                                <th scope="col">发布时间</th>
                                <th scope="col">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td class="text-truncate" style="max-width: 150px;" title="{{ $user->name }}">
                                        <a class="text-info" href="{{ route('users.show', $user->id) }}" target="_blank">
                                            {{ $user->name }}
                                        </a>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td><img src="{{ $user->avatar }}" alt="头像" width="32"></td>
                                    <td>{{ $user->followsAll->count() }}</td>
                                    <td>{{ $user->comments->count() }}</td>
                                    <td title="{{ $user->created_at }}">{{ $user->created_at->diffForHumans() }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm m-1 js-btn-del" data-id="12">
                                            <i class="fa fa-trash-o"></i> 删除
                                            <form class="d-none" action="{{ route('admins.users.destroy', $user->id) }}" method="POST">
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
                {{ $users->links() }}
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