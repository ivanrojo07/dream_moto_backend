<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tienda', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->string('nombre_contacto');
            $table->string('puesto_contacto');
            $table->string('correo_contacto');
            $table->string('telefono_contacto');
            $table->string('telefono');
            $table->double('long',20,17)->default(0.00000);
            $table->double('lat',20,17)->default(0.00000);
            $table->string('locacion');
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
        Schema::dropIfExists('tienda');
    }
}
