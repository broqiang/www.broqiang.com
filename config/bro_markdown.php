<?php

return [

    /**
     * markdown 预览相关的配置
     */

    // 预览时的 css
    'markdown_preview_css' => [
        'vendor/markdown.show/css/markdown.css',
    ],

    // 预览时的 js
    'markdown_preview_js'  => [
        'highlight' => 'https://cdn.bootcss.com/highlight.js/9.12.0/highlight.min.js',
        // 'line_numbers' => 'https://cdn.bootcss.com/highlightjs-line-numbers.js/2.2.0/highlightjs-line-numbers.min.js',
    ],

     // 预览是否显示行号, 如果启用，一定要加载上面的 highlightjs-line-numbers.min.js
    'markdown_preview_line_number' => false,

    /**
     * 下面是富文本编辑器 editor.md 相关的配置
     */

    // markdown 富文本编辑器的 css 路径
    'editormd_css'         => [
        'vendor/editormd/css/editormd.css',
        'vendor/markdown.show/css/markdown.css',
    ],

    // markdown 富文本编辑器的 js 路径
    'editormd_js'          => [
        'vendor/editormd/js/editormd.js',
    ],

    // 上传文件目录，根目录由依赖的 broqiang/laravel-image  的配置文件决定，这里是二级目录
    // 更多的 上传部分去配置 broqiang/laravel-image 的配置文件
    'upload_path'          => 'editormd',

    'image_prefix'         => '', // 上传图片的前缀

    'imageMaxWidth'        => 800, // 上传图片的最大高度

    // 文本编辑器的配置，可以直接多个，一个数据是一个，模本中的 id 就是 这里的key，如 editormd_id1
    'editormds'            => [
        'editormd_id' => [
            'id'             => 'editormd_id', // 模板中使用的 id，这里要求和 key 相同
            'width'          => '100%', // 编辑器宽度
            'height'         => 500, // 编辑器高度
            'theme'          => 'default', // 主题，可以用的：白色-default，黑色-dark
            'path'           => '/vendor/editormd/lib/', // 插件保存位置
            'toolbarIcons'   => [
                "undo", "redo", "|",
                "bold", "del", "italic", "quote", "|",
                "h1", "h2", "h3", "h4", "h5", "h6", "|",
                "list-ul", "list-ol", "hr", "|",
                "link", "image", "code", "code-block", "table", "html-entities", "||",
                "watch", "preview", "fullscreen", "clear", "search", "|",
                "help",
            ], // 工具栏按钮
            'autoHeight'     => 'true', // 自动高度
            'imageUpload'    => 'true', // 是否可以上传图片
            'imageFormats'   => ['jpg', 'jpeg', 'gif', 'png'], // 允许上传的图片类型
            'imageUploadURL' => 'bro.emditormd.upload', // 上传图片的路由，使用的是 name() 中的内容
        ],
    ],
];
