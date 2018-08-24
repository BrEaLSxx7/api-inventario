<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario')->unsigned();
            $table->boolean('estado');
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('prestamos');
    }

}
