<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormJumantik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_jumantik', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('form_kk_id')->nullable();
            $table->foreign('form_kk_id')->references('id')->on('form_kk')->onDelete('cascade');
            $table->unsignedBigInteger('kegiatan_id')->nullable();
            $table->foreign('kegiatan_id')->references('id')->on('master_form');

            //pemeriksaan dalam rumah
            $table->string('jentik_bak_km', 20)->nullable();
            $table->string('jentik_dispenser', 20)->nullable();
            $table->string('jentik_gentong', 20)->nullable();
            $table->string('jentik_tampungan_lemari_es', 20)->nullable();
    
            //pemeriksaan luar rumah
            $table->string('jentik_tampungan_pot_bunga', 20)->nullable();
            $table->string('jentik_tampungan_minum_burung', 20)->nullable();
            $table->string('jentik_tampungan_barang_bekas', 20)->nullable();
            $table->string('jentik_tampungan_lubang_pohon', 20)->nullable();

            //Pelaksanaan edukasi Pemberantasan Sarang Nyamuk (PSN) 3M Plus
            $table->string('penyuluhan_psn', 20)->nullable();
            $table->string('pemahaman_3m_plus', 20)->nullable();
            $table->string('foto_jumantik', 20)->nullable();
            
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
        Schema::dropIfExists('form_jumantik');
    }
}