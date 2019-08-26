<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

/**
 * タイムカプセル情報のダミーデータ生成
 */
$factory->define(App\Models\TimeCapsule::class, function (Faker $faker) {
    return [
        'capsule_name'      => $faker->word(),
        'buried_user_id'    => mt_rand(1, 10),
        'user_name'         => $faker->name,
        'message'           => $faker->paragraph(),
        'longitude'         => mt_rand() / mt_getrandmax() * 180,
        'latitude'          => mt_rand() / mt_getrandmax() * 180,
    ];
});
