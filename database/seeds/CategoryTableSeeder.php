<?php

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            [
                'name'        => 'Linux',
                'description' => 'Linux 相关教程',
                'sort'        => 180,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'name'        => 'PHP',
                'description' => 'PHP 相关教程',
                'sort'        => 170,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'name'        => 'Laravel',
                'description' => 'Laravel 相关教程',
                'sort'        => 160,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
        ]);
    }
}
