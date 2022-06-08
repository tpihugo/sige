<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php if(Auth::check()): ?>
            <?php if(session('message')): ?>
                <div class="alert alert-success">
                    <h2><?php echo e(session('message')); ?></h2>

                </div>
            <?php endif; ?>
            <div class="row">
            <h1 class="text-center">Inventario Detalle por Ciclo 2022A</h1>
                <hr>
            </div>
            <br>

        <div class="container-fluid">
            <div class="row">
            <h2 class="text-muted">Gráficas</h2>
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
                            <div class="table">
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
                                            <td class="stat-cell"><?php echo e($total_equipos); ?></td>
                                            <td class="stat-cell">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                </svg>
                                    <?php echo e(($total_equipos - $total_SICI_localizados)); ?>

                                            </td>

                                            <td>
                                                <?php echo $Percentage_SICI = round(
                                                    100 -
                                                        (($total_equipos -
                                                            $total_SICI_localizados) /
                                                            $total_equipos) *
                                                            100,
                                                    2
                                                ); ?>%
                                            </td>
                                        </tr>

                                        <tr>


                                        <tr>
                                            <td><a href="#">Localizados SICI</a></td>
                                            <td class="stat-cell"><?php echo e($total_SICI_localizados); ?></td>
                                            <td class="stat-cell">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                </svg>
                                <?php echo e(($total_SICI_localizados - $total_22A_detalleInventario)); ?>

                                            </td>

                                            <td>
                                            <?php echo $Percentage_SICI = round(
                                                100 -
                                                    (($total_SICI_localizados -
                                                        $total_22A_detalleInventario) /
                                                        $total_SICI_localizados) *
                                                        100,
                                                2
                                            ); ?>%
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><a href="#">Revision inventario 2022A</a></td>
                                            <td class="stat-cell"><?php echo e($total_22A_detalleInventario); ?></td>
                                            <td class="stat-cell">
                                            <p class="text-center"> </p>
                                            </td>

                                            <td>
                                                <p class="text-center"> </p>
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
						        <p class="app-card-title text-center">Equipos localizados</p>
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
                            <p class="app-card-title text-center">Avance general</p>
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
                        <th class="text-center">Área</th>
                        <th>Progreso</th>
                        <th> Avances <a href="#Help_info" class="text-reset" data-toggle="modal"> <strong> ? </strong> </a> </th>

                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php ( $cont=1 ); ?>

                    <?php $__currentLoopData = $DtQuery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oneRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    
                    
                        <?php ( $bar_indicatorColor = "success" ); ?>
                        <?php if( $oneRow['Porcentaje'] < '50.00' ): ?>
                            <?php ( $bar_indicatorColor = "danger"); ?>
                        <?php elseif( $oneRow['Porcentaje'] < '90.00' ): ?>
                            <?php ( $bar_indicatorColor= "warning"); ?>
                        <?php endif; ?>

                        <tr>
                            <td><?php echo e($cont++); ?></td>
                            <td>

                            <p class="font-weight-normal"><?php echo e($oneRow['area']); ?></p>

                            </td>
                            <td style="width: 20%">

                                <div class="container-fluid wd-200">
                                        <div class="row no-gutters align-items-center">


                                            <div class="h6 mb-0 mr-1 text-center text-gray-800"> <strong><?php echo e($oneRow['Porcentaje']); ?>%</strong> </div>

                                            <div class="col">
                                                <div class="progress progress-sm mr-2">
                                                    <div class="progress-bar bg-<?php echo $bar_indicatorColor; ?>" role="progressbar"
                                                        style="width: <?php echo e($oneRow['Porcentaje']); ?>%" aria-valuenow="50" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            <td style="width: 10%">
                                <p class="text-dark text-center"><?php echo e($oneRow['iv_count']); ?> / <?php echo e($oneRow['equipos_count']); ?> </p>
                            </td>

                            </td>
                            <td>
                            <p><a href="<?php echo e(route('inventario-por-area', $oneRow['eq_id_area'] )); ?>" class="btn btn-primary">Detalle</a></p>

                                
                            </td>
                        </tr>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    </tbody>

                    <div id="Help_info" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="" method="POST">
                                            <div class="modal-body">
                                                <h4>Info</h4>
                                                <div class="row g-3 align-items-center">
                                                    <div class="col-md-12">
                                                    <p class="text-dark text-center">Valor 1 / Valor 2 </p>
                                                    </div>

                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-sm">
                                                                <p class="text-muted text-center"> Cantidad de equipos localizados</p>
                                                            </div>
                                                            <div class="col-sm">
                                                                <p class="text-muted text-center"> Cantidad de equipos inventariables </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>



                </table>
            </div>

            <p>
                <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">< Regresar</a>
            </p>

            <br>
            <div class="row g-3 align-items-center">

                <br>
                <hr>
                <h5>Coordinación de Tecnologías para el Aprendizaje. CUCSH</h5>


            </div>
        </div>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>


    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script ript type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.js" integrity="sha512-CWVDkca3f3uAWgDNVzW+W4XJbiC3CH84P2aWZXj+DqI6PNbTzXbl1dIzEHeNJpYSn4B6U8miSZb/hCws7FnUZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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


    <script type="text/javascript">

        $(document).ready(function() {
            $('#js-example-basic-single').select2();
        });

        const total_sici_localizados = <?php echo json_encode($total_SICI_localizados); ?>;
        const total_22A_detalleInventario = <?php echo json_encode($total_22A_detalleInventario); ?>;


        const ctx = document.getElementById('chart-pie').getContext('2d');
        const ctx2 = document.getElementById('chart-pie2').getContext('2d');

        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['localizados SICI CTA', 'localizados detalle inventario 22A'],
                datasets: [{
                    // label: '# of Votes',
                    data: [total_sici_localizados, total_22A_detalleInventario],
                    backgroundColor: [
                        'rgb(240,173,78)',
                        'rgb(92,184,92)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
        });

        const total_equipos = <?php echo json_encode($total_equipos); ?>;

        const myChart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Total equipos', 'localizados detalle inventario 22A'],
                datasets: [{
                    // label: '# of Votes',
                    data: [total_equipos, total_22A_detalleInventario],
                    backgroundColor: [
                        'rgb(240,173,78)',
                        'rgb(92,184,92)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
        });

    </script>



    <?php else: ?>
        El periodo de Registro de Proyectos a terminado
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/mamp/htdocs/sige/resources/views/inventario/inventario_express2.blade.php ENDPATH**/ ?>