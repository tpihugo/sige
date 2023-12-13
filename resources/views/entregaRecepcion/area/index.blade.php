@extends('adminlte::page')
@section('title', 'Entrega de Recepcion de equipos')

@section('css')
    @include('layouts.head_2')
@stop


@section('content')
    <div class="container">
        <div class="row ">
            <h4 class="text-center mt-3">
                Equipos por área
            </h4>
        </div>
        <h6 class="text-center">
            <span  class="border-bottom border-success btn-sm">
                {{$total['encontrados']}} Encontrados
             </span>/
             <span  class="border-bottom border-primary btn-sm">
                 {{$total['total']}} Totales
             </span>
        </h6>
        <hr>
        <table class="display w-100 table-bordered table-striped" id="resguardantes">
            <thead>
                <tr>
                    <th>Área</th>
                    <th>Totales</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($areas_temp as $item => $value)
                    <tr>
                        <td>{{ $item }}</td>
                        @php
                            $totales = collect($value);
                            $totales[0] = $totales[0] == null ? 'Ninguno' : $totales[0];
                            $totales[2] = isset($totales[2]) ? $totales[2] : '0';
                        @endphp
                        <td> <span class='border-bottom border-success btn-sm'>{{ $totales[2] }}</span> /
                            <span class="border-bottom border-primary btn-sm">{{ $totales[1] }}</span> </td>
                        <td><a href="{{ route('entrega.area.equipos', $totales[0]) }}" class="btn btn-sm btn-primary">Ver
                                equipos</a> </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

@endsection

@section('js')
    @include('layouts.scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#resguardantes').DataTable({
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
