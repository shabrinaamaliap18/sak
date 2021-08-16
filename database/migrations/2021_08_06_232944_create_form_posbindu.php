<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormPosbindu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_posbindu', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('form_kk_id')->nullable();
            $table->foreign('form_kk_id')->references('id')->on('form_kk')->onDelete('cascade');
            $table->unsignedBigInteger('kegiatan_id')->nullable();
            $table->foreign('kegiatan_id')->references('id')->on('master_form');



            
            $table->string('nama_lengkap_bindu', 20)->nullable();
            $table->string('nama_bindu', 20)->nullable();
            $table->string('jenis_kelamin_bindu',100)->nullable();
            $table->string('riwayat_ptm_keluarga_bindu', 20)->nullable();
            $table->string('riwayat_ptm_sendiri_bindu', 20)->nullable();
            
            //wawancara reesiko ptm
            $table->string('merokok_bindu', 20)->nullable();
            $table->string('kurang_aktivitas_fisik_bindu', 20)->nullable();
            $table->string('kurang_sayur_buah_bindu', 20)->nullable();
            $table->string('konsumsi_alkohol_bindu', 20)->nullable();

            //status lain
            $table->string('tekanan_darah_bindu', 20)->nullable();
            $table->string('lingkar_perut_bindu', 20)->nullable();
            $table->string('gula_darah_acak_bindu', 20)->nullable();
            $table->string('kolestrol_bindu', 20)->nullable();
            $table->string('foto_posbindu', 20)->nullable();
            
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
        Schema::dropIfExists('form_posbindu');
    }
}