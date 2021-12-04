<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Listado de Tutores</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
</head>
<body>
@if(Auth::user()->role == 'admin')
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Sistema de Administración de Tutorías
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Acceder</a></li>
                        <li><a href="{{ route('register') }}">Registrarse</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>

                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>


</div>
<div class="container">
    <div class="row">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
            <p>
                <a href="{{ route('home') }}" class="btn btn-primary">< Regresar</a>
            </p>
        <hr>
        <h2>Gestión de Tutores</h2>
            <br>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Semblanza</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>

        @foreach($listaTutores as $listaTutor)
            <tr>
                <td>{{$listaTutor->id}}</td>
                <td>{{$listaTutor->apellidos}}</td>
                <td>{{$listaTutor->nombre}}</td>
                <td>{{$listaTutor->correo}}</td>
                <td>{{$listaTutor->semblanza}}</td>
                <td><a href="{{ route('editarTutor', ['tutor_id' => $listaTutor->id]) }}" class="btn btn-success">Editar</a>

                <td>
                <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                    <a href="#eliminar{{$listaTutor->id}}" role="button" class="btn btn-danger" data-toggle="modal">Eliminar</a>

                    <!-- Modal / Ventana / Overlay en HTML -->
                    <div id="eliminar{{$listaTutor->id}}" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><h4>X</h4></button>

                                </div>
                                <div class="modal-body">
                                    <h3>¿Seguro de Eliminar a este Tutor?</h3>
                                    <h3 class="text-warning"><small>{{$listaTutor->apellidos}} {{$listaTutor->nombre}}</small></h3>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    {{--{{ route('delete-alumno',['alumno_id' => $listaTutor->id]) }} --}}
                                    <a href="{{ route('deleteTutor',['tutor_id' => $listaTutor->id]) }}" type="button" class="btn btn-danger">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>

    </div>
    <p>
            <a href="{{ route('home') }}" class="btn btn-primary">< Regresar</a>
    </p>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
    jQuery.extend( jQuery.fn.dataTableExt.oSort, {
        "portugues-pre": function ( data ) {
            var a = 'a';
            var e = 'e';
            var i = 'i';
            var o = 'o';
            var u = 'u';
            var c = 'c';
            var special_letters = {
                "Á": a, "á": a, "Ã": a, "ã": a, "À": a, "à": a,
                "É": e, "é": e, "Ê": e, "ê": e,
                "Í": i, "í": i, "Î": i, "î": i,
                "Ó": o, "ó": o, "Õ": o, "õ": o, "Ô": o, "ô": o,
                "Ú": u, "ú": u, "Ü": u, "ü": u,
                "ç": c, "Ç": c
            };
            for (var val in special_letters)
                data = data.split(val).join(special_letters[val]).toLowerCase();
            return data;
        },
        "portugues-asc": function ( a, b ) {
            return ((a < b) ? -1 : ((a > b) ? 1 : 0));
        },
        "portugues-desc": function ( a, b ) {
            return ((a < b) ? 1 : ((a > b) ? -1 : 0));
        }
    } );
    $(document).ready(function() {
        $('#example').DataTable( {
            "columnDefs": [{ type: 'portugues', targets: "_all" }],
            "order": [[ 1, "asc" ]],
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
    Acceso No válido
@endif
</body>
</html>
