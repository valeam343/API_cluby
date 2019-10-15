<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividadesGrupos', function (Blueprint $table) {
            $table->bigIncrements('pkActividadesGrupos');
            $table->unsignedBigInteger('idActividad');
            $table->string('capActividadesGrupos');
            $table->smallInteger('edadMinimaActividadesGrupos');
            $table->smallInteger('edadMaximaActividadesGrupos');
            $table->dateTime('fInicialActividadesGrupos');
            $table->dateTime('fFinalActividadesGrupos');
            $table->string('periodicidadActividadesGrupos');
            $table->string('notasActividadesGrupos');
            $table->float('precioActividadesGrupos',8,2);
            $table->string('politicasCancelacionActividades');
            $table->boolean('esActivo');
            $table->string('creadoPor');
            $table->string('editadoPor');
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
        Schema::dropIfExists('actividadesGrupos');
    }
}
