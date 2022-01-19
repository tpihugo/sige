<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('clasificacion',40);
            $table->string('titulo',60);
            $table->string('autor',50);
            $table->integer('anio');
            $table->string('tomo_numero',20);
            $table->string('editorial',25);
            $table->string('lugar_publicacion',50);
            $table->integer('paginas')->default(0);
            $table->string('volumen',15);
            $table->string('serie',40);
            $table->string('isbn_issn',25);
            $table->date('fecha_ingreso');
            $table->string('situacion',25);
            $table->string('space')->default('');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros');
    }
}
