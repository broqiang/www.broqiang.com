# Bro Qiang 博客

## 版本说明

1.1 版本，添加了教程文章的模块，如果只是用最简单的博客功能，请选择 1.0 分支。

## 教程

写了一个用来安装本博客的教程，请参考： [https://broqiang.com/tutorials/blog-manual](https://broqiang.com/tutorials/blog-manual)

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
composer create-project broqiang/laravel-blog broqiang.com "1.1.*" 
```

__方法二 通过 github 直接下载代码__

```bash

git clone -b 1.1 https://github.com/BroQiang/www.broqiang.com.git

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

# 七牛云相关配置，如果图片上传到七牛云的话需要配置这里
QINIU_ACCESS_KEY=
QINIU_SECRET_KEY=
QINIU_BUCKET=
QINIU_DOMAIN=

# 百度翻译用到的配置
BAIDU_TRANSLATE_APPID=
BAIDU_TRANSLATE_KEY=

# 百度统计的 key
BAIDU_TONGJI=ceb4dafbd34d908306d9745fc0e0f4e4
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


