<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoordenateRouteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordenate_route', function (Blueprint $table) {
            $table->increments('id');
            $table->double('long',20,17);
            $table->double('lat',20,17);
            $table->integer('route_id')->unsigned();
            $table->foreign('route_id')->references('id')->on('route_user');
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
        Schema::dropIfExists('coordenate_route');
    }
}
