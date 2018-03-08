# 图片处理

## 创建一个专门用来处理图片上传的工具类

app/Handlers/ImageUploadHandler.php

```php
<?php
namespace App\Handlers;

class ImageUploadHandler
{
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    public function save($file, $folder, $file_prefix)
    {
        // 格式 uploads/image/$folder/2018/02/02/
        $folderName = '/uploads/image/' . $folder . '/' . date('Y/m/d', time());

        // 将 public 目录的绝对路径和 上面定义的路径拼接到一起
        // 格式: /www/www.broqiang.com/public/uploads/image/$folder/2018/02/02/
        $uploadPath = public_path() . $folderName;

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // 拼接文件名
        $filename = $file_prefix . '_' . str_random(20) . '.' . $extension;

        // 如果上传的不是图片将终止操作
        if (!in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // 将图片移动到我们的目标存储路径中
        $file->move($uploadPath, $filename);

        return [
            'path' => config('app.url') . "$folderName/$filename",
        ];
    }
}
```

## 图片剪裁

#### 安装组件

```shell
composer require intervention/image
```

生成配置文件

```shell
php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravel5"
```

#### 修改图片上传类

`app/Handlers/ImageUploadHandler.php`

