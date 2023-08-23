@extends('adminlte::page')
@section('title', 'Busqueda')
{{--
@extends('layouts.app')
--}}
@section('css')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
@stop
@section('content')
    @if (Auth::check() &&
            (Auth::user()->role == 'admin' ||
                Auth::user()->role == 'cta' ||
                Auth::user()->role == 'admin' ||
                Auth::user()->role == 'auxiliar' ||
                Auth::user()->role == 'redes' ||
                Auth::user()->role == 'general'))
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="card card-chart">
                        <div class="card-body">
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        Debe de escribir un criterio de búsqueda
                                    </ul>
                                </div>
                            @endif
                        </div> {{-- fin Cardchart --}}

                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <div class="card card-chart">
                            <div class="card-header card-header-info">
                                Su búsqueda fue: {{ $busqueda }}
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered"
                                    style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Id UdeG</th>
                                            <th>Tipo Equipo</th>
                                            <th>Marca</th>
                                            <th>Modelo</th>
                                            <th>Núm. Serie</th>
                                            <th>Detalles</th>
                                            <th>Área</th>
                                            @if (Auth::user()->role != 'general')
                                                <th width="10%">Acciones</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>
                            </div> {{-- fin de CardBody --}}
                            <div class="card-footer">

                            </div>
                        </div> {{-- fin Cardchart --}}

                    </div>
                    <div class="col-sm-12">
                        <p>
                            <a href="{{ route('home') }}" class="btn btn-primary">
                                < Regresar</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.js">
        </script>
        <script type="text/javascript">
            var data = @json($equipos);
            console.log(data);
            $(document).ready(function() {
                $('#example').DataTable({
                    "data": data,
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
            //"columnDefs": [{ type: 'portugues', targets: "_all" }],            
        </script>
    @else
        Acceso No válido
    @endif
@endsection
