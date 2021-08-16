<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormAccDinkesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_dinkes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_kk_id')->nullable();
            $table->foreign('form_kk_id')->references('id')->on('form_kk')->onDelete('cascade');
            $table->foreign('id_opd')->references('id')->on('master_opd');
            $table->unsignedBigInteger('id_opd')->default(1);
            $table->foreign('id_opd_dinkes')->references('id')->on('pegawai');
            $table->unsignedBigInteger('id_opd_dinkes')->nullable();
            $table->string('keputusan_dinkes')->nullable();
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
        Schema::dropIfExists('acc_dinkes');
    }
}