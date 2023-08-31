@extends('adminlte::page')
@section('title', 'Usuarios')

@section('css')
    @include('layouts.head_2')
@stop

@section('content')
    <div class="container">
        @if (Auth::check())
            <div class="row align-items-center ">
                @can('BUSQUEDAR#buscar')
                    <div class="col-md-12">
                        <div class="card card-chart mt-3">
                            <div class="card-body">
                                <div class="col-sm-12">
                                    <h3>Administración de Usuarios</h3>
                                </div>
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                @if (session('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger text-center">
                                        Debe de escribir un criterio de búsqueda
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
            <div class="row">
                <div class="col-auto mb-1">
                    <br>
                    <form method="POST" action="{{ route('usuarios.create') }}">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            {{ __('Nuevo Usuario') }}
                        </button>
                    </form>
                </div>
            </div>

            @if (isset($retorno))
                @if (count($retorno['Error']) > 0)
                    <div class="alert alert-danger" id="alert" role="alert">
                        {{ implode("\n", $retorno['Error']) }}
                    </div>
                @else
                    <div class="alert alert-info" id="alert" role="alert">
                        {{ implode("\n", $retorno['Success']) }}
                    </div>
                @endif

            @endif

            <div class="row">
                <div class="col-sm-12">
                    <table id="usersTable" class=" display table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Activo</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    @if ($usuario->activo == 1)
                                        <td>Activo</td>
                                        <td>
                                            <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                                class="btn-sm btn btn-primary">
                                                Editar
                                            </a>

                                            <a href="{{ route('usuarios.delete', $usuario) }}"
                                                class="btn btn-danger btn-sm">Desactivar</a>
                                        </td>
                                    @else
                                        <td><span class="inactivo">Inactivo</span></td>
                                        <td>
                                            <form method="POST" action="{{ route('usuarios.show', $usuario->id) }}">
                                                @method('GET')
                                                <button type="submit" class=" btn-sm btn btn-success">
                                                    {{ __('Activar') }}
                                                </button>
                                            </form>
                                        </td>
                                    @endif
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
@endsection

@section('footer')
    <div class="row g-3 align-items-center mt-3">
        <h5 class="text-end">En caso de inconsistencias, favor de reportarlas.</h5>
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
