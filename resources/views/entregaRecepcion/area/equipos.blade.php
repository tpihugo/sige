@extends('adminlte::page')
@section('title', 'Entrega de Recepcion de equipos')

@section('css')
    @include('layouts.head_2')
@stop

@section('content')
    <div class="container">
        <h4 class="text-center">
            Equipos de del área {{ $area['area'] }}
        </h4>
        <h6 class="text-center">
            Total de equipos <span id="total" class="border-bottom border-primary btn-sm">{{ $total[0] }}</span> / Encontrados <span id="encontrados"
                class="border-bottom border-success btn-sm">{{ $total[1] }}</span> /
            Faltantes <span id="faltantes" class="border-bottom border-danger btn-sm">{{ $total[0] - $total[1] }} </span>
        </h6>
        <hr>
        <table class="display w-100 table-bordered table-striped" id="resguardantes">
            <thead>
                <tr>
                    <th>UDG ID</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>S/N</th>
                    <th>Fecha ubicado</th>
                    <th>Acción</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($equipos_totales as $item => $value)
                    <tr>
                        <td>{{ $value->udg_id }}</td>
                        <td>{{ $value->marca }}</td>
                        <td>{{ $value->modelo }}</td>
                        <td>{{ $value->numero_serie }}</td>
                        <td>
                            @if (isset($value->fecha))
                                <span id="fecha-{{ $value->udg_id }}">
                                    {{ $value->fecha }}
                                </span>
                            @else
                                <span id="fecha-{{ $value->udg_id }}">Nunca ubicado</span>
                            @endif
                        </td>
                        <td class="text-center ">
                            @if ($area['id'] != 0)
                                <input onclick="guardar('{{ $value->udg_id }}')" type="checkbox" name="id_equipo"
                                    {{ $value->ubicado == 1 ? 'checked' : '' }} id="{{ $value->udg_id }}">
                            @else
                                <a class="btn btn-sm btn-primary"
                                    href="{{ route('cambiar-ubicacion', $value->id) }}">Reubicar</a>
                            @endif
                        </td>
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
                    [1, "asc"]
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
    <script>
        function guardar(elemento) {
            ubicado = (document.getElementById(elemento).checked) ? 1 : 0;
            send = {
                "ubicado": ubicado,
                "id": elemento,
                "id_area": '{{ $area['id'] }}'
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = "{{ route('entregarRecepcion.guardar') }}";
            $.ajax({
                url: url,
                method: 'POST',
                data: send
            }).done(function(data) {
                //console.log(data);
                document.getElementById('total').innerHTML = data.total;
                document.getElementById('encontrados').innerHTML = data.encontrados;
                document.getElementById('faltantes').innerHTML = data.total - data.encontrados;
                document.getElementById("fecha-" + data.fecha[1]).innerHTML = data.fecha[0];
            });
        }
    </script>
@endsection
