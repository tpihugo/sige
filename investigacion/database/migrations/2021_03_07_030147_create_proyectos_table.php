<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->integer('anio');
            $table->integer('IdUsuario');
            $table->string('titulo_proyecto',200);
            $table->string('cuerpo_academico',250);
            $table->string('tipo_participacion_ca',200);
            $table->string('tipo_proyecto',100);
            $table->string('linea_investigacion',250);
            $table->string('division',250);
            $table->string('departamento',250);
            $table->string('registro_otras_instituciones',50);
            $table->integer('duracion_proyecto_meses');
            $table->string('ultimo_grado_responsable',150);
            $table->string('nombre_responsable',250);
            $table->string('correo_responsable',150);
            $table->string('nombramiento',150);
            $table->string('perfil',150);
            $table->string('ultimas_publicaciones',250);
            $table->mediumText('personal_adscrito');
            $table->mediumText('abstract');
            $table->date('fecha_inicio',150);
            $table->date('fecha_fin',150);
            $table->mediumText('objetivos');
            $table->mediumText('preguntas');
            $table->mediumText('hipotesis');
            $table->mediumText('metodologia');
            $table->mediumText('actividades_vinculacion');
            $table->string('proyecto_extenso', 250);
            $table->string('acta_colegio', 250);
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
        Schema::dropIfExists('proyectos');
    }
}
