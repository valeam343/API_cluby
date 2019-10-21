
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->bigIncrements('pkProveedor');
            $table->string('nomProveedor');
            $table->string('logoProveedor');
            $table->string('aliasProveedor');
            $table->string('rfcProveedor');
            $table->string('calleProveedor');
            $table->string('nextProveedor');
            $table->string('nintProveedor');//type is still debating
            $table->string('colProveedor');
            $table->string('munProveedor');
            $table->string('estadoProveedor');
            $table->string('cpProveedor');
            $table->boolean('esActivo');
            $table->string('emailProveedor');
            $table->string('paisProveedor');
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
        Schema::dropIfExists('proveedores');
    }
}
