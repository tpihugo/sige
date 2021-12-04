<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 250);
            $table->mediumText('descripcion');
            $table->string('formato', 50);
            $table->string('etiqueta', 250);
            $table->string('tipo_material', 250);
            $table->string('duracion',50);
            $table->string('anio_publicacion', 50);
            $table->string('participantes',250);
            $table->string('file',250);
            $table->string('file_preview',250);
            $table->string('inicio',1);
            $table->string('carousel',1);
            $table->string('activo',1);
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
        Schema::dropIfExists('materials');
    }
}
