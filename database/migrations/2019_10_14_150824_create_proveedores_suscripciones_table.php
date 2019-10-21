<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresSuscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedoresSuscripciones', function (Blueprint $table) {
            $table->bigIncrements('pkProveedorSuscripcion');
            $table->unsignedBigInteger('idProveedor');
            $table->dateTime('inicioSuscripcion');
            $table->dateTime('finSuscripcion');
            $table->string('creadoPor');
            $table->string('editadoPor');
            $table->timestamp('fechaCreado')->useCurrent();
            $table->timestamp('fechaEditado')->useCurrent();
            $table->foreign('idProveedor')->references('pkProveedor')->on('proveedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedoresSuscripciones');
    }
}
