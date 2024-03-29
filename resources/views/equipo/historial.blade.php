@extends('adminlte::page')
@section('title', 'Historial Equipo')

@section('css')
    @include('layouts.head_2')
@stop

@section('content')

    @if (Auth::check())

        <div class="container">
            <div class="row">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <div class="row">
                <h2>Listado de Movimientos por Equipo </h2>
                <br>
            </div>
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <h5><br>IdSIGE: {{ $equipo->id }}. IdUdeG: {{ $equipo->udg_id }}. </h5>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <b>Tipo de Equipo:</b> {{ $equipo->tipo_equipo }}
                </div>
                <div class="col-md-3 col-xs-12">
                    <b>Marca: </b>{{ $equipo->marca }}

                </div>
                <div class="col-md-3 col-xs-12">
                    <b>Modelo: </b>{{ $equipo->modelo }}

                </div>
                <div class="col-md-3 col-xs-12">
                    <b>Número de Serie: </b> {{ $equipo->numero_serie }}

                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <b>Detalles </b> {{ $equipo->detalles }}
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <b>Ubicación </b> {{ $equipo->area }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <b>Inventario: </b>
                    @if ($equipo->resguardante == 'CTA')
                        Equipo de CTA.
                        @if ($equipo->localizado_sici == 'S')
                            Localizado 2019.
                        @else
                            No localizado 2019.
                        @endif
                    @endif
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <table id="example" class=" display table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>IdMovimiento</th>
                                <th>Tipo de Área</th>
                                <th>Sede</th>
                                <th>Edificio</th>
                                <th>Piso</th>
                                <th>División</th>
                                <th>Coordinación</th>
                                <th>Área</th>
                                <th>Código Usuario</th>
                                <th>Usuario</th>
                                <th>Registro</th>
                                <th>Fecha</th>
                                <th>Comentarios</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($historialMovimientos as $historialMovimiento)
                                <tr>
                                    <td>{{ $historialMovimiento->id_movimiento }}</td>
                                    <td>{{ $historialMovimiento->tipo_espacio }}</td>
                                    <td>{{ $historialMovimiento->sede }}</td>
                                    <td>{{ $historialMovimiento->edificio }}</td>
                                    <td>{{ $historialMovimiento->piso }}</td>
                                    <td>{{ $historialMovimiento->division }}</td>
                                    <td>{{ $historialMovimiento->coordinacion }}</td>
                                    <td>{{ $historialMovimiento->area }}</td>
                                    <td>{{ $historialMovimiento->codigo }}</td>
                                    <td>{{ $historialMovimiento->nombre }}</td>
                                    <td>{{ $historialMovimiento->registro }}</td>
                                    <td>{{ \Carbon\Carbon::parse($historialMovimiento->fecha)->format('d/m/Y') }}</td>
                                    <td>{{ $historialMovimiento->comentarios }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <p>
            <a href="{{ route('home') }}" class="btn btn-primary">
                < Regresar</a>
        </p>
        </div>
    @else
        Acceso No válido
    @endif
@endsection

@section('js')
    @include('layouts.scripts')
    <script>
        //"columnDefs": [{ type: 'portugues', targets: "_all" }],

        $(document).ready(function() {
            $('#example').DataTable({
                "pageLength": 50,
                "order": [
                    [0, "asc"]
                ],
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                responsive: true,
                // dom: 'Bfrtip',
                dom: '<"col-xs-3"l><"col-xs-5"B><"col-xs-4"f>rtip',
                buttons: [
                    'copy', 'excel',
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LETTER',
                    }

                ]
            })
        });
        jQuery.extend(jQuery.fn.dataTableExt.oSort, {
            "portugues-pre": function(data) {
                var a = 'a';
                var e = 'e';
                var i = 'i';
                var o = 'o';
                var u = 'u';
                var c = 'c';
                var special_letters = {
                    "Á": a,
                    "á": a,
                    "Ã": a,
                    "ã": a,
                    "À": a,
                    "à": a,
                    "É": e,
                    "é": e,
                    "Ê": e,
                    "ê": e,
                    "Í": i,
                    "í": i,
                    "Î": i,
                    "î": i,
                    "Ó": o,
                    "ó": o,
                    "Õ": o,
                    "õ": o,
                    "Ô": o,
                    "ô": o,
                    "Ú": u,
                    "ú": u,
                    "Ü": u,
                    "ü": u,
                    "ç": c,
                    "Ç": c
                };
                for (var val in special_letters)
                    data = data.split(val).join(special_letters[val]).toLowerCase();
                return data;
            },
            "portugues-asc": function(a, b) {
                return ((a < b) ? -1 : ((a > b) ? 1 : 0));
            },
            "portugues-desc": function(a, b) {
                return ((a < b) ? 1 : ((a > b) ? -1 : 0));
            }
        });
    </script>
@endsection
