@extends('adminlte::page')
@section('title', 'Tickets')

@section('css')
    @include('layouts.head_2')
@stop

@section('content')
    @if (Auth::check())
        <div class="container-fluid">
            <div class="col-md-12 mt-3">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <h2 class="mt-3">Tickets </h2>
                <p align="right">
                    <a href="{{ route('tickets.create') }}" class="btn btn-success">Capturar Ticket</a>
                    <a href="{{ route('tickets.reporte') }}" class="btn btn-primary">Reporte Ticket</a>
                </p>
            </div>
        </div>
        <br>
        <form action="{{ route('filtroTickets') }}" method="post" enctype="multipart/form-data" class="col-12">
            <div class="row g-3 align-items-center">
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
                <br>
            </div>
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="tecnico_id">Técnico </label>
                    <select class="form-control" id="tecnico_id" name="tecnico_id">
                        @if (isset($tecnicoElegido->id) && !is_null($tecnicoElegido->id))
                            <option value="{{ $tecnicoElegido->id }}" selected>{{ $tecnicoElegido->nombre }}</option>
                            <option disabled>Elegir</option>
                        @else
                            <option disabled selected>Elegir</option>
                        @endif

                        @foreach ($tecnicos as $tecnico)
                            <option value="{{ $tecnico->id }}">{{ $tecnico->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="estatus">Estatus </label>
                    <select class="form-control" id="estatus" name="estatus">
                        @if (isset($estatus) && !is_null($estatus))
                            <option value="{{ $estatus }}">{{ $estatus }}</option>
                            <option disabled>Elegir</option>
                        @else
                            <option disabled selected>Elegir</option>
                        @endif
                        <option value="Abierto">Abierto</option>
                        <option value="Cerrado">Cerrado</option>
                        <option value="Escalado">Escalado</option>
                    </select>

                </div>
                <div class="col-sm-12 col-md-2 m-1">
                    <select name="sede" id="" class="form-control">
                        @if (isset($sede))
                            <option value="{{ $sede }}">{{ $sede }}</option>
                            <option disabled>Elegir</option>
                        @else
                            <option selected disabled>Seleccion una sede</option>
                        @endif
                        <option value="Belenes">Belenes</option>
                        <option value="La Normal">La Normal</option>
                    </select>
                </div>
                <div class="col-md-2 ">
                    <button type="submit" class="btn btn-outline-primary">Filtrar</button>
                    <a href="{{ route('tickets.index') }}" class="btn btn-outline-success">Quitar Filtro</a>
                </div>
            </div>
            <br>

        </form>
        <div class="row align-items-center">
            <div class="table-responsive">
                <table id="example" class=" display table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Folio</th>
                            <th scope="col">Fecha Reporte</th>
                            <th scope="col">Área</th>
                            <th scope="col">Solicitante</th>
                            <th scope="col">Contacto</th>
                            <th scope="col">Técnico</th>
                            <th scope="col">Categoría y Prioridad</th>
                            <th scope="col">Reporte</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-justify">
                    </tbody>

                </table>
            </div>
        </div>
        @if (Auth::user()->id == 161 || Auth::user()->role == 'admin')
            <div class="modal fade" id="tomar-ticket" tabindex="-1" aria-labelledby="asignar-usuario" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="" id="asignar" method="POST">
                                @csrf
                                <div class="form-group row justify-content-center">
                                    <label for="rol" class="col-md-4 col-form-label text-md-right">Selecciona al
                                        técnico</label>
                                    <div class="col-md-5">
                                        <select class="form-control " id="asignar_tecnico" name="tecnico">
                                            @foreach ($tecnicos as $item)
                                                <option value="{{ $item->id }}" class="w-100">{{ $item->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit"
                                            class="text-center w-100 btn btn-sm btn-primary">Asignar</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (isset($id_tecnico->id))
            <div class="modal fade" id="soltar-ticket" tabindex="-1" aria-labelledby="asignar-usuario" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="" id="soltar" class="row justify-content-center" method="POST">
                                @csrf
                                <label for="rol" class="col-md-12 form-label">Seleccioan el motivo por el que dejas
                                    el ticket</label>
                                <div class="col-md-12">
                                    <select class="form-control" id="motivo" name="motivo" required>
                                        <option selected disabled>selecciona una opción</option>
                                        <option value="área equivocada">Área equivocada</option>
                                        <option value="no se encontro personal">No se encontro personal</option>
                                        <option value="falta material">Falta material</option>
                                        <option value="tecnico se retiro">Técnico se retiro</option>
                                        <option value="usuario especializado">Más especialización</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                </div>
                                <label for="rol" class="col-md-12 form-label">Detalles</label>
                                <div class="col-sm-12">
                                    <textarea name="detalle" id="detalle" class="form-control"></textarea>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Soltar ticket</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal  fade" id="historial-ticket" tabindex="-1" aria-labelledby="asignar-usuario"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="display table-striped table-bordered" id="historial">

                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <p>
            <a href="{{ route('home') }}" class="btn btn-primary">
                Regresar</a>
        </p>


        </div>
    @else
        Acceso No válido
    @endif
@endsection


@section('js')
    @include('layouts.scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#asignar_tecnico').select2();
            $('#tecnico_id').select2();

        });
        function tomar_ticket(params) {
            var url = "{{ route('tomar-ticket', ':id') }}";
            url = url.replace(':id', params);
            document.getElementById('asignar').action = url;

        }
        function soltar_ticket(params) {
            var url = "{{ route('soltar-ticket', ':id') }}";
            url = url.replace(':id', params);
            document.getElementById('soltar').action = url;
        }
        function historial(params) {
            document.getElementById('historial').innerHTML = '';
            document.getElementById('historial').innerHTML =
                '<tr><td>Núm.</td><td>Usuario</td><td>Motivo</td><td>Detalle</td><td>Fecha</td></tr>';
            let cont = 1;
            params.forEach(element => {
                let fecha = new Date(element['created_at']);
                fecha = (fecha.getDate() + '/' + (fecha.getMonth() + 1) + '/' + fecha.getFullYear());
                document.getElementById('historial').innerHTML += '<td>' + cont + ' </td><td>' + element['nombre'] +
                    ' </td> <td>' + element['motivo'] + ' </td> <td>' + element['detalles'] + '</td> <td>' + fecha +
                    '</td>';
                cont = cont + 1;
            });
        }
        var data = @json($tickets);
        $(document).ready(function() {
            $('#example').DataTable({
                "data": data,
                "pageLength": 25,
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
@stop
