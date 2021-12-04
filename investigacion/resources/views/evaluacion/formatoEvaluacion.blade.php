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
        <div class="col-md-12 col-xs-12" >
            <table class="table table-bordered" style="font-size: 12px;">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" colspan="3"><h3>Formato de Evaluación</h3></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b>Folio:</b> {{$proyecto->id}}</td>
                        <td><b>Responsable:</b> {{$proyecto->nombre_responsable}}</td>
                        <td><b>Título del proyecto:</b> {{$proyecto->titulo_proyecto}}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered" style="font-size: 12px;">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" colspan="1"><h5>Datos de la evaluación</h5></th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td><b>1- La propuesta, ¿presenta el estudio un problema novedoso y relevante?</b></td></tr>
                    <tr><td>Calificación: {{$evaluacion->propuesta_calificacion}}</td></tr>
                    <tr><td>Motivos: {{$evaluacion->propuesta_motivos_calificacion}}</td></tr>

                    <tr><td><b>2- ¿Se denota un conocimiento amplio sobre los  antecedentes de la problemática planteada?</b></td></tr>
                    <tr><td>Calificación: {{$evaluacion->conocimiento_calificacion}}</td></tr>
                    <tr><td>Motivos: {{$evaluacion->conocimiento_motivos_calificacion}}</td></tr>

                    <tr><td><b>3- ¿Se  expone con claridad el problema de estudio, de tal manera que  los objetivos,
                                pregunta e hipóteiss se abordan de forma clara?</b></td></tr>
                    <tr><td>Calificación: {{$evaluacion->problema_calificacion}}</td></tr>
                    <tr><td>Motivos: {{$evaluacion->problema_motivos_calificacion}}</td></tr>

                    <tr><td><b>4- ¿Existe un planteamiento teórico consistente?</b></td></tr>
                    <tr><td>Calificación: {{$evaluacion->planteamiento_calificacion}}</td></tr>
                    <tr><td>Motivos: {{$evaluacion->planteamiento_motivos_calificacion}}</td></tr>

                    <tr><td><b>5- ¿Es clara la exposición de la  metodología?</b></td></tr>
                    <tr><td>Calificación: {{$evaluacion->metodologia_calificacion}}</td></tr>
                    <tr><td>Motivos: {{$evaluacion->metodologia_motivos_calificacion}}</td></tr>

                    <tr><td><b>6- ¿En el proyecto se presentan aportes en su campo de conocimiento?</b></td></tr>
                    <tr><td>Calificación: {{$evaluacion->resultados_calificacion}}</td></tr>
                    <tr><td>Motivos: {{$evaluacion->resultados_motivos_calificacion}}</td></tr>

                    <tr><td><b>Evaluación:</b> {{$evaluacion->evaluacion}}</td></tr>
                    <tr><td><b>Observaciones y Sugerencias:</b> {{$evaluacion->observaciones}}</td></tr>
                    <tr><td><b>Fecha Evaluación:</b> {{$evaluacion->fecha_evaluacion}}</td></tr>
                    <tr><td><b>Nombre Evaluador(a):</b> {{$evaluacion->nombre_evaluador}}</td></tr>
                    <tr><td><b>Código:</b> {{$evaluacion->codigo_evaluador}}</td></tr>
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
            </p>
        </div>
    </div>
</div>
</body>
</html>
