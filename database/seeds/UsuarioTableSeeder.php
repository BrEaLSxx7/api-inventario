<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('usuarios')->insert([
            'telefono' => '3113215870',
            'nombre' => 'Sebastian Cano',
            'correo' => 'scano39@gmail.com',
            'id_rol' => 1
        ]);
    }

}
