<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * タイムカプセル情報テーブル
 *
 * Class CreateTimeCapsulesTable
 */
class CreateTimeCapsulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_capsules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('capsule_name');
            $table->unsignedBigInteger('buried_user_id');
            $table->text('user_name');
            $table->text('message');
            $table->double('longitude');
            $table->double('latitude');
            $table->unsignedBigInteger('dug_user_id')->nullable();
            $table->timestamp('dug_at')->nullable();
            $table->timestamps();

            $table->foreign('buried_user_id')->references('id')->on('users');
            $table->foreign('dug_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_capsules');
    }
}
