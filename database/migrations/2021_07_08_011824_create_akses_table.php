<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAksesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('level_user_id');
            $table->foreign('level_user_id')->references('id')->on('level_users');
            $table->unsignedBigInteger('main_menu');
            $table->foreign('main_menu')->references('id')->on('menu');
            $table->unsignedBigInteger('sub_menu');
            $table->foreign('sub_menu')->references('id')->on('menu');

            $table->timestamps();
            $table->datetime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('akses');
    }
}