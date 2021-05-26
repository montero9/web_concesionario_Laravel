<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Limpiamos la tabla
        DB::table('users')->truncate();

        //Usuarios administradores
        DB::table('users')->insert([
            'name'=>'Antonio Montero',
            'email'=>'serviauto.spain@gmail.com',
            'password'=>bcrypt('Prueba_1989'),
            'role'=>'admin',
        ]);

        DB::table('users')->insert([
            'name'=>'Paco Huelva',
            'email'=>'huelva.spain@gmail.com',
            'password'=>bcrypt('Prueba_1989'),
            'role'=>'admin',
        ]);


        //Usuarios normales
        DB::table('users')->insert([
            'name'=>'Maite Ramirez',
            'email'=>'maite.serviauto@gmail.com',
            'password'=>bcrypt('Servi_1990'),
            'role'=>'user',
        ]);

        DB::table('users')->insert([
            'name'=>'Paco Gomez',
            'email'=>'gomez.serviauto@gmail.com',
            'password'=>bcrypt('Prueba_1989'),
            'role'=>'user',
        ]);

        DB::table('users')->insert([
            'name'=>'Ana Ramirez',
            'email'=>'ramirez.serviauto@gmail.com',
            'password'=>bcrypt('Prueba_1989'),
            'role'=>'user',
        ]);

        DB::table('users')->insert([
            'name'=>'Miguel Montero',
            'email'=>'montero.serviauto@gmail.com',
            'password'=>bcrypt('Prueba_1989'),
            'role'=>'user',
        ]);

        DB::table('users')->insert([
            'name'=>'Isabel Ayende',
            'email'=>'ayende.serviauto@gmail.com',
            'password'=>bcrypt('Prueba_1989'),
            'role'=>'user',
        ]);

    }
}
