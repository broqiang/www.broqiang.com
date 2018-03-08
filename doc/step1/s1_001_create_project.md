# Step 1 创建项目

## 创建 git 远程仓库

**可以使用 [gitee](https://gitee.com) 或者 [github](https://github.com)**

> 首选推荐 gitee ，因为是国内的速度比较快，并且可以免费提供私有仓库，个人建议在学习过程中的代码还是放在私有仓库比较好，毕竟代码质量不能保证。

#### 登录码云

访问 [https://gitee.com](https://gitee.com) ，如果没有账号先注册一个账号。


#### 创建一个项目

这里的图片还是上一个项目创建时候使用的图片，过程基本一样，只是把 `https://gitee.com/BroQiang/weibo.git` 换成了 `https://gitee.com/BroQiang/www.broqiang.com.git`

点击右上角的 `+` 号，然后选择 `新建项目`

![create_porject](http://image.broqiang.com/9bbc4b75a8952968b946ff1927b165fd.png)

#### 配置项目

需要注意，不要忘了将 `使用Readme 文件初始化这个项目` 前面的 钩取消，默认是有这个选项的，因为要创建一个完全的空仓库，所以不要初始化。

![配置项目](http://image.broqiang.com/10f5e1633c1caad08f49f6feb2800474.png)

#### 记住仓库地址

完成后会有下面界面，我们记住仓库的地址 [https://gitee.com/BroQiang/weibo.git](https://gitee.com/BroQiang/weibo.git) ,一会提交代码用这个。

![仓库地址](http://image.broqiang.com/ed1ee41c63aff046df98eff78fb7a959.png)


## 创建项目

#### 通过 composer 创建项目

```shell
# 进入到系统的指定目录，如 www，这个根据实际需求去配置，不是必须 www
cd /www
# 通过 composer 创建 Laravel 的 www.broqiang.com 项目
composer create-project laravel/laravel --prefer-dist www.broqiang.com "5.5.*"
```


## 将 www.broqiang.com 项目配置到码云仓库

```shell
# 进入到上面创建的项目的根目录
cd /www/www.broqiang.com

# 修改根目录下的 readme.md 文件，因为默认的是 Laravel 框架的相关说明
echo -e "# Laravel 5.5 开发微博项目练习" > readme.md

# 初始化 git 仓库
git init
git add -A
git commit -m '初始化项目'

# 配置码云远程仓库
git remote add github https://github.com/BroQiang/www.broqiang.com.git
# 将项目推送到仓库，同时在远程仓库创建一个叫 master 的远程分支
git push --set-upstream github master
```

完成上面步骤后，可以刷新 [https://gitee.com/BroQiang/weibo.git](https://gitee.com/BroQiang/weibo.git) ，查看效果，已经将本地的内容提交到了码云仓库了；

## 配置 nginx

我们之前已经将 lnmp 环境配置好了，并且在 vhost 里面已经有了一个示例的配置文件，将其复制一份，并修改里面的两个地方即可。

#### 编辑配置文件

```shell
cd /usr/local/nginx/conf/conf.d/
sudo cp vhost.conf www.broqiang.test.conf
# 用 vim 打开配置文件
sudo vim www.broqiang.test.conf
```

将下面部分

```c
listen       80;
server_name  localhost;
index index.php index.html;
root  /home/bro/test;
```

修改成

```c
listen       80;
server_name  www.broqiang.test;         
index index.php index.html;
root /www/www.broqiang.com/public;    
```

#### 重启 Nginx 服务

```shell
sudo systemctl restart nginx
```

#### 配置 hosts 文件

```shell
sudo vim /etc/hosts

# 在最后写入
127.0.0.1   www.broqiang.test
```

## 浏览器测试效果

在浏览器输入 [http://www.broqiang.test](http://www.broqiang.test) 查看效果，出现下面界面配置成功：

![首页](http://image.broqiang.com/97923e0724d72f28a9bb8f311b3acb38.png)




