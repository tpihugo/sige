@extends('adminlte::page')
@section('title', 'Inventario Localizado')

@section('css')
    @include('layouts.head_2')
@stop

@section('content')
    @if (Auth::check() && Auth::user()->role == 'admin')

        <div class="container-fluid">
            <div class="row g-3 align-items-center">
                <div class="col-md-12">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <h2>Localizados </h2>
                    </form>
                    <div class="row g-3 align-items-center">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>

                                    <th>Id SIGE</th>
                                    <th>Id UdeG</th>
                                    <th>Tipo de Equipo</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Núm. Serie</th>
                                    <th>Detalles</th>
                                    <th>Área</th>
                                    <th>Localizado SICI</th>
                                    <th>Estatus</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>

                    </div>
                </div>
            @else
                Acceso No válido
    @endif
@endsection

@section('js')
    @include('layouts.scripts')
    <script type="text/javascript">
        var data = @json($inventariolocalizado);

        $(document).ready(function() {
            $('#example').DataTable({
                "data": data,
                "pageLength": 25,
                "order": [
                    [0, "asc"]
                ],
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ning�n dato disponible en esta tabla",
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
                        "sLast": "�ltimo",
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
                    "�": a,
                    "�": a,
                    "�": a,
                    "�": a,
                    "�": a,
                    "�": a,
                    "�": e,
                    "�": e,
                    "�": e,
                    "�": e,
                    "�": i,
                    "�": i,
                    "�": i,
                    "�": i,
                    "�": o,
                    "�": o,
                    "�": o,
                    "�": o,
                    "�": o,
                    "�": o,
                    "�": u,
                    "�": u,
                    "�": u,
                    "�": u,
                    "�": c,
                    "�": c
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
@endsection
