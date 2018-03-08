<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
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

        // 所有文章 ID 数组，如：[1,2,3,4]
        $postIds = Post::pluck('id')->toArray();

        $faker = Factory::create('zh_CN');

        $comments = factory(Comment::class)
            ->times(500)
            ->make()
            ->each(function ($comment) use ($userIds, $postIds, $faker) {
                $comment->user_id = $faker->randomElement($userIds);
                $comment->post_id = $faker->randomElement($postIds);
            });

        Comment::insert($comments->toArray());
    }
}
