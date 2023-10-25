@extends('adminlte::page')
@section('title', 'Moviliario')

@section('css')
    @include('layouts.head_2')

@stop

@section('content')
    @if (Auth::check() &&
            (Auth::user()->role == 'admin' ||
                Auth::user()->role == 'cta' ||
                Auth::user()->role == 'auxiliar' ||
                Auth::user()->role == 'redes' ||
                Auth::user()->role == 'general'))
        <div class="container-fluid">
            <div class="row">
                @if (session('message'))
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    </div>
                @endif
                <div class="col-sm-12">
                    <h2 class="text-center">Listado de Mobiliario </h2>

                    <p align="right">
                        @if (Auth::check() && Auth::user()->role != 'general')
                            <a href="{{ route('mobiliarios.create') }}" class="btn btn-success">Capturar Mobiliario</a>
                        @endif
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            < Regresar</a>
                    </p>
                </div>


            </div>
            <div class="row">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id Mobiliário</th>
                            <th>Id UDG</th>
                            <th>Nombre Resguardante</th>
                            <th>Área</th>
                            <th>Descripción</th>
                            <th>Ubicación</th>
                            <th>Fecha Adquisición</th>
                            <th>Estatus SICI</th>
                            <th>Localizado SICI</th>
                            @if (Auth::check() && Auth::user()->role != 'general')
                                <th>Acciones</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                </table>

            </div>
        </div>
    @else
        Acceso No válido
    @endif
@endsection
@section('footer')
    <div class="row g-3 align-items-center">
        <h5 class="text-end">En caso de inconsistencias, favor de reportarlas.</h5>
    </div>
@endsection

@section('js')
    @include('layouts.scripts')
    <script type="text/javascript">
        var data = @json($mobiliarios);
        console.log(data);

        $(document).ready(function() {

            $('#example').DataTable({
                "data": data,
                "pageLength": 50,
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
        //"columnDefs": [{ type: 'portugues', targets: "_all" }],            
    </script>
@endsection
