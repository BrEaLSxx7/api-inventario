<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AutenticacionTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('autenticacions')->insert([
            'usuario' => 'Robertesgay',
            'contrasena' => Hash::make('siesgay'),
            'token' => str_random(60),
            'id_usuario' => 1
        ]);
    }

}
