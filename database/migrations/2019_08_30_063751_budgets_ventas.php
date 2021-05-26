<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BudgetsVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('budget_vehiculo', function (Blueprint $table) {

            //Clave foranea de modelos
            $table->bigInteger('budget_id')->unsigned();
            $table->foreign('budget_id')
                ->references('id')->on('budgets');

            //Clave foranea de modelos
            $table->bigInteger('vehiculo_id')->unsigned();
            $table->foreign('vehiculo_id')
                ->references('id_vehiculo')->on('vehiculos');


        });





    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
