@extends('adminlte::page')
@section('title', 'Historial Equipo')

@section('css')
    @include('layouts.head_2')
@stop


@section('content')
    <div class="container-fluid">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <!-- Content Row -->



        <h1 class="h3 mb-2 text-gray-800">Reporte de préstamo {{ $cargo }}</h1>

        <div class="container-fluid">

            <!-- Page Heading -->

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="reportes" class=" display table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Solicitante</th>
                                    <th>Carrera</th>
                                    <th>&Aacuterea</th>
                                    <th>Contacto</th>
                                    <th>Fecha</th>
                                    <th>Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    @include('layouts.scripts')
    <!-- Funcion del diagrama cargos-->
    <script src="{{ asset('js/Chart.js') }}"></script>
    <!-- Funcion de la tabla-->

    <script type="text/javascript">
        var dataReporte = @json($reporte);


        $(document).ready(function() {
            $('#reportes').DataTable({
                "data": dataReporte,
                "pageLength": 10,
                "order": [
                    [0, "desc"]
                ],
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ning n dato disponible en esta tabla",
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
                        "sLast": " ltimo",
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
            loader(false);
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
                    " ": a,
                    " ": a,
                    " ": a,
                    " ": a,
                    " ": a,
                    " ": a,
                    " ": e,
                    " ": e,
                    " ": e,
                    " ": e,
                    " ": i,
                    " ": i,
                    " ": i,
                    " ": i,
                    " ": o,
                    " ": o,
                    " ": o,
                    " ": o,
                    " ": o,
                    " ": o,
                    " ": u,
                    " ": u,
                    " ": u,
                    " ": u,
                    " ": c,
                    " ": c
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


@endsection
