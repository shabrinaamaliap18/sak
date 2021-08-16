<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormTbc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_tbc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_kk_id')->nullable();
            $table->foreign('form_kk_id')->references('id')->on('form_kk')->onDelete('cascade');
            $table->unsignedBigInteger('kegiatan_id')->nullable();
            $table->foreign('kegiatan_id')->references('id')->on('master_form');


            $table->string('nama_siswa_tbc', 200)->nullable();
            $table->integer('umur_tbc')->nullable();
            $table->string('jenis_kelamin_tbc', 20)->nullable();
            $table->string('alamat_tbc', 200)->nullable();
            $table->string('gejala_tbc', 100)->nullable();
            $table->string('riwayat_kontak_tbc', 20)->nullable();
            $table->string('status_rujukan_tbc', 20)->nullable();
            $table->string('status_fasyankes_rujukan', 20)->nullable();
            $table->string('hasil_pemeriksaan', 20)->nullable();
            $table->string('foto_tbc', 20)->nullable();
    
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
        Schema::dropIfExists('form_tbc');
    }
}