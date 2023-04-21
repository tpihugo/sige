@extends('layouts.app')
@section('content')

    <div class="container">
        @if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'cta' || Auth::user()->role == 'auxiliar' || Auth::user()->role == 'redes'))
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>
                </div>
            @endif
            <div class="row">
                <div class="col -12">
                    <div class="row align-items-end">
                                <div class="col-md-8 pl-0">
                    <h2><center><b>IP:</b> {{$ip->ip}}</h2>
                    </div>
                </div>
            </div>
                            <div class="col-12">
                            <div class="row align-items-end">
                                <div class="col-md-8 pl-0">
                                    <label class="font-weight-bold" for="id_subred">Subred (VLAN) </label>
                                    <label   class="form-control">VLAN: {{$subred->vlan}}, Rango de IP:  {{ $subred->rangoInicial }}  al  {{ $subred->rangoFinal }}, Gateway: {{ $subred->gateway }}</label>
                                    </div>
                                    <div class="col-md-4 pl-0">
                                    <label class="font-weight-bold" for="ip"> IP:</label>
                                    <label type="text" class="form-control">{{ $ip->ip}}</label>
                                    </div>
                            </div>
                             <div class="row align-items-center">
                                <div class="col-md-12 pl-0">
                                    <br>
                            <center><label class="font-weight-bold">Datos del Equipo. </label></center>
                                </div>
                            </div>
                                    <div class="row align-items-center">
                                <div class="col-md-6 pl-0">
                                    <!--Número de Serie del equipo.-->
                                    <label class="font-weight-bold" for="equipo">Número de Serie</label>
                                    <label class="form-control"></label>
                                </div>
                                <div class="col-md-6 pl-0">
                                            <!--Direccion MAC del Equipo.-->
                                        <label class="font-weight-bold" for="subred">MAC:</label>
                                        <label id="mac" name="mac" class="form-control" > </label>
                                </div>
                                <div class="col-md-3 pl-0">
                                        <!--Ubicacion Fisica del Equipo.-->
                                        <label class="font-weight-bold" for="subred">Tipo de Equipo:</label>
                                        <label  id="tipo" name="tipo" class="form-control" placeholder="Disabled input"></label>
                                    </div>
                                    <div class="col-md-3 pl-0">
                                        <!--UDG ID.-->
                                        <label class="font-weight-bold" for="subred">UDG ID:</label>
                                        <label  id="udg_id" name="udg_id" class="form-control" placeholder="Disabled input"></label>
                                    </div>
                                    <div class="col-md-6 pl-0">
                                        <!--Usuario Responsable del Equipo.-->
                                        <label class="font-weight-bold" for="subred">Usuario Asignado:</label>
                                        <label id="usuario" name="usuario" class="form-control" placeholder="Disabled input" value=""> </label>
                                    </div>
                                    <div class="col-md-12 pl-0">
                                        <!--Ubicacion Fisica del Equipo.-->
                                        <label class="font-weight-bold" for="subred">Locación del equipo:</label>
                                        <label rows="2" id="area" name="area" class="form-control" placeholder="Disabled input"></label>
                                    </div>
                                     <div class="col-md-1 pl-0">
                                        <input type="hidden" class="form-control" id="id_equipo" name="id_equipo"  value="{{$ip->id_equipo}}" />
                                    </div>
                                </div>
                             </div>
                            <div class="col-12">
                            <div class="row align-items-end">
                                <div class="col-md-12 pl-0">
                                      <center>
                                        <a href="{{ route('disponible',$ip->Subred_id) }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Regresar</a>


                                      </center>
                                </div>
                                </div>
                            </div>
                            </div>
                </div>
            </div>
                <div class="col-12 ml-3">
                    <center><h5>En caso de inconsistencias, favor de reportarlas.</h5></center>
                </div>
    </div>

    @else
        El periodo de Registro de Proyectos a terminado
    @endif

@endsection
