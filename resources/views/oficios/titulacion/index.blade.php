@extends('adminlte::page')
@section('title', 'Oficios')

@section('css')
    @include('layouts.head_2')
@stop
@section('content')
    <div class="container ">
        <div>
            <h2 class="text-center">Listado de solicitudes de alumnos</h2>
        </div>
        <table id="usersTable" class="display table-striped table-bordered" width="100%">
            <thead>
                <tr>
                    <th>
                        Código
                    </th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($oficios_titulacion as $item)
                    <tr>
                        <td>{{ $item->codigo }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <a onclick="change([{{ collect($item) }},'aceptar'])" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" class="btn btn-sm btn-primary">Aceptar</a>

                            <a onclick="change([{{ collect($item) }},'rechazar'])" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" href="" class="btn btn-sm btn-warning">Rechazar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">¿Seguro que quiere realizar esta acción?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('oficios.titulacion.formulario')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    @include('layouts.scripts')
    <script>
        function change(items) {
            console.log(items[0]['id']);
            document.getElementById("id").value = items[0]['id'];
            document.getElementById("nombre").value = items[0]['name'];
            document.getElementById("codigo").value = items[0]['codigo'];
            document.getElementById("carrera").value = items[0]['carrera'];
            document.getElementById("email").value = items[0]['email'];
            document.getElementById("estatus").value = items[1];
        }

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
