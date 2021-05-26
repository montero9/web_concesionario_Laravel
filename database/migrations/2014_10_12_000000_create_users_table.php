<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->rememberToken();
            $table->timestamps();
        });

        //Usuario administrador
        DB::table('users')->insert([
            'name'=>'Antonio Montero',
            'email'=>'serviauto.spain@gmail.com',
            'password'=>bcrypt('Prueba_1989'),
            'role'=>'admin',
        ]);

        //Usuario normal
        DB::table('users')->insert([
            'name'=>'Maite Ramirez',
            'email'=>'maite.serviauto@gmail.com',
            'password'=>bcrypt('Servi_1990'),
            'role'=>'user',
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
