<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSatgasPbkmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_satgas_pbkm', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_kk_id')->nullable();
            $table->foreign('form_kk_id')->references('id')->on('form_kk')->onDelete('cascade');
            $table->unsignedBigInteger('kegiatan_id')->nullable();
            $table->foreign('kegiatan_id')->references('id')->on('master_form');


            //identitas
            $table->integer('nik_satgas')->nullable();
            $table->string('nama_lengkap_satgas', 50)->nullable();
            $table->string('jenis_kelamin_satgas')->nullable();
            $table->string('tempat_lahir_satgas', 100)->nullable();
            $table->date('tanggal_lahir_satgas')->nullable();
            $table->integer('telp_satgas')->nullable();
            $table->string('pendidikan_satgas', 100)->nullable();
            $table->string('foto_pbkm', 100)->nullable();
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
        Schema::dropIfExists('form_satgas_pbkm');
    }
}