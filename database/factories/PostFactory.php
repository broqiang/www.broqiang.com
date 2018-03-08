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
