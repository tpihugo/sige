<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enlace_modulos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 50);
            $table->string('enlace', 100);
            $table->string('estilos', 50);
            $table->string('parametro', 50)->nullable();
            $table->tinyInteger('activo')->default(1);
            $table->unsignedBigInteger('modulo_id');
            $table->foreign('modulo_id')->references('id')->on('modulos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enlace_modulos');
    }
};
