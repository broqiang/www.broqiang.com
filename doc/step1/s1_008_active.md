# 模板选中状态

这个通过 `hieu-le/active` 组件来实现，也可以自己手动判断 url，这个方式比较优雅，所以就使用这种方式了

## 安装

```shell
composer require "hieu-le/active:~3.5"
```

## 在模板中修改

编辑 `resources/views/users/_sidebar.blade.php`

```html
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
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
```
