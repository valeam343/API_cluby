<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividadesCategorias', function (Blueprint $table) {
            $table->bigIncrements('pkActividadesCategoria');
            $table->unsignedBigInteger('idActividad');
            $table->unsignedBigInteger('idCategoria');
            $table->foreign('idActividad')->references('pkActividad')->on('actividades');
            $table->foreign('idCategoria')->references('pkCategoria')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividadesCategorias');
    }
}
