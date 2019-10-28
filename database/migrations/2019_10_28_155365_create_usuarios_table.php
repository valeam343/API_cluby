<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('pkUsuario');
            $table->string('nomUsuario');
            $table->string('correoUsuario')->unique();
            $table->smallInteger('correoVerificado')->default(0);
            $table->string('codigoVerificacion')->nullable();
            $table->string('pwdUsuario');
            $table->string('tipo', 50);
            $table->rememberToken();
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
        Schema::dropIfExists('usuarios');
    }
}
