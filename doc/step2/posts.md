# 文章功能

## 创建 Model

```shell
php artisan make:model Models/Post -m
```

#### 数据迁移文件

编辑 `database/migrations/2018_02_05_140002_create_posts_table.php`

```php
public function up()
{
    Schema::create('posts', function (Blueprint $table) {
        $table->increments('id');
        $table->string('title')->index();
        $table->text('body');
        $table->integer('user_id')->unsigned()->index();
        $table->integer('skill_id')->unsigned()->index();
        $table->integer('comment_count')->unsigned()->default(0);
        $table->integer('view_count')->unsigned()->default(0);
        $table->integer('order')->unsigned()->default(0);
        $table->string('excerpt');
        $table->string('slug')->default('');
        $table->timestamps();
    });
}
```

#### 编辑 Model

`app/Models/Post.php`

```php
protected $fillable = [
    'title', 'body', 'user_id', 'skill_id', 'excerpt', 'slug',
];
```

#### 假数据填充

使用数据工厂，随便生成几条数据

```shell
php artisan make:factory PostFactory
```

编辑 `database/factories/PostFactory.php`

```php
<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    $sentence = $faker->sentence();

    // 随机取 5 年前到现在的时间
    $updated_at = $faker->dateTimeBetween('-5 years');
    // 传参为生成最大时间不超过，创建时间永远比更改时间要早
    $created_at = $faker->dateTimeBetween('-5 years',$updated_at);

    return [
        'title' => $sentence,
        'body' => $faker->text(5120),
        'excerpt' => $sentence,
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
```

创建数据填充的 PostsTableSeeder

```shell
php artisan make:seeder PostsTableSeeder
```

编辑 `database/seeds/PostsTableSeeder.php`

```php
public function run()
    {
        // 所有用户 ID 数组，如：[1,2,3,4]
        $userIds = User::pluck('id')->toArray();

        // 所有技能分类 ID 数组，如：[1,2,3,4]
        $skillIds = Skill::pluck('id')->toArray();

        // 获取 Faker 实例
        $faker = Faker\Factory::create('zh_CN');

        $posts = factory(Post::class)
            ->times(200) // 插入了 200 篇文章
            ->make()
            ->each(function ($post) use ($userIds, $skillIds, $faker) {
                $post->user_id  = $faker->randomElement($userIds);
                $post->skill_id = $faker->randomElement($skillIds);
            });

        // 写入数据到数据库
        Post::insert($posts->toArray());
    }
```

## 配置 Model 关联

编辑 `app/Models/Post.php`

```php
public function skill()
{
    return $this->belongsTo(Skill::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
```

## 创建路由

编辑 `routes/web.php`

```php
/** 博客路由，前台只提供列表和文章显示，所以暂时只配置这两个方法 */
Route::resource('posts', 'PostsController', ['only' => ['index', 'show']]);
```

## 创建控制器

```shell
php artisan make:controller PostsController
```

编辑 `app/Http/Controllers/PostsController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show');
    }
}

```

## 编辑模板

#### 创建博客文章列表

`resources/views/posts/index.blade.php`

写入


