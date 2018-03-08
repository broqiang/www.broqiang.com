# 个人中心

## 创建新的 Model 目录

按照 个人习惯 ，在 app 下创建一个 Models 的目录，用来保存所有的 Model

Laravel 默认给搞了一个 User.php 的 Model ，但是放在 了 app 的目录下，也给它移动到 新创建的 Models 目录中。

```shell
mkdir app/Models
mv app/User.php app/Models
```

## 配置 默认的 User.php Model

打开 `app/Models/User.php`

将命名空间修改为 

```php
namespace App\Models;
```

将用到 User 的地方批量修改

`Ctrl+Shift+f` 全文搜索替换(这个是 sublime 的快捷方式，其他编辑器自己发挥吧……)

将 `App\Models\User` 替换成 `App\Models\User`

## 配置用户相关的路由

`routes/web.php`

写入 User 的资源路由，暂时 个人中心只会用到这几个，所以指定一下，否则就会包含所有的 RESTful URI 风格的路由了，一会看控制器，就知道包含什么了，因为创建的时候加上了个 -r，按照资源路由方式创建的

```php
Route::resource('users','UsersController',['only'=>['show','update','edit']]);
```


## 创建 UsersController

```shell
php artisan make:controller UsersController -r
```

打开 `app/Http/Controllers/UsersController.php` 

先将多余的方法删除，只保留 `show` `update` `edit`

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    
    public function show(User $user)
    {
        return view('users.show');
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }
}
```

## 创建模板

#### 添加一个个人中心的入口文件

编辑 `resources/views/layouts/_header.blade.php` ，在退出的上面加上一个个人中心

```html
 <a class="dropdown-item" href="{{ route('users.show',Auth::id()) }}">
    <i class="fa fa-user mr-1"></i>
    个人中心
</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
    <i class="fa fa-sign-out mr-1"></i>
    退出
</a>
```

#### 创建 users/show 模板

## 数据迁移

默认的 users 表的字段不能满足需求，可以为 users 表添加新的字段

创建一个 migration 用来给 users 表添加字段，为了统一以后都最好不要去动原始的 migration，这样做最少还能有个记录，知道数据是怎么改变过来的，未来查看也是比较明白的

```shell
php artisan make:migration add_new_field_to_users_table --table=users
```

打开刚刚创建的文件

`database/migrations/2018_02_01_155342_add_new_field_to_users_table.php`

前面的日期时间 `2018_02_01_155342` 根据创建的时候生成的，可能会和这个不一样，按照实际的就行

修改成下面

```php
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('avatar')->default('');
        $table->string('introduction')->default('');
        $table->string('github')->default('')->commont('github 主页');
        $table->string('github_account')->default('');
        $table->string('homepage')->default('')->commont('个人主页链接');
        $table->string('weibo')->default('')->commont('个人主页链接');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('avatar');
        $table->dropColumn('introduction');
        $table->dropColumn('github');
        $table->dropColumn('github_account');
        $table->dropColumn('homepage');
        $table->dropColumn('weibo');
    });
}
```

## 编辑用户模板

```html
<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <form method="POST" action="{{ route('users.update',$user->id) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">用户名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="用户名" name="name" value="{{ old('name', $user->name) }}">
                            {{-- <small id="passwordHelpBlock" class="form-text text-danger">
                                帮助内ring
                            </small> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">邮箱</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" placeholder="邮箱"  name="email" value="{{ old('email', $user->email) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Github 主页</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="github" value="{{ old('github', $user->github) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">微博主页</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="weibo" value="{{ old('weibo', $user->weibo) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">个人简介</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" name="introduction">{{ old('introduction', $user->introduction) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success pull-right">
                                <i class="fa fa-save mr-2"></i>保存
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
```

## 创建更新用户信息时候用的 Request

```shell
php artisan make:request UserRequest
```

打开 `app/Http/Requests/UserRequest.php`

修改

```php
public function authorize()
{
    return false;
}

public function rules()
{
    return [
        'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
        'email' => 'required|email',
        'introduction' => 'max:80',
        'github' => 'max:30',
        'weibo' => 'max:30',
    ];
}

```

## 修改 update 方法

打开 `app/Http/Controllers/UsersController.php`

注意在顶部要 `use App\Http\Requests\UserRequest;`

```php
public function update(UserRequest $request, User $user)
{
    public function update(UserRequest $request, User $user)
    {
        $user->email = $request->get('email') ?: '';
        $user->github = $request->get('github') ?: '';
        $user->weibo = $request->get('weibo') ?: '';
        $user->introduction = $request->get('introduction') ?: '';
        $user->update();
        return redirect()->back()->with('success','个人资料更新成功');
    }
}
```

## 头像上传

#### 配置模板

`resources/views/users/edit_avatar.blade.php`

直接去复制之前的 `edit.blade.php`

将里面的 form 表单部分替换

```html
<div class="col-md-8">
    <div class="card">
        <div class="card-header bg-white text-muted">
            <h5>上传头像</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.update',$user->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label >请选择图片</label>
                    <hr>
                    <input type="file" class="form-control-file" name="avatar">
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success pull-right">
                            <i class="fa fa-save mr-2"></i>保存
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
```

## 创建一个专门用来处理图片上传的工具类

上传图片，并同时处理图片尺寸的剪裁，见图片处理文档

## 控制器处理

`app/Http/Controllers/UsersController.php`

```php
public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
{
    // 判断提交数据表单的 url ，根据不同表单做不同的处理
    switch (basename(parse_url(url()->previous(), PHP_URL_PATH))) {
        case 'edit':
            $user = $this->updateEdit($request, $user);
            break;
        case 'edit_avatar':
            $result = $uploader->save($request->avatar, 'avatar', $user->id);
            if ($result['path']) {
                $user->avatar = $result['path'];
            }
            break;
        case 'edit_password':
            $user->password = bcrypt($request->password);
            break;
    }

    $user->update();

    return redirect()->back()->with('success', '个人资料更新成功');
}
```

## 权限控制

要处理两部分的权限：

- 未登录用户可以访问 edit 和 update 动作

- 登录用户只可以更新自己的个人信息

#### 限制游客的访问

这个时间很简单，Laravel 自带了 auth 中间件，可以直接使用这个就可以实现了

#### 用户只可以更新自己的个人信息

这个可以利用 Laravel 的策略来实现

创建策略

```shell
php artisan make:policy UserPolicy
```

编辑刚刚创建的策略文件

`app/Policies/UserPolicy.php`

```php
public function update(User $currentUser, User $user)
{
    return $currentUser->id === $user->id;
}
```

将 UserPolicy 注册到 AuthServiceProvider 中

编辑 `app/Providers/AuthServiceProvider.php`

```php
protected $policies = [
    'App\Model' => 'App\Policies\ModelPolicy',
    'App\Models\User' => 'App\Policies\UserPolicy',
];
```

在控制器中将策略应用

编辑 `app/Http/Controllers/UsersController.php`

```php
public function edit(User $user)
{
    $this->authorize('update', $user);

    return view('users.edit', compact('user'));
}

public function editAvatar(User $user)
{
    $this->authorize('update', $user);

    return view('users.edit_avatar', compact('user'));
}

public function editPassword(User $user)
{
    $this->authorize('update', $user);

    return view('users.edit_password', compact('user'));
}

public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
{
    $this->authorize('update', $user);
    
    // 判断提交数据表单的 url ，根据不同表单做不同的处理
    $previous = basename(parse_url(url()->previous(), PHP_URL_PATH));
    $message = '个人资料更新成功';
    switch ($previous) {
        case 'edit':
            $user = $this->updateEdit($request, $user);
            $message = '个人资料更新成功';
            break;
        case 'edit_avatar':
            $result = $uploader->save($request->avatar, 'avatar', $user->id, 260);
            if ($result['path']) {
                $user->avatar = $result['path'];
            }
            $message = '头像上传成功';
            break;
        case 'edit_password':
            $user->password = bcrypt($request->password);
            $message = '密码修改成功，新的密码是：' . $request->password . ' ，请将它牢记。';
            break;
    }

    $user->update();

    return redirect()->back()->with('success', $message);
}
```

