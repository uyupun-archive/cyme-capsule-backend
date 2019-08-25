<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDugTimeCapsulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dug_time_capsules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('capsule_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('dug_at');
            $table->timestamps();

            $table->foreign('capsule_id')->references('id')->on('time_capsules');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dug_time_capsules');
    }
}
