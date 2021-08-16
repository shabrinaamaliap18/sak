<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormPendudukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_penduduk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_kk_id')->nullable();
            $table->foreign('form_kk_id')->references('id')->on('form_kk')->onDelete('cascade');
            $table->integer('nik')->nullable();
            $table->string('nama_lengkap', 50)->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->integer('telp')->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->string('pendidikan', 100)->nullable();
            $table->string('status_kawin')->nullable();
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
        Schema::dropIfExists('form_penduduk');
    }
}