# 使用 验证码

## 安装扩展包

```shell
composer require "mews/captcha:~2.0"
```

## 生成配置文件 `config/captcha.php`

```shell
php artisan vendor:publish --provider='Mews\Captcha\CaptchaServiceProvider'
```

## 修改注册页面

`resources/views/auth/register.blade.php`

```html
<div class="form-group row">
    <label for="captcha" class="col-md-4 col-form-label text-md-right">验证码</label>

    <div class="col-md-6">
        <div class="input-group mb-3">
            <input id="captcha" type="text" class="form-control{{ $errors->has('captcha') ? ' is-invalid' : '' }}" name="captcha" required>
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">
                     <img src="{{ captcha_src() }}" onclick="this.src='/captcha?'+Math.random()" title="点击图片重新获取验证码">
                </span>
            </div>
            @if ($errors->has('captcha'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('captcha') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
```

#### 修改配置文件

`config/captcha.php`

这里使用的是默认的 default ，使用哪个样式就去配置哪个即可，也可以添加新的样式

```php
'default'   => [
    'length'    => 5,
    'width'     => 120,
    'height'    => 28,
    'quality'   => 90,
    'bgColor'   => '#e9ecef',
    'fontColors'=> ['#2c3e50', '#c0392b', '#16a085', '#c0392b', '#8e44ad', '#303f9f', '#f57c00', '#795548'],
],
```

## 修改控制器

`app/Http/Controllers/Auth/RegisterController.php`

```php
protected function validator(array $data)
{
    return Validator::make($data, [
        'name'     => 'required|string|max:255',
        'email'    => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'captcha'  => 'required|captcha',
    ]);
}
```

如果配置了 `broqiang/laravel-lang`，按照上面配置即可，如果没有就要自定义消息，如下面

```php
protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'captcha' => 'required|captcha',
    ], [
        'captcha.required' => '验证码不能为空',
        'captcha.captcha' => '请输入正确的验证码',
    ]);
}
```


## 登录添加验证码

方法和注册几乎一样，就不再单独记录

