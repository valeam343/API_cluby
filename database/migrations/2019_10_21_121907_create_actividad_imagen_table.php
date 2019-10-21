<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadImagenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividadImagen', function (Blueprint $table) {
            $table->bigIncrements('pkActividadImagen');
            $table->unsignedBigInteger('idActividad');
            $table->string('rutaImagen');
            $table->timestamp('fechaCreado')->useCurrent();
            $table->timestamp('fechaEditado')->useCurrent();
            $table->foreign('idActividad')->references('pkActividad')->on('actividades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividadImagen');
    }
}
