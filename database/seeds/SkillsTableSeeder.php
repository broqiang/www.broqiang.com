<?php

use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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
                'sort'        => 100,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'name'        => 'PHP',
                'description' => 'PHP 相关文章',
                'sort'        => 80,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'name'        => 'Laravel',
                'description' => 'Laravel 相关文章',
                'sort'        => 60,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'name'        => '开发工具',
                'description' => '开发工具相关的文章',
                'sort'        => 30,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
        ];
    }
}
