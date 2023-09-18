@extends('adminlte::page')
@section('title', 'Subredes')

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
            <div class="row g-3 align-items-center">
                <div class="col-md-12">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <h2>Subredes</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-md-offset-2">
                    <center>
                        <a href="{{ route('home') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Regresar a
                            Inicio</a>
                        <a href="{{ route('subredes.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Capturar
                            Subred</a>
                    </center>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-sm-4">
                <form method="post" class="d-flex" id="form-busqueda">
                    @csrf
                    @method('POST')
                    <input type="text" name="equipo" placeholder="Buscar equipo" id="equipo" class="form-control">
                    <!-- Button trigger modal -->
                    <button type="button" onclick="busqueda()" class="btn btn-primary btn-sm">
                        Buscar
                    </button>
                </form>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-md-6 ">
                <div class="col-12">
                    <table id="example" class="table table-striped table-bordered" cellspacing="2" width="100%">
                        <thead>
                            <tr>
                                <th>
                                    <center>VLAN</center>
                                </th>
                                <th>
                                    <center>Rango inicial</center>
                                </th>
                                <th>
                                    <center>Rango final</center>
                                </th>
                                <th>
                                    <center>Gateway</center>
                                </th>
                                <th>
                                    <center>Descripción</center>
                                </th>
                                <th>
                                    <center>N° de IP'S</center>
                                </th>
                                <th>
                                    <center>Acciones</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Búsqueda de equipo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="contenedor">

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
    <script type="text/javascript">
        function busqueda() {
            //let search = $('#equipo').val();
            //console.log(search);
            $.ajax({
                url: "{{ route('subredes.buscar') }}",
                method: 'POST',
                data: $('#form-busqueda').serialize()
            }).done(function(data) {
                $('#contenedor').html(data);
                $('#exampleModal').modal('show');
            });
        }
        var data = @json($listasubredes);

        $(document).ready(function() {
            $('#example').DataTable({
                "data": data,
                "pageLength": 10,
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
@endsection
