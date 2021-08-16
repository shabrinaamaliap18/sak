<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormPelita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_pelita', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('form_kk_id')->nullable();
            $table->foreign('form_kk_id')->references('id')->on('form_kk')->onDelete('cascade');
            $table->unsignedBigInteger('kegiatan_id')->nullable();
            $table->foreign('kegiatan_id')->references('id')->on('master_form');


            $table->string('nama_pelita', 100)->nullable();
            $table->string('nik_pelita', 30)->nullable();
            $table->string('jenis_kelamin_pelita', 20)->nullable();
            $table->date('tanggal_lahir_pelita')->nullable();
            $table->integer('umur_pelita')->nullable();
            $table->integer('bb_lahir_pelita')->nullable();
            $table->integer('pb_lahir_pelita')->nullable();
            $table->integer('bb_pelita')->nullable();
            $table->integer('pb_pelita')->nullable();
            $table->integer('lila_pelita')->nullable();
            $table->string('cara_ukur_pb_pelita', 200)->nullable();
            $table->string('nama_ayah_pelita', 100)->nullable();
            $table->string('nik_ayah_pelita', 100)->nullable();
            $table->string('nama_ibu_pelita', 100)->nullable();
            $table->string('nik_ibu_pelita', 100)->nullable();
            $table->string('alamat_domisili_pelita', 200)->nullable();
            $table->integer('rt_pelita')->nullable();
            $table->integer('rw_pelita')->nullable();
            $table->string('alamat_ktp_pelita', 200)->nullable();
            $table->string('no_hp_ortu_pelita', 20)->nullable();
            $table->string('status_pelita', 20)->nullable();
            $table->string('perkembangan_balita_pelita', 200)->nullable();
            $table->string('foto_pelita', 100)->nullable();
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
        Schema::dropIfExists('form_pelita');
    }
}