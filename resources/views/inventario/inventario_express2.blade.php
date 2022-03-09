@extends('layouts.app')
@section('content')
    <div class="container">
        @if(Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>

                </div>
            @endif
            <div class="row">
            <h1 class="text-center">Inventario Detalle por ciclo 2022A</h1>
                <hr>
            </div>
            <br>

        <div class="container-fluid">
            <div class="row">
            <h2 class="text-muted">Graficas</h2>
            <div class="col-6 col-lg-6">
                    <div class="app-card app-card-stats-table h-10 shadow-sm">
                        <div class="app-card-header p-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <h4 class="app-card-title">Lista de dispositivos</h4>
                                </div><!--//col-->
                                <div class="col-auto">
                                    <div class="card-header-action">
                                        <a href="#">...</a>
                                    </div><!--//card-header-actions-->
                                </div><!--//col-->
                            </div><!--//row-->
                        </div><!--//app-card-header-->
                        <div class="app-card-body p-3 p-lg-4">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th class="meta">Dispositivos</th>
                                            <th class="meta stat-cell">Total</th>
                                            <th class="meta stat-cell">Falta</th>
                                            <th class="meta stat-cell">Porcentaje</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td><a href="#">Total equipos</a></td>
                                            <td class="stat-cell">{{$total_equipos}}</td>
                                            <td class="stat-cell">
                                            <p class="text-center">-</p>
                                            </td>

                                            <td>
                                                <p class="text-center">-</p>
                                            </td>
                                        </tr>
                                        <tr>


                                        <tr>
                                            <td><a href="#">SICI</a></td>
                                            <td class="stat-cell">{{$total_SICI}}</td>
                                            <td class="stat-cell">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                </svg>
                                {{$total_SICI_falta}}
                                            </td>

                                            <td>
                                            <?php echo $Percentage_SICI = round((($total_SICI_falta / $total_SICI) * 100));?>%
                                            </td>
                                        </tr>
                                        <tr>
                                        <td><a href="#">Detalle inventario </a></td>
                                            <td class="stat-cell">{{$total_detalleInventario}}</td>
                                            <td class="stat-cell">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                </svg>
                                                0 <!-- ?? -->
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                    </div>


                    <div class="col-4 col-lg-3">		        
				        <div class="app-card app-card-chart h-100 shadow-sm">
					        <div class="app-card-header p-3 border-0">
						        <p class="app-card-title text-center">Diagrama de pastel</p>
					        </div><!--//app-card-header-->
					        <div class="app-card-body p-12">					   
						        <div class="chart-container">
				                    <canvas id="chart-pie"  ></canvas>
						        </div>
					        </div><!--//app-card-body-->
				        </div><!--//app-card-->
		            </div><!--//col-->

                    
                    <div class="col-4 col-lg-3">		        
				        <div class="app-card app-card-chart h-100 shadow-sm">
					        <div class="app-card-header p-3 border-0">
                            <p class="app-card-title text-center">Diagrama de pastel</p>
					        </div><!--//app-card-header-->
					        <div class="app-card-body p-12">					   
						        <div class="chart-container">
				                    <canvas id="chart-pie2" width="50" height="50" ></canvas>
						        </div>
					        </div>
				        </div>
		            </div><!--//col-->
                    

                    <!-- <hr> -->

            <div class="row">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Núm.</th>
                        <th>Numero de objetos inventariables o SISI.</th>
                        <th class="text-center">Area</th>
                        <th>Progreso</th>
                        <th>Valores</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $cont=1; ?>

                    <?php $bar_indicatorColor="success"; ?>
                    @foreach($dataTable as $OneDataRow)

                    <?php $ToRoundedValue = round((($OneDataRow->cuentaEncontrados / $OneDataRow->cuentaInventariables) * 100));?>
                    @if( $ToRoundedValue < '100')

                        @if( $ToRoundedValue < '50' )
                            @php ( $bar_indicatorColor= "danger")
                        @elseif( $ToRoundedValue < '90' )
                            @php ( $bar_indicatorColor= "warning")
                        @else
                        @php ( $bar_indicatorColor= "success")

                        @endif

                        <tr>
                            <td>{{$cont++}}</td>
                            <td>
                                {{ $OneDataRow->cuentaInventariables }}
                            </td>
                            <td>
                                
                            <p class="font-weight-normal">{{ $OneDataRow->area }}</p>                            
                            
                            </td>
                            <td style="width: 20%">

                                <div class="container-fluid wd-200">
                                        <div class="row no-gutters align-items-center">
                                            
                                            <p><small><strong> Localizados </strong></small></p>
                                            <div class="h6 mb-0 mr-1 text-center text-gray-800"> <strong>{{$ToRoundedValue}}% </strong> </div>
                                            
                                            <div class="col">
                                                <div class="progress progress-sm mr-2">
                                                    <div class="progress-bar bg-<?php echo $bar_indicatorColor ?>" role="progressbar"
                                                        style="width: {{$ToRoundedValue}}%" aria-valuenow="50" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            
                            <td style="width: 10%">

                            <p class="text-dark text-center">{{$OneDataRow->cuentaEncontrados}} / {{$OneDataRow->cuentaInventariables}} </p>
                                

                            </td>
                                
                            </td>
                            <td>
                                <p><a href="{{ route('inventario-por-area', $OneDataRow->id_area ) }}" class="btn btn-primary">Detalle</a></p>
                                <p><a href="{{ route('actualizacion-inventario', $OneDataRow->id_area) }}" class="btn btn-success">Revisado</a></p>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                
                    
                    </tbody>
                </table>
            </div>

            <p>
                <a href="{{ route('home') }}" class="btn btn-primary">< Regresar</a>
            </p>

            <br>
            <div class="row g-3 align-items-center">

                <br>
                <hr>
                <h5>Coordinación de Tecnologías para el Aprendizaje. CUCSH</h5>


            </div>
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

    </script>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.js" integrity="sha512-CWVDkca3f3uAWgDNVzW+W4XJbiC3CH84P2aWZXj+DqI6PNbTzXbl1dIzEHeNJpYSn4B6U8miSZb/hCws7FnUZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            $('#js-example-basic-single').select2();
        });

        const js_total_sici = {!! json_encode($total_SICI) !!};
        const js_total_sici_falta = {!! json_encode($total_SICI_falta) !!};

        const ctx = document.getElementById('chart-pie').getContext('2d');
        const ctx2 = document.getElementById('chart-pie2').getContext('2d');

        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Total localizados SICI CTA', 'Total localizados inventario detalle'],
                datasets: [{
                    // label: '# of Votes',
                    data: [js_total_sici, js_total_sici_falta],
                    backgroundColor: [
                        'rgb(92,184,92)',
                        'rgb(240,173,78)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
        });

        const myChart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['SICI Total', 'SICI faltantes'],
                datasets: [{
                    // label: '# of Votes',
                    data: [js_total_sici, js_total_sici_falta],
                    backgroundColor: [
                        'rgb(92,184,92)',
                        'rgb(240,173,78)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
        });

        // const myChart2 = new Chart(ctx2, {
        //     type: 'bar',
        //     data: {
        //         labels: ['SICI total','SICI faltante'],
        //         datasets: [{
        //             label: 'SICI',
        //             data: [js_total_sici, js_total_sici_falta],
        //             barPercentage: 0.5,
        //             barThickness: 90,
        //             maxBarThickness: 100,
        //             minBarLength: 2,
        //             backgroundColor: [
        //                 'rgb(66, 186, 150)',
        //                 'rgb(255, 193, 7)',
        //                 // 'rgb(255, 0, 0)',
        //                 // 'rgba(255, 206, 86, 0.2)',
        //                 // 'rgba(153, 102, 255, 0.2)'
        //             ],
                    
        //             borderColor: [
        //                 'rgba(255, 99, 132, 1)',
        //                 'rgba(54, 162, 235, 1)',
        //                 // 'rgba(255, 206, 86, 1)',
        //                 // 'rgba(153, 102, 255, 1)'
        //             ],
        //             borderWidth: 1
        //         }]
        //     },
        //     options: {
        //         scales: {
        //             y: {
        //                 // beginAtZero: true                        
        //             }
        //         }
        //     }
        // });

    

    </script>

    @else
        El periodo de Registro de Proyectos a terminado
    @endif

@endsection
