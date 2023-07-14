@extends('layouts.app')

@section('content')
    @if (Auth::check() &&
            (Auth::user()->role == 'admin' ||
                Auth::user()->role == 'cta' ||
                Auth::user()->role == 'auxiliar' ||
                Auth::user()->role == 'redes'))
        <div class="container-fluid">

            {{-- dd($prestamos) --}}

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <h2>Pr&eacute;stamos de Equipos</h2>
            <br>
            <p align="right">
              
                <a href="{{ route('fechas_prestamos') }}" class="btn btn-info">
                       Préstamos Vencidos</a>
                <a style="color: white" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                Reportes</a>

                <p><a href="{{ route('imprimirPasosDevolucion')}}" class="btn btn-info">Pasos para devolución de equipo</a></p>

            </p>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Folio</th>
                        <th>Solicitante</th>
                        <th>Cargo</th>
                        <th>&Aacuterea</th>
                        <th>Contacto</th>
                        <th>Estatus</th>
                        <th>Equipos</th>
                        <th>Fecha</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    

                </tbody>

            </table>
            <p>
                <a href="{{ route('home') }}" class="btn btn-primary">
                    < Regresar</a>
            </p>

            
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/v/dt/dt-1.13.5/datatables.min.js"></script>
        <script type="text/javascript">
            var data = @json($prestamos);

            $(document).ready(function() {
                $('#example').DataTable({
                    "data": data,
                    "pageLength": 50,
                    "order": [
                        [0, "desc"]
                    ],
                    "language": {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ning n dato disponible en esta tabla",
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
                            "sLast": " ltimo",
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
                        " ": a,
                        " ": a,
                        " ": a,
                        " ": a,
                        " ": a,
                        " ": a,
                        " ": e,
                        " ": e,
                        " ": e,
                        " ": e,
                        " ": i,
                        " ": i,
                        " ": i,
                        " ": i,
                        " ": o,
                        " ": o,
                        " ": o,
                        " ": o,
                        " ": o,
                        " ": o,
                        " ": u,
                        " ": u,
                        " ": u,
                        " ": u,
                        " ": c,
                        " ": c
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
    @else
        Acceso No valido
    @endif
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel_2" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Equipos</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="data"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="historial">

                            </table>
                        </div>
                        

                        <div class="row">
                            <div class="col-sm-12">
                                <div id="contenedor"></div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <button type="button" class="btn grey btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal_Alumno" tabindex="-1" aria-labelledby="exampleModal_Alumno"  aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title">Reporte Alumno</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">

                        <table id="reporteAlumno" class="table table-striped table-bordered" >
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Solicitante</th>
                                    <th>Carrera</th>
                                    <th>&Aacuterea</th>
                                    <th>Contacto</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        
                        </table>




                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <button type="button" class="btn grey btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Reportes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <center>            
                <a style="color: white; margin-right: 20px"  href="{{ route('ReporteAlumno') }}"  class="btn btn-success">
                Reporte Alumno</a>

                <a  href="{{ route('ReporteAdministracion') }}" style="color: white"  class="btn btn-info">
                    Reporte Administrativo</a>
                </center>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


    <script>
        function logKey(params) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            console.log(params);
            var url = "{{ route('BuscadorEquipos', ':id') }}";
            url = url.replace(':id', params);
            $.ajax({
                url: url,
                method: 'POST',
                data: params
            }).done(function(data) {
                $('#contenedor').html(data);
                console.log(data);
            });

        }
    </script>

@endsection
