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
            <div class="row mt-3">
                <h2 class="text-center">Oficios</h2>
            </div>
            <div class="d-flex justify-content-center my-2">
                @foreach ($anios as $item)

                <a class="btn btn-primary mx-1 btn-sm" href="{{{route('oficios.inicio', $item)}}}">{{ $item }}</a>
                    
                @endforeach
            </div>
            <div class="d-flex justify-content-end my-2">
                <a href="{{ route('oficios.general') }}" class="btn btn-primary mx-1 btn-sm">Crear Oficio</a>
                <a href="{{ route('oficios.create') }}" class="btn btn-success mx-1 btn-sm">Crear Oficio Liberación</a>

            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-12">
                    <table id="usersTable" class="display table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>Núm Oficio</th>
                                <th>Año</th>
                                <th>Dirigido</th>
                                <th>Atención</th>
                                <th>C.U.</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($oficios as $item => $value)
                                <tr>
                                    <td>{{ $value->num_oficio }}</td>
                                    <td>{{ $value->created_at->format('Y') }}</td>
                                    <td>{{ $value->dirigido }}</td>
                                    <td>{{ $value->atencion }}</td>
                                    <td>{{ $value->centro_universitario }}</td>

                                    <td><a target="_blank" href="{{ route('oficios.show', $value->id) }}">Imprimir</a>

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
                "pageLength": 25,
                "order": [
                    [0, "desc"]
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
