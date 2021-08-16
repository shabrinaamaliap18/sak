<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormAccHonorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_honor', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('form_kk_id')->nullable();
            $table->foreign('form_kk_id')->references('id')->on('form_kk')->onDelete('cascade');

            $table->foreign('id_opd_honor')->references('id')->on('pegawai');
            $table->unsignedBigInteger('id_opd_honor')->nullable();

            $table->string('keputusan_honor')->nullable();

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
        Schema::dropIfExists('acc_honor');
    }
}