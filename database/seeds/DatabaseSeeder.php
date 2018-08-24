<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(RolsTableSeeder::class);
        $this->call(UsuarioTableSeeder::class);
        $this->call(AutenticacionTableSeeder::class);
    }

}