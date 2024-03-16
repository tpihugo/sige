@extends('adminlte::page')
@section('title', 'Modulos')

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
            <div class="row mt-3">
                <h2 class="text-center">Modulos</h2>
            </div>
            <div class=" my-2">
                <form action="{{ route('modulos.store') }}" class="d-flex align-items-center" method="post">
                    @csrf
                    <div class="mx-1">
                        <input type="text" placeholder="Nombre" name="nombre" class="form-control">
                    </div>
                    <div class="mx-1">
                        <input type="text" placeholder="Nombre permiso" name="nombre_permiso" class="form-control">
                    </div>
                    <div class="mx-1">
                        <input type="text" placeholder="Icono" name="icono" class="form-control">
                    </div>
                    <div class="mx-1">
                        <input type="number" placeholder="Orden de ubicación" name="orden" class="form-control">
                    </div>

                    <div class="mx-1">
                        <input type="color" placeholder="Color" name="color" value="#563d7c"
                            class="form-control form-control-color">
                    </div>
                    <div class="mx-1">
                        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                    </div>

                </form>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-12">
                    <table id="usersTable" class="display table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Color</th>
                                <th>Icon</th>
                                <th>Orden</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modulos as $item => $value)
                                <tr>
                                    <td>{{ $value->nombre }}</td>
                                    <td>{{ $value->color }}</td>
                                    <td>{{ $value->icono }}</td>
                                    <td>{{ $value->orden }}</td>
                                    <td><a href="{{ route('modulos.edit', $value->id) }}"
                                            class="btn btn-sm btn-primary">editar</a>

                                        <a href="{{ route('modulos.destroy', $value) }}"
                                            class="btn btn-sm btn-primary">eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        @else
            No tienes permisos para acceder a este apartado
        @endif
    </div>
@endsection

@section('js')
    @include('layouts.scripts')
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                "pageLength": 25,
                "order": [
                    [0, "asc"]
                ],
                columnDefs: [{
                    targets: [0],
                    orderData: [0, 1]
                }],
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
            });
        });
    </script>
@endsection

@section('footer')
    <h4>Favor de reportar cualquier falla</h4>
@endsection
