@extends('adminlte::page')
@section('title', "IP'S")

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
            @elseif (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-auto ml-3">
                    <h2>Asignación de Equipo a IP.</h2>
                </div>
                <hr>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#numero_serie').select2();
                });
            </script>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('ips.update', $ip->id) }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        <div class="col">
                            {!! csrf_field() !!}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row align-items-end">
                                <div class="col-md-8 pl-0">
                                    <label class="font-weight-bold" for="id_subred">Subred (VLAN) </label>
                                    <label class="form-control">VLAN: {{ $subred->vlan }}, Rango de IP:
                                        {{ $subred->rangoInicial }} al {{ $subred->rangoFinal }}, Gateway:
                                        {{ $subred->gateway }}</label>
                                </div>
                                <div class="col-md-4 pl-0">
                                    <label class="font-weight-bold" for="ip">IP Asignada</label>
                                    <label type="text" class="form-control" id="ip"
                                        name="ip">{{ $ip->ip }}</label>
                                </div>

                            </div>
                            <!--Aparto para que le usuario selecione los datos del equipo (Numero de serie, Tipo de equipo, MAC)
                                y el nombre del usuario-->
                            <div class="row align-items-center">
                                <div class="col-md-12 pl-0">
                                    <center><label class="font-weight-bold" for="">Datos del Equipo. </label>
                                    </center>
                                    <br>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6 pl-0">
                                    <!--Número de Serie del equipo.-->
                                    <label class="font-weight-bold" for="equipo">Seleccione un Equipo<span
                                            style="color: red"><b>*</b></span></label>
                                    <select class="form-control" id="numero_serie" name="numero_serie"
                                        onchange="myFunction()">
                                        <option id="numero_serie" name="numero_serie" value="{{ $ip->id_equipo }}">
                                            {{ $edit->numero_serie }}
                                        </option>
                                        <option value="no aplica">Número de Serie</option>
                                        @foreach ($vs_equipos as $vs_equipo)
                                            <option value="{{ $vs_equipo }}">
                                                Número de Serie: {{ $vs_equipo->numero_serie }},
                                                UDG ID: {{ $vs_equipo->udg_id }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 pl-0">
                                    <!--Direccion MAC del Equipo.-->
                                    <label class="font-weight-bold" for="subred">MAC:</label>
                                    <label id="mac" name="mac" class="form-control">{{ $edit->mac }}</label>
                                </div>
                                <div class="col-md-3 pl-0">
                                    <br>
                                    <!--Ubicacion Fisica del Equipo.-->
                                    <label class="font-weight-bold" for="subred">Tipo de Equipo:</label>
                                    <label id="tipo" name="tipo" class="form-control"
                                        placeholder="Disabled input">{{ $edit->tipo_equipo }}</label>
                                </div>
                                <div class="col-md-3 pl-0">
                                    <br>
                                    <!--UDG ID.-->
                                    <label class="font-weight-bold" for="subred">UDG ID:</label>
                                    <label id="udg_id" name="udg_id" class="form-control"
                                        placeholder="Disabled input">{{ $edit->udg_id }}</label>
                                </div>
                                <div class="col-md-6 pl-0">
                                    <br>
                                    <!--Usuario Responsable del Equipo.-->
                                    <label class="font-weight-bold" for="subred">Responsable del Equipo:</label>
                                    <label id="usuario" name="usuario" class="form-control" placeholder="Disabled input"
                                        value="">{{ $edit->nombre }} </label>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <!--Ubicacion Fisica del Equipo.-->
                                    <label class="font-weight-bold" for="subred">Ubicación del Equipo:</label>
                                    <textarea style="background-color: #fcfcfc;"  rows="2.5" id="area" name="area" class="form-control"
                                        placeholder="Disabled input">{{ $edit->area }}</textarea>
                                </div>
                                <div class="col-md-1 pl-0">
                                    <input type="hidden" class="form-control" id="id_equipo" name="id_equipo"
                                        value="{{ $ip->id_equipo }}" />

                                </div>

                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <center>
                                    <a href="{{ route('ocupadas', $subred) }}'"class="btn btn-danger">Cancelar</a>
                                    <button type="submit" class="btn btn-success"> Guardar<i
                                            class="ml-1 fas fa-save"></i></button>

                                </center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <div class="row align-items-center">
                <br>
                <div class="col-12 ml-3">
                    <h5>En caso de inconsistencias, favor de reportarlas.</h5>
                </div>
            </div>
    </div>
@else
    El periodo de Registro de Proyectos a terminado
    @endif


@endsection




<script>
    function myFunction() {
        //

        var x = document.getElementById("numero_serie").value;
        var obj = JSON.parse(x);

        // recuperar la dirrecion MAC
        document.getElementById("mac").innerHTML = obj.mac;
        // recuperar  la ubicacion del equipo que se le asigna la IP
        document.getElementById("area").innerHTML = obj.area;
        // recuperar  el Nombre del resguardante
        document.getElementById("usuario").innerHTML = obj.nombre;
        //  recuperar el tipo de equipo
        document.getElementById("tipo").innerHTML = obj.tipo_equipo;
        // reuperar el UDG ID
        document.getElementById("udg_id").innerHTML = obj.udg_id;
        //  reuperar el ID del Equipo
        document.getElementById("id_equipo").value = obj.id;
        //redireccionamiento para editar los datos del equipo por ID.
        var url = "{{ route('equipos.edit', ':id') }}";
        url = url.replace(':id', obj.id);
        document.getElementById('equipo').href = url;
    }

    var url = "{{ route('equipos.edit', ':id') }}";
    url = url.replace(':id', obj.id);
    document.getElementById('equipo').href = url;
</script>
