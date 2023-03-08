<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de préstamo {{$cargo}}</title>
  
<!-- Funcion del diagrama cargos-->
    <script src="{{ asset('js/Chart.js') }}"></script>
<!-- Funcion de la tabla-->
   <script src="vendor/jquery/jquery.min.js"></script>
<!-- Funcion del model--> 
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
   integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>


</head>
<body> 
     @extends('layouts.app')
     
    <div class="container-fluid">
<br><br><br><br>

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
     
        <!-- Content Row -->
    
      

        <h1 class="h3 mb-2 text-gray-800">Reporte de préstamo {{$cargo}}</h1>
    
              <div class="container-fluid">

                <!-- Page Heading -->
              
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="reportes" class="table table-striped table-bordered" >
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>Solicitante</th>
                                        <th>Carrera</th>
                                        <th>&Aacuterea</th>
                                        <th>Contacto</th>
                                        <th>Fecha</th>
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            
                            </table>
                        </div>
                    </div>
                </div>

            </div>

   
</body>
</html>


<script type="text/javascript">
    var dataReporte = @json($reporte);


    $(document).ready(function() {
        $('#reportes').DataTable({
            "data": dataReporte,
            "pageLength": 20,
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
