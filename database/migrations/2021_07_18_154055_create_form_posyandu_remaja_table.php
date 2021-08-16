<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormPosyanduRemajaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_posyandu_remaja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_kk_id')->nullable();
            $table->foreign('form_kk_id')->references('id')->on('form_kk')->onDelete('cascade');
            $table->unsignedBigInteger('kegiatan_id')->nullable();
            $table->foreign('kegiatan_id')->references('id')->on('master_form');


            //identitas
            $table->integer('nik_remaja')->nullable();
            $table->string('nama_lengkap_remaja', 50)->nullable();
            $table->string('tempat_lahir_remaja', 100)->nullable();
            $table->date('tanggal_lahir_remaja')->nullable();
            $table->integer('umur')->nullable();
            $table->integer('telp_remaja')->nullable();

            //status kesehatan skrng
            $table->string('keluhan_utama', 100)->nullable();
            $table->string('cara_mengatasi', 100)->nullable();
            $table->string('obat_obatan', 100)->nullable();

            //asessmen gizi
            $table->integer('berat_badan')->nullable();
            $table->integer('tinggi_badan')->nullable();
            $table->string('lila', 100)->nullable();
            $table->string('anemia', 100)->nullable();
            $table->string('foto_posyandu', 100)->nullable();
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
        Schema::dropIfExists('form_posyandu_remaja');
    }
}