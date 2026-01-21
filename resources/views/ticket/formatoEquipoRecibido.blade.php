<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Recibo de Equipo para Soporte. SIGE</title>
    <style>
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            src: url('{{ asset('fonts/Montserrat-Regular.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 700;
            src: url('{{ asset('fonts/Montserrat-Bold.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Times New Roman';
            font-style: normal;
            font-weight: 700;
            src: url('{{ asset('fonts/Times New Roman Bold.ttf') }}') format('truetype');
        }

        body {
            font-family: 'Montserrat';
            font-size: 10pt;
        }

        body {
            font-size: 16pt;
        }

        table,
        tr {
            width: 100%;
        }

        td,
        th,
        p {
            font-size: 12px;
            padding: 5px;
        }

        h5 {
            font-size: 14px;
        }

        @page {
            margin-top: 10px;
            margin-bottom: 30px;
        }

        .pie {
            font-size: 10px;
            text-align: right;
            border-top: grey 1px solid;
            margin-top: 10px;
            padding-top: 10px;
            display: block;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        }

        .border {
            border: 1px solid grey;
        }

        .border,
        .border td {
            border: 1px solid black;
            border-collapse: collapse;
            border: 1px solid grey;
            margin-bottom: 5px;
            padding: 3px;
            border-radius: 5px
        }

        .firma {
            border-bottom: 1px grey solid;
            margin: 0px;
            padding-top: 3px;
            padding: 0px;
        }
    </style>
</head>

<body>
    <footer>
        <div style="font-size: 12px; " class="border">
            <b> NOTA: El usuario debe de realizar respaldo de su información. CTA no se hace responsable pérdidas de
                información, daños preexistentes o fallas que puedan surgir durante el servicio de reparación o
                instalación de software.</b>
            <br>
            El cliente acepta la posibilidad de fallos derivados del proceso de reparación.
        </div>
        <span class="pie">Hora y día de Impresión: {{ date('d-m-Y H:i:s') }} /
            Realizado por: {{ Auth::user()->name }} /
            Formato CTA-011. Actualización: 29/abril/2021</span>
    </footer>

    <div class="container">
        <div class="row"><br>
            <div class="col">
                <img class="img-responsive" src="images/logo.jpg" width="100%">
            </div>
        </div>
        <div class="col-md-12 col-xs-12">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" colspan="3"> <b>Formato de recibo de equipo</b>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b>Folio: </b>{{ $ticket->id }}</td>
                        <td><b>Fecha: </b>{{ \Carbon\Carbon::parse($ticket->modificado)->format('d/m/Y') }}</td>
                        <td><b>Técnico: </b>{{ $ticket->tecnico }}</td>
                    </tr>
                    <tr>
                        @php
                            $solicitanteInfo = explode('-', $ticket->solicitante);
                        @endphp
                        <td colspan="2"><b>Solicitante: </b>{{ $solicitanteInfo[0] }}</td>
                        <td><b>Contacto:
                            </b>{{ isset($solicitanteInfo[2]) ? $solicitanteInfo[1] . ' / ' . $solicitanteInfo[2] : $solicitanteInfo[1] }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Área: </b>{{ $ticket->area }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Reporte: </b>{{ $ticket->datos_reporte }}</td>
                    </tr>
                </tbody>

            </table>
            <div class="col-md-12 col-xs-12">
                <table class="border">
                    <thead class="border">
                        <tr>
                            <th scope="col" colspan="3"><b>Equipo Entregado a CTA</b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipoPorTickets as $equipoPorTicket)
                            <tr>
                                <td><b>Id SIGE: </b> {{ $equipoPorTicket->id }}</td>
                                <td><b>Id UdeG: </b> {{ $equipoPorTicket->udg_id }}</td>
                                <td><b>Equipo: </b> {{ $equipoPorTicket->tipo_equipo }}</td>
                            </tr>
                            <tr>
                                <td><b>Marca: </b> {{ $equipoPorTicket->marca }}</td>
                                <td><b>Modelo: </b> {{ $equipoPorTicket->modelo }}</td>
                                <td><b>Núm. Serie: </b> {{ $equipoPorTicket->numero_serie }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"><b>Detalles: </b> {{ $equipoPorTicket->detalles }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"><b>Comentarios: </b> {{ $equipoPorTicket->comentarios }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td align="center" colspan="2" style="background-color: #BEC6C7;"><b>Recepción del Equipo en
                                CTA</b></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p class="firma"> Nombre de quién recibe:</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="firma">Firma de recibido: </p>
                        </td>
                        <td>
                            <p class="firma">Fecha</p>
                        </td>

                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td align="center" colspan="2" style="background-color: #BEC6C7;"><b>Devolución del Equipo al Usuario</b></td>
                    </tr>
                    <tr>
                        <td align="left" colspan="2">
                            <p class="firma"> Nombre de quién recibe:</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="firma">Firma de recibido: </p>
                        </td>
                        <td>
                            <p class="firma">Fecha</p>
                        </td>

                    </tr>
                </tbody>
            </table>

        </div>
    </div>

</body>

</html>
