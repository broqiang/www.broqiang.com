<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('users.edit',$user->id) }}" class="btn btn-light btn-block {{ active_class(if_route('users.edit')) }}"><i class="fa fa-list-alt mr-1"></i> 基本信息</a>
                <div class="dropdown-divider my-2"></div>
                <a href="{{ route('users.edit_avatar',$user->id) }}" class="btn btn-light btn-block {{ active_class(if_route('users.edit_avatar')) }}"><i class="fa fa-picture-o mr-1"></i> 修改头像</a>
                <div class="dropdown-divider my-2"></div>
                <a href="{{ route('users.edit_password',$user->id) }}" class="btn btn-light btn-block {{ active_class(if_route('users.edit_password')) }}"><i class="fa fa-lock mr-1"></i> 修改密码</a>
            </div>
        </div>
    </div>
</div>