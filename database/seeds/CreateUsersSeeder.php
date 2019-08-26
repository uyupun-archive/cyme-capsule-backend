<?php

use Illuminate\Database\Seeder;

/**
 * ユーザ情報を作成するシーダー
 *
 * Class CreateUsersSeeder
 */
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 10)->create();
    }
}
