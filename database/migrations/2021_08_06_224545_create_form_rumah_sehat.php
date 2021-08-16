<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormRumahSehat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_rumah_sehat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_kk_id')->nullable();
            $table->foreign('form_kk_id')->references('id')->on('form_kk')->onDelete('cascade');
            $table->unsignedBigInteger('kegiatan_id')->nullable();
            $table->foreign('kegiatan_id')->references('id')->on('master_form');


            $table->string('nama_kk_rs', 100)->nullable();
            $table->integer('jumlah_kk_rs')->nullable();
            $table->integer('jumlah_jiwa_rs')->nullable();
            $table->string('alamat_rs', 250)->nullable();
            $table->integer('rt_rs')->nullable();
            $table->integer('rw_rs')->nullable();
            $table->string('kecamatan_rs', 100)->nullable();
            $table->string('kelurahan_rs', 100)->nullable();
            $table->string('jendela_rs', 100)->nullable();
            $table->string('ventilasi_rs', 100)->nullable();
            $table->string('pencahayaan_rs', 100)->nullable();
            $table->string('lad_rs', 100)->nullable();
            $table->string('kepadatan_penghuni_rs', 100)->nullable();
            $table->string('khp_rs', 100)->nullable();
            $table->string('kontruksi_rumah_rs', 100)->nullable();
            $table->string('sab_rs', 100)->nullable();
            $table->string('sam_rs', 100)->nullable();
            $table->string('jamban_rs', 100)->nullable();
            $table->string('spal_rs', 100)->nullable();
            $table->string('tempat_sampah_rs', 100)->nullable();
            $table->string('bebas_jentik_rs', 100)->nullable();
            $table->string('bebas_tikus_rs', 100)->nullable();
            $table->string('pembersihan_halaman_rs', 100)->nullable();
            $table->string('pembersihan_tinja_rs', 100)->nullable();
            $table->string('membuang_sampah_rs', 100)->nullable();
            $table->string('foto_rs', 100)->nullable();
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
        Schema::dropIfExists('form_rumah_sehat');
    }
}