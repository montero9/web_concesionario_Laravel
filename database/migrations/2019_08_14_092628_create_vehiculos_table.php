<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id_vehiculo');

            //Clave foranea de modelos
            $table->bigInteger('modelo_id') ->unsigned();
            $table->foreign('modelo_id')
                ->references('id_modelo')->on('modelos')
                ->onDelete('cascade');

            //Clave foranea de venta
            $table->bigInteger('venta_id') ->unsigned()->nullable();
            $table->foreign('venta_id')
                ->references('id')->on('ventas')
                ->onDelete('cascade');

            $table->string('matricula');
            $table->bigInteger('caballos');
            $table->integer('puertas');
            $table->string('tipo_cambio');
            $table->string('combustible');
            $table->string('color');
            $table->date('fecha_registro');
            $table->bigInteger('precio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
}
