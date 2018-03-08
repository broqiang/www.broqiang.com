# 技能分类

将博客内容按照技能进行分类

## 分类内容

#### 名称

暂时计划有下面内容，后面根据实际情况再添加

- 全部 （不进行分类）

- Linux 服务器相关的全都放这里

- PHP PHP 的基础知识全部放在这里

- Laravel Laravel 相关的全部都放在这里

- 开发工具 开发工具相关的都放在这里

#### 字段

- id 主键

- name 名称

- description 描述

- sort 排序，为了用于随时可以调整列表展示顺序

- created_at

- updated_at

## 创建模型

同时创建 Model 和 数据迁移文件

```shell
php artisan make:model Models/Skill -m
```

编辑 `database/migrations/2018_02_02_162002_create_skills_table.php`

```php
public function up()
{
    Schema::create('skills', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name',64);
        $table->string('description');
        $table->tinyInteger('sort')->default(100);
        $table->timestamps();
    });
}
```

执行 migrate

```shell
php artisan migrate
```

## 数据填充

```shell
php artisan make:seeder SkillsTableSeeder
```

打开 `database/seeds/SkillsTableSeeder.php`

```php
public function run()
{
    Skill::insert($this->prepareData());
}

protected function prepareData()
{
    return [
        [
            'name'        => 'Linux',
            'description' => 'Linux 相关文章',
            'sort'        => 10,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ],
        [
            'name'        => 'PHP',
            'description' => 'PHP 相关文章',
            'sort'        => 20,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ],
        [
            'name'        => '工具',
            'description' => '工具相关的文章',
            'sort'        => 30,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ],
    ];
}
```

