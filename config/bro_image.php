<?php

return [
    // 允许的后缀名
    'allowed_ext'      => ["png", "jpg", "gif", 'jpeg'],
    // 上传图片的根目录
    'root_folder'      => '/uploads/image',
    // 上传图片的目录
    'folder'           => 'default',
    // 时间格式 =>
    'date_format'      => 'Y/m/d',
    // 文件前缀
    'file_prefix'      => '',
    // 返回的路径是否需要有 url
    'is_url'           => true,
    // 返回的 url 地址，如：http://www.broqiang.test，如果没有配置返回的是 app.php 中的 app.url
    'url'              => '',

    // 生成随机文件名的长度
    'random_length'    => 30,

    // 允许上传图片的最大值
    'max_size'         => 2048,

    // 上传类型： local-本地，qiniu-七牛云
    'upload_type'      => 'qiniu',

    // 七牛云相关的配置
    // 七牛的 access key 和 secret key 可以到个人中心的密钥管理中获得
    'qiniu_access_key' => env('QINIU_ACCESS_KEY'),
    'qiniu_secret_key' => env('QINIU_SECRET_KEY'),
    // bucket 就是对象存储的存储空间的名称
    'qiniu_bucket'     => env('QINIU_BUCKET'),
    // 这里是七牛的 CDN 融合加速域名，可以在存储空间中找到，如我的就是 http://image.broqiang.com，也是返回的图片地址的 url
    'qiniu_domain'     => env('QINIU_DOMAIN'),
];
