@extends('adminlte::page')
@section('title', 'Equipos área')

@section('css')
    @include('layouts.head_2')
@stop

@section('content')
    @if (Auth::check() &&
            (Auth::user()->role == 'admin' ||
                Auth::user()->role == 'rh' ||
                Auth::user()->role == 'redes' ||
                Auth::user()->role == 'cta'))
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <h3 class="text-center">
                        {{ $sede . ' - ' . $edificio }}
                    </h3>
                    <hr class="border border-dark">
                    <p class="text-center"><b>Total de equipos: </b>{{ count($equipos->all()) }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    @foreach ($cantidad as $item => $llave)
                        <button class="btn btn-primary text-wrap m-1"> <span
                                class="border-right border-white pr-1">{{ $item }}</span>
                            {{ $llave }}
                        </button>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID UDG</th>
                                <th>Resguardante</th>
                                <th>Tipo Equipo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Número de Serie</th>
                                <th>Área</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equipos as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->udg_id }}</td>
                                    <td>{{ $item->resguardante }}</td>
                                    <td>{{ $item->tipo_equipo }}</td>
                                    <td>{{ $item->marca }}</td>
                                    <td>{{ $item->modelo }}</td>
                                    <td>{{ $item->numero_serie }}</td>
                                    @php
                                        $area = explode('-', $item->area);
                                    @endphp
                                    <td>{{ $area[4] . '-' . $area[6] }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
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
        $(document).ready(function() {
            $('#example').DataTable({
                "pageLength": 10,
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
