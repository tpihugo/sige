@extends('adminlte::page')
@section('title', 'Recibo ticket')

@section('css')
    @include('layouts.head_2')
@stop

@section('content')
    @if ((Auth::check() && Auth::user()->role == 'admin') || Auth::user()->role == 'cta')

        <div class="container">
            <div class="row">
                @if (session('message'))
                    <div class="col-sm-12">
                        <div class="alert alert-success mt-3">
                            <h4> {{ session('message') }} </h4>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="mt-3">Ticket {{ $ticket_id }}.</h3> <br>
                    <table class="table " style="width:100%">
                        <thead class="bg-success">
                            <tr>
                                <th>Folio</th>
                                <th>Estatus</th>
                                <th>Fecha</th>
                                <th>Área</th>
                                <th>Reporte</th>
                                <th>Contacto</th>
                                <th>Técnico</th>
                                <th>Recibo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $ticket->id }}</td>
                                <td>{{ $ticket->estatus }}</td>
                                <td>{{ $ticket->fecha_reporte }}</td>
                                <td>{{ $ticket->area }}</td>
                                <td>{{ $ticket->datos_reporte }}</td>
                                <td>{{ $ticket->contacto }}</td>
                                <td>{{ $ticket->tecnico }}</td>
                                <td><a href="{{ route('imprimirRecibo', $ticket_id) }}" class="btn btn-primary"
                                        target="_blank">Recibo</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h5>
                        Equipo ya registrado
                    </h5>
                    <table class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id SIGE</th>
                                <th>Id UdeG</th>
                                <th>Tipo Equipo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Núm. Serie</th>
                                <th>Detalles</th>
                                <th>Comentarios</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($equipoPorTickets as $equipoPorTicket)
                                <tr>
                                    <td>{{ $equipoPorTicket->id }}</td>
                                    <td>
                                        {{ $equipoPorTicket->udg_id }}
                                    </td>
                                    <td>{{ $equipoPorTicket->tipo_equipo }}</td>
                                    <td>{{ $equipoPorTicket->marca }}</td>
                                    <td>{{ $equipoPorTicket->modelo }}</td>
                                    <td>{{ $equipoPorTicket->numero_serie }}</td>
                                    <td>{{ $equipoPorTicket->detalles }}.<br><br>
                                        @if ($equipoPorTicket->resguardante == 'CTA')
                                            Equipo de CTA.<br>
                                            @if ($equipoPorTicket->localizado_sici == 'S')
                                                Localizado.
                                            @else
                                                No localizado.
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('agregar-comentario') }}" method="POST">
                                            <div class="row">
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
                                                    <input type="hidden" name="equipo_id" id="equipo_id"
                                                        value="{{ $equipoPorTicket->id }}">
                                                    <input type="hidden" name="ticket_id" id="ticket_id"
                                                        value="{{ $ticket_id }}">
                                                    <input type="text" name="comentarios" id="comentarios"
                                                        value="{{ $equipoPorTicket->comentarios }}">
                                                    <br><br>
                                                    <input type="submit" class="btn btn-outline-success" value="Agregar">
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td><a href="{{ route('eliminarEquipoTicket', [$equipoPorTicket->id, $ticket_id]) }}"
                                            class="btn btn-outline-danger">Quitar</a></td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>


            {{-- @endif --}}
            <div class="row">
                <div class="col-sm-12">
                    <h5 class="border-top">
                        Agregar Equipos
                    </h5>
                    <form action="{{ route('busquedaEquiposTicket') }}" method="POST" enctype="multipart/form-data"
                        class="col-12">
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
                                <input type="hidden" class="form-control" id="ticket_id" name="ticket_id"
                                    value="{{ $ticket_id }}" readonly>
                            </div>
                            <div class="col-md-1">

                                <button type="submit" class="btn btn-success">Buscar</button>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('equipos.create') }}" class="btn btn-outline-success">Capturar Equipo</a>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
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
                                <th>Área</th>
                                <th>Acciones</th>

                            </tr>
                        </thead>
                        <tbody>

                            @if (isset($equipos))
                                @foreach ($equipos as $equipo)
                                    <tr>
                                        <td>{{ $equipo->id }}</td>
                                        <td>
                                            {{ $equipo->udg_id }}
                                        </td>
                                        <td>{{ $equipo->tipo_equipo }}</td>
                                        <td>{{ $equipo->marca }}</td>
                                        <td>{{ $equipo->modelo }}</td>
                                        <td>{{ $equipo->numero_serie }}</td>
                                        <td>{{ $equipo->detalles }}.<br><br>
                                            @if ($equipo->resguardante == 'CTA')
                                                Equipo de CTA.<br>
                                                @if ($equipo->localizado_sici == 'S')
                                                    Localizado.
                                                @else
                                                    No localizado.
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $equipo->area }}</td>
                                        <td>
                                            <p><a href="{{ route('registrarEquipoTicket', [$equipo->id, $ticket_id]) }}"
                                                    class="btn btn-outline-success">Agregar</a></p>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>

                    </table>
                </div>
            </div>
            <p>
                <a href="{{ route('home') }}" class="btn btn-primary">Regresar</a>
            </p>
        </div>
    @else
        Acceso No válido
    @endif
@endsection
@section('js')
    <script>
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
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel',
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LETTER',
                    }

                ]
            });
        });
    </script>
@stop
