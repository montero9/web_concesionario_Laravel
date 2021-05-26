<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id');

            //Clave foranea de usuario
            $table->bigInteger('user_id') ->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            //Clave foranea de clientes
            $table->bigInteger('cliente_id') ->unsigned();
            $table->foreign('cliente_id')
                ->references('id_cliente')->on('clientes')
                ->onDelete('cascade');

            $table->bigInteger('precio_total');
            $table->date('fecha_venta')->nullable();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
