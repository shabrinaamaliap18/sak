<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormFasilLingkunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_fasil_lingkungan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_kk_id')->nullable();
            $table->foreign('form_kk_id')->references('id')->on('form_kk')->onDelete('cascade');
            $table->unsignedBigInteger('kegiatan_id')->nullable();
            $table->foreign('kegiatan_id')->references('id')->on('master_form');
            //identitas
            $table->integer('nik_fasil')->nullable();
            $table->string('nama_lengkap_fasil', 50)->nullable();
            $table->string('jenis_kelamin_fasil')->nullable();
            $table->string('tempat_lahir_fasil', 100)->nullable();
            $table->date('tanggal_lahir_fasil')->nullable();
            $table->integer('telp_fasil')->nullable();
            $table->string('pendidikan_fasil', 100)->nullable();
            $table->string('foto_fasil', 100)->nullable();
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
        Schema::dropIfExists('form_fasil_lingkungan');
    }
}