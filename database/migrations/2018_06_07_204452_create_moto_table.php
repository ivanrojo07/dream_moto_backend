<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moto', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('marca_id')->unsigned();
            // $table->foreign('marca_id')->references('id')->on('marca_moto');
            // $table->integer('modelo_id')->unsigned();
            // $table->foreign('modelo_id')->references('id')->on('modelo_moto');
            // $table->integer('version_id')->unsigned();
            // $table->foreign('version_id')->references('id')->on('version_moto');
            $table->string('marca');
            $table->string('modelo')->nullable();
            $table->string('version')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('anio')->unsigned();
            $table->integer('km')->unsigned()->nullable();
            $table->string('motor')->nullable();

            $table->string('serie')->nullable();
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
        Schema::dropIfExists('moto');
    }
}
