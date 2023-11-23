@extends('adminlte::page')
@section('title', 'Oficios')

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

            <div class="row mt-2">
                <h2>Oficios</h2>
            </div>
            <div class="d-flex justify-content-end my-2">
                <a href="{{ route('oficios.general') }}" class="btn btn-primary mx-1 btn-sm">Crear Oficio</a>
                <a href="{{ route('oficios.create') }}" class="btn btn-success mx-1 btn-sm">Crear Oficio Liberación</a>
                
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-12">
                    <table id="usersTable" class="display table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Núm Oficio</th>
                                <th>Dirigido</th>
                                <th>Atención</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($oficios as $item => $value)
                                <tr>
                                    <td>{{ $value->num_oficio }}</td>
                                    <td>{{ $value->dirigido }}</td>
                                    <td>{{ $value->atencion }}</td>
        
                                    <td><a href="{{ route('oficios.show', $value->id) }}">Imprimir</a>

                                        <a href="{{ route('oficios.edit', $value->id) }}">Editar</a>
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
@endsection

@section('js')
    @include('layouts.scripts')
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
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
            });
        });
    </script>
@endsection
