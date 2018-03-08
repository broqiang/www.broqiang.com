# 修改默认配置文件

## 修改 .env 文件

```shell
# 系统相关的配置
APP_NAME="Bro Qiang"
APP_URL=http://www.broqiang.test

# 数据库相关的配置
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=www_broqiang_com
DB_USERNAME=root
DB_PASSWORD=1
```

## 修改 `config/app.php`

```php
<?php
.
.
.

'locale' => 'zh-CN',

'timezone' => 'Asia/ShangHai',

.
.
.
```

## 配置中文语言

因为 Laravel 默认的提示全都是英文的，即可将 `locale` 改成 `zh-CN` 也不会生效，因为还没有对应的中文语言包

```shell
composer require broqiang/laravel-lang "1.0.*"

php artisan lang:publish zh-CN
```

