<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fechas</title>
  
<!-- Funcion del diagrama cargos-->
    <script src="{{ asset('js/Chart.js') }}"></script>
<!-- Funcion de la tabla-->
   <script src="vendor/jquery/jquery.min.js"></script>
<!-- Funcion del model--> 
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
   integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>


</head>
<body onload="grafica_prestamo('2020')"> 
     @extends('layouts.app')
     
    <div class="container-fluid">
<br><br><br><br>

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
     
        <!-- Content Row -->
    
      

        <h1 class="h3 mb-2 text-gray-800">PRÉSTAMOS FUERA DE TIEMPO</h1>


            <div class="row">
    
                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Préstamos por año activos</h6>
              
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                              <div style="display: inline-flex; position: absolute; margin: -2% 10% 0 5%;">
                                @for ($i = 2020; $i <=$fechaHoy; $i++)   
                                    <a class="dropdown-item" onclick="grafica_prestamo({{$i}})" href="#">{{$i}}</a>        
                                    @endfor
                              </div>
                                      <div style="width: 100%; height: 100%" id="conect"></div>               
                              </div>
                            </div>
                        </div>


                        
                    </div>
                



                  
     
            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Solicitadores de préstamos (cargos)</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Alumno
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Administrativo
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> Acedemico
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-warning"></i> Otro
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
              

                  
              </div>
    
              <div class="container-fluid">

                <!-- Page Heading -->
              
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tablaFechas" width="100%" cellspacing="0">
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
                            </table>
                        </div>
                    </div>
                </div>

            </div>

   
</body>
</html>

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
                            <div id="contenedor_2"></div>
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
                $('#contenedor_2').html(data);
                console.log(data);
            });

            }
</script>



<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Alumno", "Administrativo", "Acedémico", "Otro"],
    datasets: [{
      data: [{{$cargo_Alumno}}, {{$cargo_Administracion}}, {{$cargo_Academico}}, {{$calculo_Otro}}],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

</script>


<script>      
// Area Chart Example
    function grafica_prestamo(params) {
       /*  let data2 = []; */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.log(params);
        var url = "{{ route('Fechas_diagrama', ':id') }}";
        url = url.replace(':id', params);
        $.ajax({
            url: url,
            method: 'POST',
            data: params
        }).done(function(data) {
           
            $('#conect').html(data);
            console.log(data);
          
    });
        
    }
    </script>


<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Alumno", "Administrativo", "Acedémico", "Otro"],
    datasets: [{
      data: [{{$cargo_Alumno}}, {{$cargo_Administracion}}, {{$cargo_Academico}}, {{$calculo_Otro}}],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

</script>


<script type="text/javascript">

    var data = @json($expirados);

    $(document).ready(function() {
        $('#tablaFechas').DataTable({
            "data": data,
            "pageLength": 10,
            "order": [
                [0, "desc"]
            ],
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningun dato disponible en esta tabla",
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

</script>
