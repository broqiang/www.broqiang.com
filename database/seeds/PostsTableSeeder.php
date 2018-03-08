<?php

use App\Models\Post;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 所有用户 ID 数组，如：[1,2,3,4]
        $userIds = User::pluck('id')->toArray();

        // 所有分类 ID 数组，如：[1,2,3,4]
        $skillIds = Skill::pluck('id')->toArray();

        // 获取 Faker 实例
        $faker = Faker\Factory::create('zh_CN');

        $posts = factory(Post::class)
            ->times(200)
            ->make()
            ->each(function ($post) use ($userIds, $skillIds, $faker) {
                $post->user_id  = $faker->randomElement($userIds);
                $post->skill_id = $faker->randomElement($skillIds);
            });

        // 写入数据到数据库
        Post::insert($posts->toArray());
    }
}
