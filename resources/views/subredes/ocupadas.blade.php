@extends('adminlte::page')
@section('title', "IP'S Ocupadas")

@section('css')
    @include('layouts.head_2')
@stop

@section('content')
    <div class="container">
        @if (Auth::check() &&
                (Auth::user()->role == 'admin' ||
                    Auth::user()->role == 'cta' ||
                    Auth::user()->role == 'auxiliar' ||
                    Auth::user()->role == 'redes'))
            @if (session('message'))
                <div class="alert alert-success">
                    <p>{{ session('message') }}</p>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <h2>
                        <center><b>IP'S ocupadas:</b> {{ $num }}</center>
                    </h2>
                    <div class="row align-items-center m-0">
                        <div class="col-md-10">
                            <a href="{{ route('subredes.index') }}" class="btn btn-primary">Regresar</a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('disponible', $subred) }}" type="button"
                                class="btn btn-success">Disponibles</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="col">
                        {!! csrf_field() !!}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabla" class="table table-striped table-bordered" cellspacing="2" width="100%">
                            <thead>
                                <tr>
                                    <th>
                                        <center>IP</center>
                                    </th>
                                    <th>
                                        <center>Equipo</center>
                                    </th>
                                    <th>
                                        <center>Acciones</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($Ips as $ip)
                                    <tr>
                                        <td>
                                            <center>{{ $ip->ip }}</center>
                                        </td>
                                        <td><b>Número de serie:</b> {{ $ip->numero_serie }}<br>
                                            <b>MAC:</b> {{ $ip->mac }}<br>
                                            <b>Responsable:</b> {{ $ip->resguardante }} - {{ $ip->id_resguardante }}
                                        </td>
                                        <td>
                                            <center>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('ips.show', $ip->id) }}"
                                                        class="btn btn-info btn-sm"><i class="far fa-eye"></i> ver</a>
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            @else
                El periodo de Registro de Proyectos a terminado
        @endif
    </div>
    </div>
@endsection

@section('footer')
    <h5 class="text-end">En caso de inconsistencias, favor de reportarlas.</h5>
@endsection

@section('js')
    @include('layouts.scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tabla').DataTable({
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
