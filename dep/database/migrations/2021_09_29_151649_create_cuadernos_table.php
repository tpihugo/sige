<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuadernosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuadernos', function (Blueprint $table) {
            $table->id();
            $table->string('clasificacion',40);
            $table->string('titulo',100);
            $table->integer('anio');
            $table->string('editorial',50);
            $table->string('lugar_publicacion',50);
            $table->string('volumen',15);
            $table->date('fecha_ingreso');
            $table->string('situacion',15);
            $table->string('autor',50);
            $table->string('tomo_numero',15);
            $table->integer('paginas')->default(0);
            $table->string('serie',40);
            $table->string('isbn_issn',25);
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
        Schema::dropIfExists('cuadernos');
    }
}
