<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 所有用户 ID 数组，如：[1,2,3,4]
        $users = User::limit(20)->get();

        // 所有文章 ID 数组，如：[1,2,3,4]
        $posts = Post::orderBy('created_at', 'desc')->limit(200)->get();

        $faker = Faker\Factory::create('zh_CN');

        $follows = [];

        foreach ($posts as $post) {
            foreach ($users as $key => $user) {
                $follows[] = [
                    'user_id'    => $user->id,
                    'post_id'    => $post->id,
                    'created_at' => $faker->dateTimeBetween($post->created_at),
                ];
            }
        }

        DB::table('follows')->insert($follows);
    }
}
