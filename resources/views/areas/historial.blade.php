@extends('adminlte::page')
@section('title', 'Estadísticas áreas |')
@section('content')
    {{--{{dd($placesIssues)}}--}}
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h2 class="card-title">Tickets por áreas</h2>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                            <i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <h4>Tickets relacionados con cada área</h4>
                    <div class="chart">
                        <canvas id="myChartArea" style="min-height: 250px; height: 250px; max-height: 450px; max-width: 100%;"></canvas>
                        {{--<canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>--}}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card card-info card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Tickets área administrativa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Tickets aulas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Tickets laboratorios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-area-tab" data-toggle="pill" href="#custom-tabs-one-areas" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Tickets Estatus</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            <h4>Tickets relacionados por tipo de fallas en área administrativa</h4>
                            <div class="chart">
                                <canvas id="myChartIssue" style="min-height: 250px; height: 250px; max-height: 450px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                            <h4>Tickets relacionados por tipo de fallas en aulas</h4>
                            <div class="chart">
                                <canvas id="myChartIssueAula" style="min-height: 250px; height: 250px; max-height: 450px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <h4>Tickets relacionados por tipo de fallas en laboratorios</h4>
                            <div class="chart">
                                <canvas id="myChartIssueLab" style="min-height: 250px; height: 250px; max-height: 450px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-areas" role="tabpanel" aria-labelledby="custom-tabs-one-area-tab">
                            <h4>Tickets por estatus</h4>
                            <div class="chart">
                                <canvas id="myChartIssueAreas" style="min-height: 250px; height: 250px; max-height: 450px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    {{--<div class="row">
        <div class="col-md-4">
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
                    <h4>Tickets relacionados por tipo de fallas en área administrativa</h4>
                    <div class="chart">
                        <canvas id="myChartIssue" style="min-height: 250px; height: 250px; max-height: 450px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-4">
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
                    <h4>Tickets relacionados por tipo de fallas en laboratorios</h4>
                    <div class="chart">
                        <canvas id="myChartIssueLab" style="min-height: 250px; height: 250px; max-height: 450px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>--}}
@stop
@section('js')
    <script>
        const labelsAreas = JSON.parse('{!! json_encode($places) !!}');
        const quantityAreas = JSON.parse( '{!! json_encode($itemPlace) !!}' );

        const dataArea = {
            labels: labelsAreas,
            datasets: [{
                label: 'Áreas',
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(97,255,86)',
                    'rgb(204,51,255)',
                    'rgb(250,96,41)',
                ],
                data: quantityAreas,
                borderSkipped: false,
            }]
        }


        const configAreas = {
            type: 'doughnut',
            data: dataArea,
            options: {}
        };

        const myChartArea = new Chart(
            document.getElementById('myChartArea'),
            configAreas
        );

        const labelsIssues = JSON.parse('{!! json_encode($placesIssues) !!}');
        const quantityIssues = JSON.parse( '{!! json_encode($issueByPlaces) !!}' );

        const dataIssues = {
            labels: labelsIssues,
            datasets: [{
                label: 'Fallas',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: quantityIssues,
                borderSkipped: false,
            }]
        }


        const configIssues = {
            type: 'line',
            data: dataIssues,
            options: {}
        };

        const myChartIssues = new Chart(
            document.getElementById('myChartIssue'),
            configIssues
        );

        const labelsIssuesAula = JSON.parse('{!! json_encode($issueByAulas) !!}');
        const quantityIssuesAula = JSON.parse( '{!! json_encode($aulaIssues) !!}' );

        const dataIssuesAula = {
            labels: labelsIssuesAula,
            datasets: [{
                label: 'Fallas',
                backgroundColor: 'rgb(54,162,235)',
                borderColor: 'rgb(54,162,235)',
                data: quantityIssuesAula,
                borderSkipped: false,
            }]
        }


        const configIssuesAula = {
            type: 'line',
            data: dataIssuesAula,
            options: {}
        };

        const myChartIssuesAula = new Chart(
            document.getElementById('myChartIssueAula'),
            configIssuesAula
        );

        const labelsIssuesLab = JSON.parse('{!! json_encode($issueByLab) !!}');
        const quantityIssuesLab = JSON.parse( '{!! json_encode($labIssues) !!}' );

        const dataIssuesLab = {
            labels: labelsIssuesLab,
            datasets: [{
                label: 'Fallas',
                backgroundColor: 'rgb(204,51,255)',
                borderColor: 'rgb(204,51,255)',
                data: quantityIssuesLab,
                borderSkipped: false,
            }]
        }


        const configIssuesLab = {
            type: 'line',
            data: dataIssuesLab,
            options: {}
        };

        const myChartIssuesLab = new Chart(
            document.getElementById('myChartIssueLab'),
            configIssuesLab
        );

        const labelsIssuesAreas = JSON.parse('{!! json_encode($ticketAreas) !!}');
        const quantityIssuesAreas = JSON.parse( '{!! json_encode($ticketID) !!}' );

        const dataIssuesAreas = {
            labels: labelsIssuesAreas,
            datasets: [{
                label: 'Estatus',
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(97,255,86)',
                    'rgb(204,51,255)',
                    'rgb(250,96,41)',
                ],
                data: quantityIssuesAreas,
                borderSkipped: false,
            }]
        }


        const configIssuesAreas = {
            type: 'doughnut',
            data: dataIssuesAreas,
            options: {}
        };

        const myChartIssuesAreas = new Chart(
            document.getElementById('myChartIssueAreas'),
            configIssuesAreas
        );
    </script>
@stop
