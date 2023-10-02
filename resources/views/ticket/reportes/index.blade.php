@extends('adminlte::page')
@section('title', 'Reporte de Tickets')

@section('css')
    @include('layouts.head_2')
    <style>
        .dtr-details {
            width: 100%;
        }
    </style>
@stop

@section('content')
    @if (Auth::check())
        <div class="container">
            <div class="col-md-12">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="row justify-content-end">
                <h2 class="mt-3 text-center">Estadisticas de Tickets </h2>
                <a href="{{ route('tickets.create') }}" class="btn btn-success col-auto m-1">Capturar Ticket</a>
            </div>
            <div class="text-center">
                <span class=" mx-1 px-1">
                    <button class="btn " style="background-color:#007bff;"></button> Tickets de Aulas
                </span>

                <span>
                    <button class="btn btn-success"></button> Tickets de Generales
                </span>
            </div>
            <div class="row align-items-center">
                <div class="table-responsive">
                    <table id="example" class="display table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">Fecha Inicio</th>
                                <th scope="col">Fecha Fin</th>
                                <th scope="col">Cantidad de reportes</th>
                                <th scope="col">Total</th>
                                <th scope="col">Detalles</th>

                            </tr>
                        </thead>
                        <tbody class="text-justify">
                            @foreach ($totales as $key => $value)
                                <tr>
                                    <td>{{ $value['Inicio'] }}</td>
                                    <td>{{ $value['Fin'] }}</td>
                                    <td style="max-width:400px;min-width:400px;">
                                        <div class="progress">
                                            @if ($value['Aulas'] > 0)
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $value['Porcentaje']['0'] }}%;"
                                                    aria-valuenow="{{ $value['Aulas'] }}" aria-valuemin="0"
                                                    aria-valuemax="{{ $value['General'] }}"> <span>
                                                        {{ $value['Aulas'] }}</span>
                                                </div>
                                            @endif
                                            <div class="progress-bar  bg-success" role="progressbar"
                                                style="width: {{ $value['Porcentaje']['1'] }}%;"
                                                aria-valuenow="{{ $value['Aulas'] }}" aria-valuemin="0"
                                                aria-valuemax="{{ $value['General'] }}">
                                                <span>{{ $value['General'] }}</span>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="text-center">
                                        {{ $value['Aulas'] + $value['General'] }}
                                    </td>
                                    <td class="text-center">
                                        <button type="button"
                                            onclick="datos_reporte(['{{ strval($value['Inicio']) }}', '{{ strval($value['Fin']) }}'])"
                                            class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#exampleModalCenter">
                                            <i class="material-icons">info_outline</i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="titulo" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titulo"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="reportes">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        Acceso No válido
    @endif
@endsection

@section('footer')
    <h5 class="text-end">En caso de inconsistencias, favor de reportarlas.</h5>
@endsection
@section('js')
    @include('layouts.scripts')
    <script>
        function datos_reporte(f_inicio, f_fin) {
            fechas = [f_inicio, f_fin];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = "{{ route('tickets.reporte-area', ':id') }}";
            url = url.replace(':id', fechas);
            $.ajax({
                url: url,
                method: 'GET',
                data: fechas
            }).done(function(data) {
                $('#titulo').html(fechas);
                $('#reportes').html(data);
            });
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#example').DataTable({
                "pageLength": 25,
                "order": [
                    [0, "desc"]
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
                //dom: 'Bfrtip',
                dom: '<"col-xs-3"l><"col-xs-5"B><"col-xs-4"f>rtip',
                buttons: [
                    'copy',
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LETTER',
                    },
                    {
                        extend: 'excelHtml5',
                        title: "Reporte de tickets",
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
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
        //"columnDefs": [{ type: 'portugues', targets: "_all" }],
    </script>
@stop
