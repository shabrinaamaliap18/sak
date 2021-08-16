<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormIbuHamil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_ibu_hamil', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_kk_id')->nullable();
            $table->foreign('form_kk_id')->references('id')->on('form_kk')->onDelete('cascade');
            $table->unsignedBigInteger('kegiatan_id')->nullable();
            $table->foreign('kegiatan_id')->references('id')->on('master_form');

            $table->string('nama_ibu_hamil', 100)->nullable();
            $table->integer('umur_ibu_hamil')->nullable();
            $table->string('nik_ibu_hamil', 30)->nullable();
            $table->string('nama_suami', 100)->nullable();
            $table->string('nik_suami', 30)->nullable();
            $table->string('alamat_ibu_hamil', 200)->nullable();
            $table->string('kondisi_ibu_hamil', 20)->nullable();
            $table->string('kasus_ibu_hamil', 200)->nullable();
            $table->string('keterangan_ibu_hamil', 500)->nullable();
            $table->string('foto_ibu_hamil', 200)->nullable();

            $table->timestamps();
            $table->datetime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_ibu_hamil');
    }
}