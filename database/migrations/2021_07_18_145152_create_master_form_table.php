<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_form', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan', 100);
            $table->unsignedBigInteger('opd_id');
            $table->foreign('opd_id')->references('id')->on('master_opd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * 
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_form');
    }
}