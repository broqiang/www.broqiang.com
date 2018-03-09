@extends('admins.app') 

@section('title', '技能分类') 

@section('content')
<div class="container-fluid">
    <div class="card text-muted">
        <div class="card-header bg-white">
            
            <div class="d-flex justify-content-between">
                <div class="p-2 bd-highlight">技能分类</div>
                <div class="p-2 bd-highlight">
                    <a href="{{ route('admins.skills.create') }}" class="btn btn-success"><i class="fa fa-plus mr-1"></i> 创建</a>
                </div>
            </div>
        </div>
        @if(isset($skills) && count($skills))
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">技能名称</th>
                                <th scope="col">描述</th>
                                <th scope="col">排序</th>
                                <th scope="col">博客数量</th>
                                <th scope="col">创建时间</th>
                                <th scope="col">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($skills as $skill)
                                <tr>
                                    <th scope="row">{{ $skill->id }}</th>
                                    <td>
                                        <a class="text-info" href="{{ route('admins.skills.show', $skill->id) }}">
                                            {{ $skill->name }}
                                        </a>
                                    </td>
                                    <td class="text-truncate" style="max-width: 150px;" title="{{ $skill->description }}">{{ $skill->description }}</td>
                                    <td title="按照从大到小排序">{{ $skill->sort }}</td>
                                    <td>{{ $skill->post_count }}</td>
                                    <td title="{{ $skill->created_at }}">{{ $skill->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm m-1" href="{{ route('admins.skills.edit', $skill->id) }}">
                                            <i class="fa fa-edit"></i> 编辑
                                        </a>
                                        <button class="btn btn-danger btn-sm m-1 js-btn-del" data-id="12">
                                            <i class="fa fa-trash-o"></i> 删除
                                            <form class="d-none" action="{{ route('admins.skills.destroy', $skill->id) }}" method="POST">
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
                {{ $skills->links() }}
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