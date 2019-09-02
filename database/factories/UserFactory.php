<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

/**
 * ユーザ情報のダミーデータ生成
 */
$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'user_id'   => $faker->userName,
        'password'  => bcrypt('password'),
    ];
});
