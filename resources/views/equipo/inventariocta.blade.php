@extends('adminlte::page')
@section('title', 'Inventario Estadisticas')

@section('css')
    @include('layouts.head_2')
@stop

@section('content')
    @if (Auth::check() &&
            (Auth::user()->role == 'admin' ||
                Auth::user()->role == 'cta' ||
                Auth::user()->role == 'auxiliar' ||
                Auth::user()->role == 'redes'))

        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h2>Inventario Completo CTA Equipo.</h2> <br>
                    <br>
                    <p align="right">
                        <a href="{{ route('equipos.create') }}" class="btn btn-outline-success">Capturar Equipo</a>
                        <a href="{{ route('home') }}" class="btn btn-outline-primary">
                            < Regresar</a>
                    </p>
                    <form action="{{ route('busqueda') }}" method="POST" enctype="multipart/form-data" class="col-12">
                        {!! csrf_field() !!}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    Debe de escribir un criterio de búsqueda
                                </ul>
                            </div>
                        @endif
                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-2">
                                <label>Búsqueda</label>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="busqueda" name="busqueda">
                            </div>
                            <div class="col-md-1">

                                <button type="submit" class="btn btn-success">Buscar</button>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-secondary">Avanzada</button>
                            </div>
                        </div>
                        <br>
                    </form>
                    <hr>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                
                                <th>Id SIGE</th>
                                <th>Id UdeG</th>
                                <th>Tipo Equipo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Núm. Serie</th>
                                <th>Detalles</th>
                                <th>&Aacute;rea</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>

                    </table>

                    <p>
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            < Regresar</a>
                    </p>
                </div>
            </div>
        </div>
    @else
        Acceso No válido
    @endif
@endsection

@section('js')
    @include('layouts.scripts')
    <script type="text/javascript">
        var data = @json($equipos);

        $(document).ready(function() {
            $('#example').DataTable({
                "data": data,
                "pageLength": 25,
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
