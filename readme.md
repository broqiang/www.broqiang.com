# Bro Qiang 博客

Laravel 5.6 开发的单人博客，1.0 版本完成。

此版本框架是用的 Laravel 5.6，前端使用的是 Bootstrap 4.0，基本全部由 PHP 实现，除了 插件自带的特效，只用了极少的 js，定位是简单，快速完成功能。

后续基本不会再对此分支进行修改，也不会向主分支中合并代码，新功能添加到 1.1 版本中。

## 预览效果

#### 首页

![](https://image.broqiang.com/M837cv6tPs5nJFVLYxXAL59rGfdhb4.png)

#### 文章详情

![](https://image.broqiang.com/6zgPZtG9InNcUckkrcdwlgHdZqXAXZ.png)

#### 后台

![](https://image.broqiang.com/cNQ7ofMc7dT3l7VtQFfyFYA53C4ukF.png)

## 环境

此项目是在 LNMP 环境下开发的，理论上也支持 LAMP 没有实际测试过

- 操作系统 - CentOS 7.4

- Tengine/2.2.1 (nginx/1.8.1) 这个和 Nginx 几乎相同，是个 淘宝二次开发的 Nginx

- Mysql 5.7.21 

- PHP 7.1.15 


## 安装

#### 创建安装目录

创建一个项目保存目录，如果已经存在可以忽略此部

```bash
# 选择安装目录，比如我的是 /www 目录
sudo mkdir /www
cd /www
```

#### 获取项目

__方法一 直接通过 composer 安装__

> 注意：
> 
> - 此方法需要已经配置好了 composer
> 
> - 此方法安装无法更新，有新的版本只能重新安装

```bash
composer create-project broqiang/laravel-blog broqiang.com "1.0.*"
```

__方法二 通过 github 直接下载代码__

```bash
git clone -b 1.0 https://github.com/BroQiang/www.broqiang.com.git

```

#### 安装依赖关系

```
cd broqiang.com
composer install
```

#### 配置目录权限

```bash

sudo chmod -R 777 storage
sudo chmod -R 777 public/uploads
```

#### 配置配置文件

```bash
# 复制配置文件
cp .env.example .env

# 修改配置文件

APP_NAME= # 修改成自己的项目名称
APP_URL=  # 换成自己网站的 URL，注意这个一定要换，本地上传图片和重置密码需要用到

# 数据库配置
DB_HOST=127.0.0.1   # Mysql 的连接地址，本地的数据库一般就是 127.0.0.1
DB_PORT=3306        # Mysql 端口，一般默认是 3306
DB_DATABASE=www_broqiang_com # 数据库的名称，根据创建的 database 来配置
DB_USERNAME=root    # 数据库连接的名称
DB_PASSWORD=1       # 数据库连接的密码
DB_PREFIX=bro_      # 数据库表前缀，为空的话是没有前缀

# 邮箱配置，如果需要重置密码，要配置此项
MAIL_DRIVER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_NAME=

# 配置用户信息，这个是通过 seed 生成管理员的时候用的
# 配置管理员用户
ADMIN_USER_NAME=
# 配置管理员邮箱
ADMIN_USER_EMAIL=
```

## 初始化数据

__生成 key__

```bash
php artisan key:generate
```

__创建数据库表__

可以根据个人喜好去创建

```sql
# 登录 Mysql 数据库
mysql -uroot -p

# 创建 database
create database www_broqiang_com;

# 创建用户
create user www@'127.0.0.1' identified by 'password';

# 给 database 授予权限
grant all on www_broqiang_com.* to www@'127.0.0.1'; 
```

__初始化数据库__

```bash
php artisan migrate

# 生成管理员用户，用户名和邮箱是 .env 中配置的，如果不配置的话默认是 BroQiang broqiang@qq.com
# 只有管理员才可以操作后台
php artisan db:seed --class=UsersTableSeeder
```

__如果需要初始化测试数据执行下面命令__

如果不需要测试数据就不要执行下面的步骤了，因为会有不少垃圾数据的

```bash
php artisan migrate --seed
```

> 暂时没有开发修改管理员的功能，默认db:seed 安装的用户就是管理员，需要手动连接到数据库，将 users 表中的 is_admin 改为 1 才可以看到后台

## 配置 Nginx

根据实际的情况配置，这里只记录配置的 server ，一个基础的配置

```nginx
server {
    listen       80; # 端口,一般http的是80
    server_name  blog.broqiang.com; # 一般是域名,本机就是localhost
    index index.php index.html;  # 默认可以访问的页面,按照写入的先后顺序去寻找
    root  /www/web/www.broqiang.com/public; # 项目根目录

    # Laravel 的 url 重写
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # 下面是所有关于 PHP 的请求都转给 php-fpm 去处理
    location ~ \.php {
        fastcgi_pass    127.0.0.1:9000;
        fastcgi_split_path_info ^(.+\.php)(.*)$;
        fastcgi_param PATH_INFO $fastcgi_path_info;
        fastcgi_param PATH_TRANSLATED $document_root$fastcgi_path_info;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include         fastcgi_params;
    }

    fastcgi_intercept_errors on;
    access_log off;
}
```

__重启 Nginx 服务__

```bash
sudo systemctl restart nginx
```


