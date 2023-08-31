@extends('adminlte::page')
@section('title', 'Licencias')

@section('css')
    @include('layouts.head_2')
@stop

@section('content')
    @if (Auth::check())

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <h2>Listado de licencias </h2>
                    <br>
                    <p align="right">
                        <a href="{{ route('licencias.create') }}" class="btn btn-success">Capturar licencia</a>
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            < Regresar</a>
                    </p>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                               
                                <th>Id</th>
                                <th>N&uacutemero de requisici&oacuten</th>
                                <th>Presupuesto</th>
                                <th>Fecha compra</th>
                                <th>Proveedor</th>
                                <th>Producto</th>
                                <th>N&uacutemero de licencia</th>
                                <th>Solicitante</th>
                                <th>Fecha de instalaci&oacuten</th>
                                <th>Correo de contacto</th>
                                <th>Telefono de contacto</th>
                                <th>Observaciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>

                    </table>
                </div>
            </div>
            <p>
                <a href="{{ route('home') }}" class="btn btn-primary">
                    < Regresar</a>
            </p>
        </div>

        @section('js')
            @include('layouts.scripts')
            <script type="text/javascript">
                var data = @json($licencias);

                $(document).ready(function() {
                    $('#example').DataTable({
                        "data": data,
                        "pageLength": 100,
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
        @endsection
    @else
        Acceso No válido
    @endif
@endsection
