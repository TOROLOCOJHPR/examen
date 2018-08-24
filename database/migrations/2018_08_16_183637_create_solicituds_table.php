<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicituds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('monto');
            $table->string('edad');
            $table->integer('tarjeta');
            $table->double('plazo');
            $table->double('porcentaje');
            $table->integer('id_usuario');
            $table->string('estatus');
            $table->timestamps();
            //table foreign('user_id)->references('id)->on('users);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicituds');
    }
}
