@extends('adminlte::page')
@section('title', 'Invenatrio Área')

@section('css')
    @include('layouts.head_2')
@stop
@section('content')
    <div class="container">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>

                </div>
            @endif
            <h3 class="text-center">Inventario por área</h3>

            <h5 class="text-center"> <span hidden> {{ $area_actual->id }}</span> <strong> Area: </strong>
                {{ $area_actual->Area }} </h5>
            <br>
            <hr>
            <div class="row g-3 align-items-center">
                <div class="col-xl-3 col-md-3">
                    <div class="card bg-secondary text-white mb-3">
                        <div class="card-body">
                            <p class="h5 d-inline">
                                Equipos del área: <strong> {{ count($equipos) }}</strong>
                            </p>
                        </div>

                    </div>
                </div>

                <div class="col-xl-3 col-md-3">
                    <div class="card bg-secondary text-white mb-3">
                        <div class="card-body">
                            <p class="h5 d-inline">
                                Equipos en SICI: <strong>
                                    {{ isset($totales['S']) && isset($totales['N']) ? $totales['S'] + $totales['N'] : '0' }}
                                </strong>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-3">
                    <div class="card bg-secondary text-white mb-3">
                        <div class="card-body">
                            <p class="h5 d-inline">
                                Localizados SICI: <strong> {{ isset($totales['S']) ? $totales['S'] : '0' }} </strong>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-3">
                    <div class="card bg-secondary text-white mb-3">
                        <div class="card-body">
                            <p class="h5 d-inline">
                                No localizados SICI: <strong> {{ isset($totales['N']) ? $totales['N'] : '0' }}
                                </strong>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            {{-- /// --}}

            <div class="row g-3 align-items-center">
                <div class="col-xl-4 col-md-4">
                    <div class="card bg-success text-white mb-3">
                        <div class="card-body">Localizados: {{ $total_equipos_localizados }} </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="card bg-danger text-white mb-3">
                        <div class="card-body">No Localizados:
                            {{ count($equipos) - $total_equipos_localizados }}<b></b></div>
                    </div>
                </div>
                {{--
                <div class="col-xl-4 col-md-4">
                    <div class="card bg-warning text-white mb-3">
                        <div class="card-body">Equipos localizados de otras areas: {{ $total_equipos_localizados_externos }}
                        </div>
                    </div>
                </div>
            --}}

            </div>
            <br>
            <div class="row">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id SIGE</th>
                                <th>Id UdeG</th>
                                <th>Estatus</th>
                                <th>Tipo Equipo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Núm. Serie</th>
                                <th>Detalles</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            @endphp
                            @foreach ($equipos as $item => $value)
                                <tr>
                                    <td>
                                        {{ $value->id }}
                                    </td>
                                    <td>
                                        {{ $value->udg_id }}
                                    </td>
                                    <td>
                                        {{ $value->ultimo_inventario['estatus'] }} <br />
                                        {{ $value->ultimo_inventario['fecha'] }}
                                    </td>
                                    <td>
                                        {{ $value->tipo_equipo }}
                                    </td>
                                    <td>
                                        {{ $value->marca }}
                                    </td>
                                    <td>
                                        {{ $value->modelo }}
                                    </td>
                                    <td>
                                        {{ $value->numero_serie }}
                                    </td>
                                    <td>
                                        {{ $value->detalles }}
                                    </td>

                                    <td>
                                        @if (strcmp($value->ultimo_inventario['estatus'], 'Localizado') != 0)
                                            <p><a class="btn btn-outline-success"
                                                    href="{{ route('registro-inventario', ['equipo_id' => $value->id]) }}">Localizar</a>
                                            </p>
                                            <p><a href="{{ route('cambiar-ubicacion', ['equipo_id' => $value->id, 'tipo' => 'cambio']) }}"
                                                    class="btn btn-outline-primary">Reubicar</a></p>
                                            <p><a href="{{ route('equipos.edit', $value->id) }}"
                                                    class="btn btn-outline-secondary">Editar</a></p>
                                        @endif

                                        @if (strcmp($value->ultimo_inventario['estatus'], 'Localizado') == 0)
                                            @if (isset($value->ultimo_inventario['notas']))
                                                <a href="#noteModal" role="button"
                                                    onclick="launchModal( '{{ $value->id }}', '{{ $value->id_area }}', '{{ $value->ultimo_inventario['notas'] }}' );"
                                                    class="btn btn-outline-danger" data-toggle="modal">
                                                    <p class="d-inline">Ver o editar nota</p>
                                                </a>
                                            @else
                                                <a href="#noteModal" role="button"
                                                    onclick="launchModal( '{{ $value->id }}', '{{ $value->id_area }}', '{{ $value->ultimo_inventario['notas'] }}' );"
                                                    class="btn btn-outline-danger" data-toggle="modal">
                                                    <p class="d-inline">Agregar nota</p>
                                                </a>
                                            @endif
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="noteModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('inventario.store') }}" method="POST">
                            {!! csrf_field() !!}
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">Cerrar</button>
                            </div>
                            <div class="modal-body">

                                <h4>Agregar Nota al bien</h4>

                                <div class="row g-3 align-items-center">
                                    <div class="col-md-12">
                                        <h5>Nombre del responsable: {{ Auth::user()->name }}</h5>
                                        <label for="equipo_id">ID del equipo: </label>
                                        <input type="text" class="form-control" id="equipo_id" name="equipo_id"
                                            value="#">
                                        <label for="equipo_id">ID del area: </label>
                                        <input type="text" class="form-control" id="area_id" name="area_id"
                                            value="#">
                                        <input type="text" class="form-control" id="user_id" name="user_id"
                                            value="{{ Auth::user()->id }}" hidden>
                                        <label for="nota">Nota: </label>
                                        <textarea class="form-control" id="nota" name="nota"> - </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                {{-- {{ route('delete-alumno',['alumno_id' => $listaTutor->id]) }} --}}
                                <button type="submit" class="btn btn-danger">Guardar Nota</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@else
    El periodo de Registro de Proyectos a terminado
    @endif
@endsection

@section('js')
    @include('layouts.scripts')
    <script>
        function launchModal(equipo_id, area_id, notas) {
            document.getElementById('equipo_id').value = equipo_id;
            document.getElementById('area_id').value = area_id;
            document.getElementById('nota').value = notas;
            if (notas == '')
                document.getElementById('nota').value = '-';
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable({
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#js-example-basic-single').select2({
                theme: 'bootstrap-5'
            });
        });
    </script>
@endsection
