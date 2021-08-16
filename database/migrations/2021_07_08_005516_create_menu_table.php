<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->char('nama_menu', 50);
            $table->enum('level_menu', ['main_menu', 'sub_menu'])->default('sub_menu');
            $table->integer('master_menu')->default(0)->nullable();;
            $table->string('url', 250)->nullable();
            $table->char('icon', 30)->nullable();
            $table->enum('aktif', ['Y', 'N'])->default('Y');
            $table->integer('no_urut');
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
        Schema::dropIfExists('menu');
    }
}