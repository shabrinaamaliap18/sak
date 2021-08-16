<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormKkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_kk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id')->nullable();
            $table->foreign('pegawai_id')->references('id')->on('pegawai');
            $table->string('kecamatan', 100)->nullable();
            $table->string('kelurahan', 100)->nullable();
            $table->integer('rt')->nullable();
            $table->integer('rw')->nullable();
            $table->integer('no_kk')->nullable();
            $table->string('alamat_lengkap', 250)->nullable();
            $table->string('nama_kepala_kk', 100)->nullable();
            $table->integer('jumlah_anggota')->nullable();
            $table->enum('status_rumah', ['milik_sendiri', 'sewa'])->nullable();
            $table->enum('status_penduduk', ['permanen', 'non_permanen'])->nullable();
            $table->string('alamat_asal')->nullable();
            $table->date('tanggal_kedatangan')->nullable();
            $table->string('status')->nullable();
            $table->string('keterangan')->nullable();
            $table->boolean('acc_din')->nullable();
            $table->boolean('acc_dp')->nullable();
            $table->boolean('acc_dk')->nullable();
            $table->date('tanggal_input')->default(date("Y-m-d"));
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
        Schema::dropIfExists('form_kk');
    }
}