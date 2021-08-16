<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->foreign('form_kk_id')->references('id')->on('form_kk')->onDelete('cascade');;
            $table->unsignedBigInteger('form_kk_id')->nullable();

            //opd
         
            $table->foreign('id_pengirim')->references('id')->on('pegawai');
            $table->unsignedBigInteger('id_pengirim');
            $table->foreign('id_penerima')->references('id')->on('pegawai');
            $table->unsignedBigInteger('id_penerima');
            
         
            $table->string('judul', 50)->nullable();
            $table->string('nama_proses', 50)->nullable();
            $table->string('keterangan', 200)->nullable();
            $table->string('tanggal_acc')->nullable();
            $table->string('date_time')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histories');
    }
}