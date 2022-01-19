<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacion', function (Blueprint $table) {
            $table->id();
            $table->string('clasificacion',40);
            $table->string('tipo',20);
            $table->string('obtencion',50);
            $table->string('resguardo',50);
            $table->text('contenido');
            $table->string('codigo_barras')->default('0');
            $table->string('inventario',20);
            $table->date('fecha_publicacion')->nullable(True);
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
        Schema::dropIfExists('informacion');
    }
}
