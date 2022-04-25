
@extends('layouts.app')
@section('content')


    <div class="container">
        @if(Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h4>{{ session('message') }}</h4>

                </div>
            @endif

            <div class="row">
                <h2>Bienvenido: {{$user}}</h2>
                <br>
               <script type="text/javascript">

                    $(document).ready(function() {
                        $('#js-example-basic-single').select2();

                    });

                </script>

            </div>
        <div class="row">

                        <h3><p align="center">Llaves en uso:</p></h3>
                @if(isset($llaves_agregadas))
                <div class="row">
                    @foreach ($llaves_agregadas as $llave)

                        <div class="col-sm-4">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">ID: {{$llave->id}} - Área de Llave: {{$llave->area}}</h5>
                              <p class="card-text">Num de LLaves: {{$llave->num_copias}} <br> {{$llave->comentarios}}</p>
                                <a href="{{route('devolverllave', $llave->id)}}" class="btn btn-outline-warning">Devolver Llave</a>
                            </div>
                          </div>
                        </div>

                    @endforeach
                    @endif
                </div>

        </div>
        <h3>Llaves disponibles:</h3>
                @if(isset($llaves_disponibles))
                <div class="row">
                    @foreach ($llaves_disponibles as $llave)

                        <div class="col-sm-4">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">ID: {{$llave->id}} - Área de Llave: {{$llave->area}}</h5>
                              <p class="card-text">Num de LLaves: {{$llave->num_copias}} <br> {{$llave->comentarios}}</p>
                              <a href="{{route('seleccionarllave', $llave->id)}}" class="btn btn-outline-success">Agregar</a>
                            </div>
                          </div>
                        </div>

                    @endforeach
                </div>
                @endif

        <div class="row">
                <br>
                    <div class="row g-5 align-items-center">
                        <div class="col-md-6">
                            <a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>

                        </div>
                    </div>
                </div>

            <br>
            <div class="row g-5 align-items-center">

                <br>
                <h5>En caso de inconsistencias, favor de reportarlas a victor.ramirez@academicos.udg.mx</h5>
                <hr>

            </div>
    </div>
    
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>


    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>





    <script>


        $(document).ready(function() {
            $('#example').DataTable( {
                "pageLength": 100,
                "order": [[ 0, "asc" ]],
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
                        extend:'pdfHtml5',
                        orientation: 'landscape',
                        pageSize:'LETTER',
                    }

                ]
            } );
        } );
    </script>
    @else
        El periodo de Registro de Proyectos a terminado
    @endif


@endsection
