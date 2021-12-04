<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->integer('IdProyecto');
            $table->string('propuesta_calificacion', 20);
            $table->string('propuesta_motivos_calificacion', 250);
            $table->string('conocimiento_calificacion', 20);
            $table->string('conocimiento_motivos_calificacion', 250);
            $table->string('problema_calificacion', 20);
            $table->string('problema_motivos_calificacion', 250);
            $table->string('planteamiento_calificacion', 20);
            $table->string('planteamiento_motivos_calificacion', 250);
            $table->string('metodologia_calificacion', 20);
            $table->string('metodologia_motivos_calificacion', 250);
            $table->string('resultados_calificacion', 20);
            $table->string('resultados_motivos_calificacion', 250);
            $table->string('colaboracion_calificacion', 20);
            $table->string('colaboracion_motivos_calificacion', 250);
            $table->string('colaboracion_alumnos_calificacion', 20);
            $table->string('colaboracion_alumnos_motivos_calificacion', 250);
            $table->string('evaluacion', 50);
            $table->mediumText('observaciones');
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
        Schema::dropIfExists('evaluacions');
    }
}
