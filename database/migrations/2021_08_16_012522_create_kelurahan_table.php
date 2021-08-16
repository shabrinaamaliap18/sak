<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelurahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelurahan', function (Blueprint $table) {
            $table->id();

            $table->string('no_kel', 50)->nullable();
            $table->string('nama_kelurahan', 50)->nullable();

            $table->unsignedBigInteger('no_kecamatan');
            $table->foreign('no_kecamatan')->references('id')->on('kecamatan');
           
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelurahan');
    }
}
