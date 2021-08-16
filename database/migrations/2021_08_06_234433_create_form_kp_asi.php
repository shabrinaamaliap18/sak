<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormKpAsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_kp_asi', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('form_kk_id')->nullable();
            $table->foreign('form_kk_id')->references('id')->on('form_kk')->onDelete('cascade');
            $table->unsignedBigInteger('kegiatan_id')->nullable();
            $table->foreign('kegiatan_id')->references('id')->on('master_form');

            $table->date('tanggal_kunjungan_kpasi')->default(date("Y-m-d"));
            $table->string('nama_kader_kpasi', 20)->nullable();
            $table->string('nama_kpasi', 20)->nullable();

            //sasaran yg dikunjungi
            $table->integer('usia_kehamilan_kpasi')->nullable();
            $table->integer('usia_bayi_kpasi')->nullable(); //dalam bulan

            //data ibu
            $table->string('nama_ibu_domisili_kpasi', 20)->nullable();
            $table->string('alamat_ibu_domisili_kpasi', 20)->nullable();
            $table->string('alamat_ibu_ktp_kpasi', 20)->nullable();
            $table->integer('nik_ibu_kpasi')->nullable();
            $table->integer('no_hp_kpasi')->nullable();

            //data lain
            $table->string('permasalahan_kunjungan_kpasi', 200)->nullable();
            $table->string('penyuluhan_kunjungan_kpasi', 200)->nullable();
            $table->string('status_rujukan_kpasi', 200)->nullable();
            $table->string('penyebab_dirujuk_kpasi', 200)->nullable();
            $table->string('foto_kpasi', 200)->nullable();


            $table->datetime('deleted_at')->nullable();
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
        Schema::dropIfExists('form_kp_asi');
    }
}