<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuidades', function (Blueprint $table) {
            $table->bigIncrements('pkCiudad');
            $table->string('nomCiudad');
            $table->string('creadoPor');
            $table->string('editadoPor');
            $table->timestamp('fechaCreado')->useCurrent();
            $table->timestamp('fechaEditado')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuidades');
    }
}
