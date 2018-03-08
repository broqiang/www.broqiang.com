# 安装配置 Carbon 扩展

Carbon 是 PHP 知名的 DateTime 操作扩展，Laravel 将其默认集成到了框架中，所以可以直接使用。

## 本地化设置

Carbon 对象提供的方法，默认情况是英文的，如果要使用中文时间提示，则需要对 Carbon 进行本地化设置。

编辑 `app/Providers/AppServiceProvider.php`

```php
public function boot()
{
    \Carbon\Carbon::setLocale('zh');
}
```

## 在 模板中友好显示时间

编辑 `resources/views/users/show.blade.php`

```html
<h6 class="card-title">
    <span><i class="fa fa-clock-o"></i> 注册于:</span> 
    <span>{{ $user->created_at->diffForHumans() }}</span>
</h6>
<h6 class="card-title">
    <span><i class="fa fa-clock-o"></i> 活跃:</span> 
    <span>{{ $user->updated_at->diffForHumans() }}</span>
</h6>
```

