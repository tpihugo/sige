@extends('adminlte::page')
@section('title', 'Inventario Express')

@section('css')
    @include('layouts.head_2')
@stop
@section('content')
    <div class="container">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>
                </div>
            @endif

            <div class="row">
                <h1 class="text-center">Inventario Detalle</h1>
                <hr>
            </div>
            <br>

            <div class="container-fluid">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="text-muted">Gráficas</h2>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="app-card app-card-stats-table h-10 shadow-sm">
                                    <div class="app-card-header p-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <h4 class="app-card-title">Lista de dispositivos</h4>
                                            </div>
                                            <!--//col-->
                                        </div>
                                        <!--//row-->
                                    </div>
                                    <!--//app-card-header-->
                                    <div class="app-card-body p-3 p-lg-4">
                                        <div>
                                            <h4>Total de Equipos {{ $totales['total'] }}</h4>
                                        </div>
                                        <div class="table{{-- -responsive --}}">
                                            <table class="table table-borderless mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="meta">Dispositivos</th>
                                                        <th class="meta stat-cell">Cantidad</th>
                                                        <th class="meta stat-cell">Porcentaje del total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>


                                                    <tr>
                                                        <td><span>Localizados SICI</span></td>
                                                        <td class="stat-cell">

                                                            {{ $totales['Si'] - $totales['total_inventario'] }}
                                                        </td>
                                                        <td>
                                                            <?php echo $Percentage_SICI = round(($totales['Si'] * 100) / $totales['total'], 2); ?>%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>No Localizados SICI</span></td>
                                                        <td class="stat-cell">
                                                            {{ $totales['No'] - $totales['total_inventario'] }}
                                                        </td>
                                                        <td>
                                                            <?php echo $Percentage_SICI = round(($totales['No'] * 100) / $totales['total'], 2); ?>%
                                                        </td>
                                                    </tr>
                                                    @foreach ($totales as $item => $llave)
                                                        @if ($item != 'Si' && $item != 'No' && $item != 'total' && $item != 'total_inventario')
                                                            <tr>
                                                                <td><span>{{ $item }}</span></td>
                                                                <td class="stat-cell">
                                                                    {{ $llave - $totales['total_inventario'] }}
                                                                </td>
                                                                <td>
                                                                    <?php echo $Percentage_SICI = round(($llave * 100) / $totales['total'], 2); ?>%
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach

                                                    <tr>
                                                        <td><span>Revision inventario</span></td>
                                                        <td class="stat-cell">{{ $totales['total_inventario'] }}</td>
                                                        <td class="stat-cell">
                                                            <p class="text-center">{{-- --}} </p>
                                                        </td>

                                                        <td>
                                                            <p class="text-center">{{-- --}} </p>
                                                        </td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                        <!--//table-responsive-->
                                    </div>
                                    <!--//app-card-body-->
                                </div>
                                <!--//app-card-->
                            </div>


                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="app-card app-card-chart h-100 shadow-sm">
                                    <div class="app-card-header p-3 border-0">
                                        <p class="app-card-title text-center">Equipos localizados</p>
                                    </div>
                                    <!--//app-card-header-->
                                    <div class="app-card-body p-5">
                                        <div class="chart-container">
                                            <canvas id="chart-pie"></canvas>
                                        </div>
                                    </div>
                                    <!--//app-card-body-->
                                </div>
                                <!--//app-card-->
                            </div>
                            <!--//col-->


                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="app-card app-card-chart h-100 shadow-sm">
                                    <div class="app-card-header p-3 border-0">
                                        <p class="app-card-title text-center">Avance general</p>
                                    </div>
                                    <!--//app-card-header-->
                                    <div class="app-card-body p-5">
                                        <div class="chart-container">
                                            <canvas id="chart-pie2" width="50" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--//col-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Núm.</th>
                                        <th class="text-center">Área</th>
                                        <th>Progreso</th>
                                        <th> Avances <a href="#Help_info" class="text-reset" data-toggle="modal"> <strong> ?
                                                </strong> </a> </th>

                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php($cont = 1)

                                    @foreach ($areas as $oneRow => $llave)
                                        @php($bar_indicatorColor = 'success')
                                        @if ($llave->porcentaje < '50.00')
                                            @php($bar_indicatorColor = 'danger')
                                        @elseif($llave->porcentaje < '90.00')
                                            @php($bar_indicatorColor = 'warning')
                                        @endif

                                        <tr>
                                            <td>{{ $cont++ }}</td>
                                            <td>

                                                <p class="font-weight-normal">{{ $llave->area }}</p>

                                            </td>
                                            <td style="width: 20%">

                                                <div class="container-fluid wd-200">
                                                    <div class="row no-gutters align-items-center">


                                                        <div class="h6 mb-0 mr-1 text-center text-gray-800">
                                                            <strong>{{ $llave->porcentaje }}%</strong>
                                                        </div>

                                                        <div class="col">
                                                            <div class="progress progress-sm mr-2">
                                                                <div class="progress-bar bg-<?php echo $bar_indicatorColor; ?>"
                                                                    role="progressbar"
                                                                    style="width: {{ $llave->porcentaje }}%"
                                                                    aria-valuenow="50" aria-valuemin="0"
                                                                    aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <td style="width: 10%">
                                                <p class="text-dark text-center">
                                                    {{ $llave->inventario }} / {{ $llave->equipos }}
                                                    @if ($llave->inventario - $llave->equipos > 0)
                                                        <a class="text-muted" data-toggle="modal"
                                                            href="#warning-triangle-modal">
                                                            {{-- <i class="fas fa-exclamation-triangle" style="color: orange;" ></i> --}}
                                                        </a>
                                                    @endif
                                                </p>
                                            </td>

                                            </td>
                                            <td>
                                                <p><a href="{{ route('inventario-por-area', $llave->id_area) }}"
                                                        class="btn btn-primary">Detalle</a></p>

                                                {{-- <p><a href="{{ route('actualizacion-inventario', $OneDataRow->id_area) }}" class="btn btn-success">Revisado</a></p> --}}
                                            </td>
                                        </tr>
                                        {{-- @endif --}}
                                    @endforeach


                                </tbody>

                                {{-- Modal equipos invenriables vs localizados  --}}
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
                                                                    <p class="text-muted text-center"> Cantidad de equipos
                                                                        localizados</p>
                                                                </div>
                                                                <div class="col-sm">
                                                                    <p class="text-muted text-center"> Cantidad de equipos
                                                                        inventariables </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Ok</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                {{-- Modal incongruencia de equipos inventariables vs localizados por area --}}
                                <div class="modal fade" id="warning-triangle-modal" tabindex="-1" role="dialog"
                                    aria-labelledby="warning-triangle-modal" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="warning-triangle-modal">Equipos</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="h4 text-justify">En esta área existen equipos
                                                    <strong>localizados</strong> de otras areas
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info"
                                                    data-dismiss="modal">Ok</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </table>
                        </div>

                    </div>
                </div>
            @else
                El periodo de Registro de Proyectos a terminado
        @endif
    </div>
@endsection

@section('footer')
    <h5 class="text-end">Coordinación de Tecnologías para el Aprendizaje. CUCSH</h5>
@endsection

@section('js')
    @include('layouts.scrtips')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "pageLength": 50,
                "order": [
                    [1, "desc"]
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
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#js-example-basic-single').select2();
        });

        const total_sici_localizados = {!! json_encode($totales['Si']) !!};
        const total_22B_detalleInventario = {!! json_encode($totales['total_inventario']) !!};


        const ctx = document.getElementById('chart-pie').getContext('2d');
        const ctx2 = document.getElementById('chart-pie2').getContext('2d');

        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['localizados SICI CTA', 'localizados detalle inventario 22B'],
                datasets: [{
                    // label: '# of Votes',
                    data: [total_sici_localizados, total_22B_detalleInventario],
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

        const total_equipos = {!! json_encode($totales['total']) !!};

        const myChart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Total equipos', 'localizados detalle inventario 23A'],
                datasets: [{
                    // label: '# of Votes',
                    data: [total_equipos, total_22B_detalleInventario],
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
@endsection
