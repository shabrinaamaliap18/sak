<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('flow_id');
            $table->foreign('flow_id')->references('id')->on('workflow');
            $table->unsignedBigInteger('schema_sebelum')->nullable();
            $table->foreign('schema_sebelum')->references('id')->on('schema');
            $table->unsignedBigInteger('schema_sesudah')->nullable();
            $table->foreign('schema_sesudah')->references('id')->on('schema');
            $table->integer('urutan')->unsigned();
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
        Schema::dropIfExists('proses');
    }
}
