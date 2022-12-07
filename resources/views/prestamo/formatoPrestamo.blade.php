<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Préstamo / Recibo de Equipos. SIGE</title>

    <!-- Styles -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">

    <style>
        .pie {
            font-size: 10px;
            text-align: right;
        }

        td {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <p class="text-center"><img class="img-responsive" src="images/logo.jpg" width="100%"></p>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" colspan="7">
                                <center>
                                    <h5>Formato de Préstamo / Recibo de Equipos</h5>
                                </center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2"><b>Folio:</b> {{ $prestamo->id }}</td>
                            <td colspan="3"><b>Fecha:
                                </b>{{ \Carbon\Carbon::parse($prestamo->fecha_inicio)->format('d/m/Y') }}
                            </td>
                            <td colspan="2"><b>Tipo:</b> {{ $prestamo->estado }}</td>
                        </tr>
                        <tr>

                            <td colspan="7"><b>Solicitante: </b> {{ $prestamo->solicitante }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>Cargo: </b> {{ $prestamo->cargo }}</td>
                            <td colspan="4"><b>Contacto: </b> {{ $prestamo->contacto }}</td>

                        </tr>
                        <tr>
                            <td colspan="7"><b>Lugar:</b> {{ $prestamo->lugar }}</td>
                        </tr>
                        <tr>
                            <tr>
                                <td colspan="7" style="text-align: center;" class="thead-light"><b>Lista de Equipos</b></td>
                            </tr>
                        <tr>
                            <td><b>Id SIGE</b></td>
                            <td><b>IdUdeG</b></td>
                            <td><b>Tipo Equipo</b></td>
                            <td><b>Marca</b></td>
                            <td><b>Modelo</b></td>
                            <td><b>N/S</b></td>
                            <td><b>Accesorios</b></td>
                        </tr>
                        @foreach ($lista_final as $item)
                            <tr style="outline: thin solid">
                                <td >{{ $item['equipo']['id'] }}</td>
                                <td>{{ $item['equipo']['idUDG'] }}</td>
                                <td>{{ $item['equipo']['tipo'] }}</td>
                                <td>{{ $item['equipo']['marca'] }}</td>
                                <td>{{ $item['equipo']['modelo'] }}</td>
                                <td>{{ $item['equipo']['n_s'] }}</td>
                                <td>{{ $item['accesorios'] }}</td>
                            </tr>
                        @endforeach
                        </tr>
                        </tr>
                        <td colspan="7"><b>Observaciones:</b> {{ $prestamo->observaciones }}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <hr>
                <br>
                <table class="table table-bordered">

                    <tbody>
                        <tr>
                            <td align="center" colspan="2" style="background-color: #BEC6C7;"><b>ENTREGÓ</b></td>
                        </tr>
                        <tr>
                            <td align="left"><b>Nombre:</b> ___________________________________________</td>
                            <td align="left"><b>Firma:</b> ___________________</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <table class="table table-bordered">

                    <tbody>
                        <tr>
                            <td align="center" colspan="2" style="background-color: #BEC6C7;"><b>RECIBIÓ</b></td>
                        </tr>
                        <tr>
                            <td align="left"><b>Nombre:</b> ___________________________________________</td>
                            <td align="left"><b>Firma:</b> ___________________</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <br>
                <br>
                <br>
                <br><br>
                <p class="pie">Hora y día de Impresión: {{ date('d-m-Y H:i:s') }}<br>
                    Realizado por: {{ Auth::user()->name }}<br>
                    Formato CTA-010. Actualización: 28/abril/2021</p>
            </div>
        </div>
    </div>
</body>

</html>
