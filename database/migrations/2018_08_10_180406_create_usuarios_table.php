<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('telefono', 25)->unique();
            $table->string('nombre', 100);
            $table->string('correo', 50)->unique();
            $table->integer('id_rol')->unsigned();
            $table->timestamps();

            $table->foreign('id_rol')->references('id')->on('rols')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('usuarios');
    }

}
