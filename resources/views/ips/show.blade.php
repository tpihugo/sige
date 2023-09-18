@extends('adminlte::page')
@section('title', 'Ver asignación')

@section('css')
    @include('layouts.head_2')

@stop
@section('content')

    <div class="container">
        @if (Auth::check() &&
                (Auth::user()->role == 'admin' ||
                    Auth::user()->role == 'cta' ||
                    Auth::user()->role == 'auxiliar' ||
                    Auth::user()->role == 'redes'))
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center">
                        <b>IP:</b> {{ $ip->ip }}
                    </h2>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row align-items-end">
                            <div class="col-md-8 pl-0">
                                <label class="font-weight-bold" for="id_subred">Subred (VLAN):</label>
                                <label class="form-control">VLAN: {{ $subred->vlan }}, Rango de IP:
                                    {{ $subred->rangoInicial }} al {{ $subred->rangoFinal }}, Gateway:
                                    {{ $subred->gateway }}</label>
                            </div>
                            <div class="col-md-4 pl-0">
                                <label class="font-weight-bold" for="ip"> IP:</label>
                                <label type="text" class="form-control">{{ $ip->ip }}</label>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-12 pl-0">
                                <center><label class="font-weight-bold">Datos del equipo. </label></center>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-6 pl-0">
                                <!--Número de Serie del equipo.-->
                                <label class="font-weight-bold" for="equipo">Número de serie:</label>
                                <label class="form-control">{{ $edit->numero_serie }}</label>
                            </div>
                            <div class="col-md-6 pl-0">
                                <!--Direccion MAC del Equipo.-->
                                <label class="font-weight-bold" for="subred">MAC:</label>
                                <label id="mac" name="mac" class="form-control">{{ $edit->mac }}</label>
                            </div>
                            <div class="col-md-3 pl-0">
                                <!--Ubicacion Fisica del Equipo.-->
                                <label class="font-weight-bold" for="subred">Tipo de equipo:</label>
                                <label id="tipo" name="tipo" class="form-control"
                                    placeholder="Disabled input">{{ $edit->tipo_equipo }}</label>
                            </div>
                            <div class="col-md-3 pl-0">
                                <!--UDG ID.-->
                                <label class="font-weight-bold" for="subred">UDG ID:</label>
                                <label id="udg_id" name="udg_id" class="form-control"
                                    placeholder="Disabled input">{{ $edit->udg_id }}</label>
                            </div>
                            <div class="col-md-6 pl-0">
                                <!--Usuario Responsable del Equipo.-->
                                <label class="font-weight-bold" for="subred">Responsable del equipo:</label>
                                <label id="usuario" name="usuario" class="form-control" placeholder="Disabled input"
                                    value="">{{ $edit->nombre }} </label>
                            </div>
                            <div class="col-md-12 pl-0">
                                <!--Ubicacion Fisica del Equipo.-->
                                <label class="font-weight-bold" for="subred">Ubicación del equipo:</label>
                                <label id="area" name="area" class="form-control" placeholder="Disabled input"
                                    disabled>{{ $edit->area }}</label>
                            </div>
                            <div class="col-md-1 pl-0">
                                <input type="hidden" class="form-control" id="id_equipo" name="id_equipo"
                                    value="{{ $ip->id_equipo }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row align-items-end">
                            <div class="col-md-12 pl-0">
                                <center>
                                    <a href="{{ route('ocupadas', $ip->Subred_id) }}" class="btn btn-primary"><i
                                            class="fa fa-arrow-left"></i> Regresar</a>
                                    <a href="{{ route('desasignarEquipo', $ip->ip) }}" class="btn btn-info"
                                        title="">Desasignar Equipo</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
@else
    El periodo de Registro de Proyectos a terminado
    @endif

@endsection
@section('footer')
    <h5 class="text-end">En caso de inconsistencias, favor de reportarlas.</h5>
@endsection
