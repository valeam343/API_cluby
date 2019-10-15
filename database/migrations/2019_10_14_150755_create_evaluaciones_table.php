<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->bigIncrements('pkEvaluacion');
            $table->string('comEvaluacion');
            $table->float('evaluacion',4,2);
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
        Schema::dropIfExists('evaluaciones');
    }
}
