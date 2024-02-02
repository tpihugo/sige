@extends('adminlte::page')
@section('title', 'Préstamos edit')

@section('css')
    @include('layouts.head_2')
@stop
@section('content')
    <div class="container">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h4>{{ session('message') }}</h4>

                </div>
            @endif
            <div class="container-fluid">
                <h2>Edición de Préstamo. Folio: {{ $prestamo->id }}</h2>
                <hr><br>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#js-example-basic-single').select2({
                            theme: 'bootstrap-5'
                        });

                    });
                </script>

            </div>
            <div class="container-fluid">
                <table id="ticket" class="table table-success table-bordered" style="width:100%">
                    <thead class="thead-light">
                        <tr>
                            <th><b>Folio</b></th>
                            <th><b>Lugar</b></th>
                            <th><b>Solicitante</b></th>
                            <th><b>Contacto</b></th>
                            <th><b>Cargo</b></th>
                            <th><b>Estado</b></th>
                            <th><b>Fecha</b></th>
                            <th><b>Observaciones</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <td>{{ $prestamo->id }}</td>
                            <td>{{ $prestamo->lugar }}</td>
                            <td>{{ $prestamo->solicitante }}</td>
                            <td>{{ $prestamo->contacto }}</td>
                            <td>{{ $prestamo->cargo }}</td>
                            <td>{{ $prestamo->estado }}</td>
                            <td>{{ \Carbon\Carbon::parse($prestamo->fecha_inicio)->format('d/m/Y') }}</td>
                            <td>{{ $prestamo->observaciones }}</td>
                        </tr>
                    </tbody>
                </table>
                <div style="text-align: center; justify-content: center;" class="row g-3 align-items-center">
                    <div class="col-md-5">
                        @if ($equiposPorPrestamo != null && count($equiposPorPrestamo) > 0)
                            <td><a class="btn btn-outline-info" style="width: auto"
                                    href="{{ route('imprimirPrestamo', $prestamo->id) }}" target="blank">Imprimir formato
                                    de préstamo</a></td>
                            <p>
                                <br>
                            </p>
                        @endif
                    </div>
                    <div class="col-md-5">
                        @if ($equiposPorPrestamo != null && count($equiposPorPrestamo) > 0)
                            <td><a class="btn btn-outline-success" style="width: auto"
                                    href="{{ route('imprimirContrato', $prestamo->id) }}" target="blank">Imprimir formato
                                    de contrato</a></td>
                            <p>
                                <br>
                            </p>
                        @endif
                    </div>
                </div>


                @if ($equiposPorPrestamo != null && count($equiposPorPrestamo) > 0)
                    <h5>
                        <p align="center">Equipo en préstamo</p>
                    </h5>
                    <table class="table table-bordered" style="width:100%" id="equipos">
                        <thead class="thead-light">
                            <tr>
                                <th>Item Prestamo</th>
                                <th>Id UdeG</th>
                                <th>Tipo Equipo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Núm. Serie</th>
                                <th>Detalles</th>
                                <th>Accesorios</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                @endif
                <tbody>
                    @foreach ($equiposPorPrestamo as $equipoPorPrestamo)
                        <tr>
                            <td>{{ $equipoPorPrestamo->id }}</td>
                            <td>
                                {{ $equipoPorPrestamo->udg_id }}
                            </td>
                            <td>{{ $equipoPorPrestamo->tipo_equipo }}</td>
                            <td>{{ $equipoPorPrestamo->marca }}</td>
                            <td>{{ $equipoPorPrestamo->modelo }}</td>
                            <td>{{ $equipoPorPrestamo->numero_serie }}</td>
                            <td>{{ $equipoPorPrestamo->detalles }}.<br><br>
                                @if ($equipoPorPrestamo->resguardante == 'CTA')
                                    Equipo de CTA.<br>
                                    @if ($equipoPorPrestamo->localizado_sici == 'S')
                                        Localizado.
                                    @else
                                        No localizado.
                                    @endif
                                @endif
                            </td>
                            <td>
                                {{-- {{route('agregar-comentario')}} --}}
                                <form action="{{ route('agregar-accesorio') }}" method="POST"
                                    enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <div class="row">
                                        <div class="col">

                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <input type="hidden" name="filaprestamo_id" id="filaprestamo_id"
                                                value="{{ $equipoPorPrestamo->id }}">
                                            <input type="hidden" name="prestamo_id" id="prestamo_id"
                                                value="{{ $equipoPorPrestamo->id_prestamo }}">
                                            <input type="text" name="accesorios" id="accesorios"
                                                value="{{ $equipoPorPrestamo->accesorios }}">
                                            <br><br>
                                            <input type="submit" class="btn btn-outline-success" value="Agregar">
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td><a href="{{ route('eliminarEquipoPrestamo', $equipoPorPrestamo->id) }}"
                                    class="btn btn-outline-danger">Quitar</a></td>
                        </tr>
                    @endforeach
                </tbody>
                </table>

            </div>
            <hr>

            <div class="container-fluid">
                <h5>
                    <center>Agregar Equipos</center>
                </h5>

                <form action="{{ route('busquedaEquiposPrestamo') }}" method="POST" enctype="multipart/form-data"
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
                            <input type="hidden" class="form-control" id="prestamo_id" name="prestamo_id"
                                value="{{ $prestamo->id }}" readonly>
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
                                        @if ($consult = DB::table('movimiento_equipos')->where('id_equipo', '=', $equipo->id)->orderBy('id', 'desc')->limit(1)->latest()->first())
                                            @if ($consult->registro == 'En préstamo')
                                                <p><a onclick="modal({{ collect($equipo) }})" class="btn btn-outline-info"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                        style="color: rgb(7,189,212)">En prèstamo</a></p>
                                            @else
                                                <p><a href="{{ route('registrarEquipoPrestamo', [$equipo->id, $prestamo_id]) }}"
                                                        class="btn btn-outline-success">Agregar</a></p>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>

                </table>

            </div>
            <div class="container-fluid">
                <br>
                <div class="container-fluid g-3 align-items-center">
                    <div class="col-md-6">
                        <a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>

                    </div>
                </div>
            </div>

            <br>
            <div class="container-fluid g-3 align-items-center">

                <br>
                <h5>En caso de inconsistencias, favor de reportarlas a victor.ramirez@academicos.udg.mx</h5>
                <hr>

            </div>
    </div>
    @section('js')
        @include('layouts.scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#ticket').DataTable({
                    responsive: true
                });
                $('#equipos').DataTable({
                    responsive: true
                });
                $('#example').DataTable({
                    "pageLength": 20,
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
                    responsive: true,
                });
            });

            function modal(params) {
                // console.log(params);
                $("#exampleModalLabel").html(params['prestamo']);

                if (params.hasOwnProperty('prestamo')) {
                    $("#id").html(params['prestamo']['id']);
                    $("#lugar").html(params['prestamo']['lugar']);
                    $("#solicitante").html(params['prestamo']['solicitante']);
                    $("#contacto").html(params['prestamo']['contacto']);
                    $("#responsable").html(params['prestamo']['responsable']);
                }
            }
        </script>
    @stop
@else
    El periodo de Registro de Proyectos a terminado
    @endif



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Equipo en préstamo</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <h5>Id préstamo:</h5>
                            <strong id="id"></strong>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <h5>Área:</h5>
                            <strong id="lugar"></strong>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <h5>Solicitante:</h5>
                            <strong id="solicitante"></strong>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <h5>Contacto:</h5>
                            <strong id="contacto"></strong>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <h5>Responsable:</h5>
                            <strong id="responsable"></strong>
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <button type="button" class="btn grey btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
