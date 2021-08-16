<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormAccDkrthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_dkrth', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_kk_id')->nullable();
            $table->foreign('form_kk_id')->references('id')->on('form_kk')->onDelete('cascade');

            $table->foreign('id_opd')->references('id')->on('master_opd');
            $table->unsignedBigInteger('id_opd')->default(2);

            $table->foreign('id_opd_dkrth')->references('id')->on('pegawai');
            $table->unsignedBigInteger('id_opd_dkrth')->nullable();

            $table->string('keputusan_dkrth')->nullable();

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
        Schema::dropIfExists('acc_dkrth');
    }
}