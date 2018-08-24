<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->string('referencia', 50);
            $table->string('codigo', 50);
            $table->text('descripcion');
            $table->integer('id_prestamo')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('id_prestamo')->references('id')->on('prestamos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('materials');
    }

}
