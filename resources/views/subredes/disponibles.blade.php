@extends('layouts.app')
@section('content')
    <div class="container">
        @if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'cta' || Auth::user()->role == 'auxiliar' || Auth::user()->role == 'redes'))
            @if (session('message'))
                <div class="alert alert-success">
                    <p>{{ session('message') }}</p>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <h2><center><b>IP'S disponibles:</b> {{$num}}</center></h2>
                    <div class="row align-items-center m-0">
                            <div class="col-md-10">
                                <a href="{{ route('subredes.index') }}" class="btn btn-primary">Regresar</a>
                            </div>
                            <div class="col-md-2">
                            <a href="{{ route('ocupadas', $subred) }}" type="button" class="btn btn-info">Ocupadas</a>
                            </div>
                        </div>
                </div>
                <div class="col-md-12">
                </div>
                <br>
                <hr>
            </div>
            <div class="row">
                <div class="col-12">
                        <div class="col">
                            {!! csrf_field() !!}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                </div>
                <div class="card-body">
                       <div  class="table-responsive">
                           <table id="tabla" class="table table-bordered table-hover table-striped">
                               <thead>
                               <tr>
                                    <th><center>N°</center></th>
                                   <th><center>IP</center></th>
                                   <th><center>Equipo</center></th>
                                   <th><center>Acciones</center></th>
                               </tr>
                               </thead>
                               <tbody>
                                <?php $contador=0; ?>
                               @foreach( $Ips as $ip )
                                   <tr>
                                    <td> <?php echo $contador= $contador +1;?></td>
                                       <td><center>{{$ip->ip}}</center></td>
                                       <td><center>Sin información</center></td>
                                       <td>
                                           <center>
                                               <div class="btn-group" role="group" aria-label="Basic example">
                                                   <a href="{{ route('ips.edit', $ip->id) }}" class="btn btn-success btn-sm" title="Asignar equipo">Asignar</a>
                                                   <a href="{{ route('delete_ip',$ip->id) }}" class="btn btn-danger btn-sm"title="Borrar IP de la lista">Eliminar</a>
                                               </div>
                                           </center>
                                       </td>
                                   </tr>
                               @endforeach
                               </tbody>
                           </table>
                       </div>


            <div class="row align-items-center">
                <div class="col-md-12">
                    <center>
                        <h5>En caso de inconsistencias, favor de reportarlas.</h5>
                    </center>
                </div>
                <hr>
            </div>
    </div>
    @else
        El periodo de Registro de Proyectos a terminado
    @endif
     @extends('layouts.loader')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.js"></script>

        <script type="text/javascript">


            $(document).ready(function() {
                $('#tabla').DataTable({

                    "pageLength": 10,
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
            //"columnDefs": [{ type: 'portugues', targets: "_all" }],
        </script>
@endsection
