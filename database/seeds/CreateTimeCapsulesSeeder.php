<?php

use Illuminate\Database\Seeder;

/**
 * タイムカプセル情報を作成するシーダー
 *
 * Class CreateTimeCapsulesSeeder
 */
class CreateTimeCapsulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\TimeCapsule::class, 10)->create();
    }
}
