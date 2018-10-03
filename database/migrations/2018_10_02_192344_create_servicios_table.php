<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('moto_id');
            $table->foreign('moto_id')->references('id')->on('moto');
            $table->string('estado');
            $table->text('comentario')->nullable();
            $table->text('detalle');
            $table->decimal('costo_obra',8,2)->default(0);
            $table->decimal('costo_revision',8,2)->default(0);
            $table->decimal('costo_refaccion',8,2)->default(0);
            $table->decimal('total',8,2)->default(0);
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
        Schema::dropIfExists('servicios');
    }
}
