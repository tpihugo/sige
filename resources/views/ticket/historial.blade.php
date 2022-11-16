@extends('adminlte::page')
@section('title', 'Estadísticas tickets |')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h2>Estadísticas de tickets</h2>
        </div>
        
        {{--{{dd($months)}}--}}
        <div class="col-md-6">
            <div class="card card-info w-100">
                <div class="card-header">
                    <h2 class="card-title">Histórico de tickets</h2>
                </div>
                <div class="card-body">
                    <h3>Tickets por mes</h3>
                    <div class="chart">
                        <canvas id="myChart"></canvas>
                        {{--<canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>--}}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-info w-100">
                <div class="card-header">
                    <h3 class="card-title">Técnicos</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                            <i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <h4>Tickets por tecnico </h4>
                    <div class="chart">
                        <canvas id="myChartTecnicals"></canvas>
                        {{--<canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>--}}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <div class="row">
        {{--{{dd($issues)}}--}}
        <div>
        </div>
        <div class="col-md-7">
            <div class="card card-info">
                <div class="card-header">
                    <h2 class="card-title">Tickets por fallas</h2>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                            <i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <h4>Tickets por tipo de falla reportada</h4>
                    <div class="chart">
                        <canvas id="myChartIssue" style="min-height: 250px; height: 250px; max-height: 300px; max-width: 100%;"></canvas>
                        {{--<canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>--}}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-5">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Tickets por categoría</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                            <i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body  w-100">
                    <h4>Tickets solicitados por tipo de categoría</h4>
                    <div class="chart" >
                        <canvas id="myChartCategories"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@stop
@section('plugins.Chartjs', true)
@section('js')
    <script>
        const labels = JSON.parse('{!! json_encode($months) !!}');
        const quantity = JSON.parse( '{!! json_encode($monthCount) !!}' );

        const data = {
            labels: labels,
            datasets: [{
                label: 'Tickets',
                backgroundColor: 'rgba(6,101,178,0.72)',
                borderColor: 'rgb(6,101,178)',
                data: quantity,
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        }


        const config = {
            type: 'bar',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

        const labelsTecnical = JSON.parse('{!! json_encode($tecnical) !!}');
        const quantityTecnical = JSON.parse( '{!! json_encode($countTickets) !!}' );
        const dataTecnical = {
            labels: labelsTecnical,
            datasets: [{
                label: 'Tecnicos',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: quantityTecnical,
                borderWidth: 2,
                borderRadius: 5,
                borderSkipped: false,
            }]
        };
        const configTecnicals = {
            type: 'line',
            data: dataTecnical,
            options: {}
        };

        const myChartTecnical = new Chart(
            document.getElementById('myChartTecnicals'),
            configTecnicals
        );

        const labelsIssue = JSON.parse('{!! json_encode($issues) !!}');
        const quantityIssue = JSON.parse( '{!! json_encode($idTickets) !!}' );
        const dataIssue = {
            labels: labelsIssue,
            datasets: [{
                label: 'Fallas',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: quantityIssue,
                borderWidth: 2,
                borderRadius: 5,
                borderSkipped: false,
            }]
        };
        const configIssue = {
            type: 'line',
            data: dataIssue,
            options: {}
        };

        const myChartIssue = new Chart(
            document.getElementById('myChartIssue'),
            configIssue
        );

        const labelsCategory = JSON.parse('{!! json_encode($categories) !!}');
        const quantityCategory = JSON.parse( '{!! json_encode($ticketsC) !!}' );
        const dataCategory = {
            labels: labelsCategory,
            datasets: [{
                label: 'Categorías',
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 2,
                /*borderColor: 'rgb(255,255,255)',*/
                data: quantityCategory,
            }]
        };
        const configCategory = {
            type: 'doughnut',
            data: dataCategory,
            options: {}
        };

        const myChartCategory = new Chart(
            document.getElementById('myChartCategories'),
            configCategory
        );
    </script>
@stop
