@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">devices</i>
                        </div>
                        <p class="card-category">Equipos</p>
                        <h3 class="card-title">
                            {{$total_equipos->localizados}}
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">desktop_windows</i> &nbsp;
                            {{$total_cpu->cpus}} CPU &nbsp; | &nbsp;
                            <i class="material-icons">computer</i> &nbsp;
                            {{$total_lap->laptop}} Lap &nbsp; | &nbsp;
                            <i class="material-icons">print</i> &nbsp;
                            {{$total_imp->impresora}} Imp
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">desktop_windows</i>
                        </div>
                        <p class="card-category">Localizados SICI</p>
                        <h3 class="card-title">{{$total_equipos_localizados_sici->localizados_sici}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">desktop_windows</i> &nbsp;
                            {{$total_cpu_localizados_sici->cpu_localizados}} CPU &nbsp; | &nbsp;
                            <i class="material-icons">computer</i> &nbsp;
                            {{$total_lap_localizadas_sici->lap_localizadas}} Lap &nbsp; | &nbsp;
                            <i class="material-icons">print</i> &nbsp;
                            {{$total_imp_localizadas_sici->imp_localizadas}} Imp
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">desktop_windows</i>
                        </div>
                        <p class="card-category">No Localizados SICI</p>
                        <h3 class="card-title">{{$total_equipos_no_localizados_sici->no_localizados_sici}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">desktop_windows</i> &nbsp;
                            {{$total_cpu_no_localizados_sici->cpu_localizados}} CPU &nbsp; | &nbsp;
                            <i class="material-icons">computer</i> &nbsp;
                            {{$total_lap_no_localizadas_sici->lap_localizadas}} Lap &nbsp; | &nbsp;
                            <i class="material-icons">print</i> &nbsp;
                            {{$total_imp_no_localizadas_sici->imp_localizadas}} Imp
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">tablet_mac</i>
                        </div>
                        <p class="card-category">Tablets</p>
                        <h3 class="card-title">{{$total_tablets_cta->total_tablet_cta}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">tablet_android</i> &nbsp;
                            {{$total_tablets_android->total_tablet_android}} &nbsp; Android &nbsp; | &nbsp;
                            <i class="material-icons">tablet_mac</i> &nbsp;
                            {{$total_tablets_apple->total_tablet_apple}} &nbsp; Apple
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">restart_alt</i>
                        </div>
                        <p class="card-category">Prestamos</p>
                        <h3 class="card-title">+245</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> Just Updated
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.js" integrity="sha512-CWVDkca3f3uAWgDNVzW+W4XJbiC3CH84P2aWZXj+DqI6PNbTzXbl1dIzEHeNJpYSn4B6U8miSZb/hCws7FnUZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

