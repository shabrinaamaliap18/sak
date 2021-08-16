<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLihatHonorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lihat_honor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_kader', 100)->notnull();
            $table->string('daftar_kegiatan', 30);
            $table->string('no_rekening', 30);
            $table->string('nominal', 100);
            $table->string('selip_gaji', 100);
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
        Schema::dropIfExists('lihat_honor');
    }
}