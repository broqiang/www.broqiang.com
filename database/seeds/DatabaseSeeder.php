<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SkillsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(FollowsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(TutorialsTableSeeder::class);
    }
}
