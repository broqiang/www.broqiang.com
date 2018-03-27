<?php

use App\Models\Tutorial;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TutorialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tutorial::insert([
            [
                'title'       => 'PHP 基础教程',
                'description' => 'PHP 基础教程',
                'slug' => 'php_base_tutorial',
                'category_id' => 2,
                'sort'        => 180,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'title'       => 'Laravel 基础教程',
                'description' => 'Laravel 基础教程',
                'slug' => 'laravel_base_tutorial',
                'category_id' => 3,
                'sort'        => 170,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
        ]);
    }
}
