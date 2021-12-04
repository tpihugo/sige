<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Recibo de Equipo para Soporte. SIGE</title>

    <!-- Styles -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">

<style>
    .pie{
        font-size: 10px;
        text-align: right;
    }
    td, th, p {
        font-size: 12px;
    }
    h5 {
        font-size: 14px;
    }
</style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col">
            <p class="text-center"><img class="img-responsive" src="images/logo.jpg" width="100%"></p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p><b>Folio:</b> {{$ticket->id}}. <b>Fecha: </b> {{\Carbon\Carbon::parse($ticket->fecha_reporte)->format('d/m/Y') }}</p>
            <p><b>Solicitante:</b> {{$ticket->solicitante}}. <b>Contacto: </b> {{$ticket->contacto}}. <b>Técnico: </b> {{$ticket->tecnico}}</p>
            <p><b>Área:</b> {{$ticket->area}}</p>
            <p><b>Reporte:</b> {{$ticket->datos_reporte}}</p>
    </table>
            <h5><p align="center">Equipo Entregado a CTA</p></h5>
            @foreach($equipoPorTickets as $equipoPorTicket)
                <p><b>Id SIGE:</b> {{$equipoPorTicket->id}}. <b>Id UdeG: </b> {{$equipoPorTicket->udg_id }}. <b>Equipo: </b>{{$equipoPorTicket->tipo_equipo}}</p>
                <p><b>Marca:</b> {{$equipoPorTicket->marca}}. <b>Modelo: </b> {{$equipoPorTicket->modelo}}. <b>Núm. Serie: </b> {{$equipoPorTicket->numero_serie}}. <b>Detalles: </b></p>
                <p><b>Comentarios:</b> {{$equipoPorTicket->comentarios}}</p>
                <p><b>Detalles:</b> {{$equipoPorTicket->detalles}}</p>
            @endforeach
            <br>
            <h5>Recepción del Equipo en CTA</h5>
            <p><b>Fecha de Recepción: __________________________________</b></p>
            <p><b>Nombre de quién recibe: __________________________________</b></p>
            <p><b>Firma de quién recibe: __________________________________</b></p>
            <hr>
            <h5>Devolución del Equipo al Usuario</h5>
            <p><b>Fecha de Devolución al Usuario: __________________________________</b></p>
            <p><b>Nombre de quien recibe el equipo: __________________________________</b></p>
            <p><b>Firma de conformidad de quien recibe: __________________________________</b></p>

        </div>
    </div>
    <div class="row">
        <div class="col">
            <br>
            <br>

            <p class="pie">Hora y día de Impresión:  {{ date('d-m-Y H:i:s') }}<br>
                Realizado por:  {{ Auth::user()->name }}<br>
                Formato CTA-011. Actualización: 29/abril/2021</p>
        </div>
    </div>
</div>
</body>
</html>
