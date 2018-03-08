<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    
    $updated_at = $faker->dateTimeBetween('-5 days');
    // 传参为生成最大时间不超过，创建时间永远比更改时间要早
    $created_at = $faker->dateTimeBetween('-5 days',$updated_at);

    return [
        'content' => $faker->text(128),
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
