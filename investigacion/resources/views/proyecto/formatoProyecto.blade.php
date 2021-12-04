<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Proyecto / Impresión de proyecto</title>

    <!-- Styles -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">

<style>
    .pie{
        font-size: 10px;
        text-align: right;
    }
</style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <p class="text-center"><img class="img-responsive" src="images/logo.jpg" width="100%"></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <table class="table table-bordered" style="font-size: 12px;">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" colspan="3"><h3>Formato de Proyecto</h3></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Folio: {{$proyecto->id}}</td>
                        <td>Año: {{$proyecto->anio}}</td>
                        <td>A.1 {{$proyecto->titulo_proyecto}}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered" style="font-size: 12px;">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" colspan="1"><h5>Datos del Responsable</h5></th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td><b>A.1 Nombre del responsable:</b> {{$proyecto->nombre_responsable}}</td></tr>
                    <tr><td><b>A.2 Correo electrónico: </b> {{$proyecto->correo_responsable}}</td></tr>
                    <tr><td><b>A.3 Nombramiento: </b>{{$proyecto->nombramiento}}</td></tr>
                    <tr><td><b>A.4 Cuerpo Académico: </b>{{$proyecto->cuerpo_academico}}</td></tr>
                    <tr><td><b>A.5 Reconocimiento S.N.I: </b> {{$proyecto->reconocimiento_sni}}</td></tr>
                    <tr><td><b>A.6 Reconocimiento PROMEP: </b> {{$proyecto->reconocimiento_promep}}</td></tr>
                    <tr><td><b>A.7 Reconocimiento PROESDE: </b> {{$proyecto->reconocimiento_proesde}}</td></tr>
                    <tr><td><b>A.8 Departamento: </b>{{$proyecto->departamento}}</td></tr>
                    <tr><td><b>A.9 División: </b> {{$proyecto->division}}</td></tr>
                    <tr><td><b>A.10 Registro de proyecto en otras Instituciones</b>{{$proyecto->registro_otras_instituciones}}</td></tr>
                    <tr><td><b>A.10.1 Financiamiento. Institución y monto:</b> {{$proyecto->financiamiento}}</td></tr>
                </tbody>
            </table>
            <table class="table table-bordered" style="font-size: 12px;">
                <thead class="thead-light">
                <tr>
                    <th scope="col" colspan="1"><h5>Registro</h5></th>
                </tr>
                </thead>
                <tbody>
                    <tr><td><b>A.11 Opción de registro: </b>{{$proyecto->tipo_registro}}</td></tr>
                    <tr><td>A.11.1 Monto para pasaje aereo nacional: <b>{{$proyecto->monto_pasaje_aereo_nacional}}</b></td></tr>
                    <tr><td>A.11.2 Monto para pasaje terrestre nacional: <b>{{$proyecto->monto_pasaje_terrestre_nacional}}</b></td></tr>
                    <tr><td>A.11.3 Monto para combustible para vehículo: <b>{{$proyecto->monto_combustible_vehiculo}}</b></td></tr>
                    <tr><td>A.11.4 Monto para viáticos (Hotel y Alimentos): <b>{{$proyecto->monto_viaticos}}</b></td></tr>
                    <tr><td>A.11.5 Monto para materiales: <b>{{$proyecto->monto_materiales}}</b></td></tr>
                    <tr><td>A.11.6 Monto para equipos menores de oficina (Toner, Papelería, Fotocopias): <b>{{$proyecto->monto_equipos_menores_oficina}}</b></td></tr>
                    <tr><td>A.11.7 Monto total: <b>$ {{$proyecto->monto_total}}</b></td></tr>
                    <tr><td><b>A.11.8 Justificación de montos económicos: </b> {{$proyecto->justificacion}}</td></tr>
                </tbody>
            </table>
            <table class="table table-bordered" style="font-size: 12px;">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" colspan="1"><h5>Personal y colaboradores</h5></th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td><b>A.12 Personal académico adscrito al proyecto.: </b> {{$proyecto->personal_adscrito}}</td></tr>
                    <tr><td><b>A.13 Estudiantes colaboradores o asistentes al proyecto: </b>{{$proyecto->estudiantes_adscritos}}</td></tr>
                    <tr><td><b>A.14 Colaboradores o asistentes al proyecto, externos: </b>{{$proyecto->colaboradores_externos}}</td></tr>
                </tbody>
            </table>
            <table class="table table-bordered" style="font-size: 12px;">
                <thead class="thead-light">
                <tr>
                    <th scope="col" colspan="1"><h5>B. RESUMEN DEL PROYECTO</h5></th>
                </tr>
                </thead>
                <tbody>
                    <tr><td><b>B.1 Título del Proyecto: </b> {{$proyecto->titulo_proyecto}}</td></tr>
                    <tr><td><b>B.2 Abstract: </b>{{$proyecto->abstract}}</td></tr>
                    <tr><td><b>B.3 Fecha inicio (mes/año): </b>{{$proyecto->fecha_inicio}}</td></tr>
                    <tr><td><b>B.4 Fecha fin (mes/año): </b>{{$proyecto->fecha_fin}}</td></tr>
                    <tr><td><b>B.5 Tipo de Proyecto: </b>{{$proyecto->tipo_proyecto}}</td></tr>
                    <tr><td><b>B.5.1 Tiempo: </b>{{$proyecto->tiempo_proyecto}}</td></tr>
                    <tr><td><b>B.6 Objetivos: </b> {{$proyecto->objetivos}}</td></tr>
                    <tr><td><b>B.7 Preguntas: </b>{{$proyecto->preguntas}}</td></tr>
                    <tr><td><b>B.8 Hipótesis: </b> {{$proyecto->hipotesis}}</td></tr>
                    <tr><td><b>B.9 Metodología: </b>{{$proyecto->metodologia}}</td></tr>
                    <tr><td><b>B.9.1 Cómo considera el proyecto Generación de Conocimiento o de Incidencia: </b>{{$proyecto->generacion_conocimiento}}</td></tr>
                    <tr><td><b>B.10 Actividades de divulgación previstas: </b> {{$proyecto->actividades_divulgacion}}</td></tr>
                    <tr><td><b>B.11 Actividades de vinculación previstas: </b>{{$proyecto->actividades_vinculacion}}</td></tr>
                    <tr><td><b>B.12 Vinculación con otros investigadores: </b>{{$proyecto->vinculacion_otros_investigadores}}</td></tr>
                    <tr><td><b>B.13 Vinculación con otros grupos de investigación: </b>{{$proyecto->vinculacion_grupos_investigacion}}</td></tr>
                    <tr><td><b>B.14 Vinculación con sectores de la sociedad civil o instituciones gubernamentales: </b>{{$proyecto->vinculacion_sectores}}</td></tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <br>
            <br>

            <p class="pie">Hora y día de Impresión:  {{ date('d-m-Y H:i:s') }}<br>
                Realizado por:  {{ Auth::user()->name }}<br>
                Formato CTA-050. Actualización: 16/junio/2021</p>
        </div>
    </div>
</div>
</body>
</html>
