<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_pegawai', 100)->notnull();
            $table->string('NIK', 30);
            $table->string('NIP', 30);
            $table->enum('jabatan', ['kader', 'koordinator', 'opd dinkes', 'opd dp5a', 'opd dkrth', 'pemberi honor', 'admin']);
            $table->string('jenis_kelamin', 20);
            $table->date('tanggal_lahir');
            $table->string('foto_pegawai', 200);
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
        Schema::dropIfExists('pegawai');
    }
}