@extends('adminlte::page')
@section('title', 'Asignación IP')

@section('css')
    @include('layouts.head_2')

@stop

@section('content')

    @if (Auth::check() &&
            (Auth::user()->role == 'admin' ||
                Auth::user()->role == 'cta' ||
                Auth::user()->role == 'auxiliar' ||
                Auth::user()->role == 'redes'))
        <div class="container">
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
                    <h2>Asignación de equipo.</h2>
                </div>
                <hr>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#numero_serie').select2({
                        theme: 'bootstrap-5'
                    });
                });
            </script>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('ips.update', $ip->id) }}" id="formulario" method="post"
                        enctype="multipart/form-data">
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
                                    <label class="font-weight-bold" for="id_subred">Subred (VLAN):</label>
                                    <label class="form-control">VLAN: {{ $subred->vlan }}, Rango de IP:
                                        {{ $subred->rangoInicial }} al {{ $subred->rangoFinal }}, Gateway:
                                        {{ $subred->gateway }}</label>
                                </div>
                                <div class="col-md-4 pl-0">
                                    <label class="font-weight-bold" for="ip">IP asignada</label>
                                    <label type="text" class="form-control" id="ip"
                                        name="ip">{{ $ip->ip }}</label>
                                </div>

                            </div>
                            <!--Aparto para que le usuario selecione los datos del equipo (Numero de serie, Tipo de equipo, MAC)
                                                                y el nombre del usuario-->
                            <div class="row align-items-center">
                                <div class="col-md-12 pl-0">
                                    <center><label class="font-weight-bold" for="">Datos del equipo. </label>
                                    </center>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6 pl-0">
                                    <!--Número de Serie del equipo.-->
                                    <label class="font-weight-bold" for="equipo">Introduce (N/S, ID, ID UDG)<span
                                            style="color: red"><b>*</b></span></label>
                                    <input type="text" onchange="buscar()" id="busqueda_equipo" class="form-control">

                                </div>
                                <div class="col-md-6 pl-0">

                                    <!--Direccion MAC del Equipo.-->
                                    <label class="font-weight-bold" for="subred">MAC:</label>
                                    <label id="mac" name="mac" class="form-control"></label>
                                </div>
                                <div class="col-md-3 pl-0">
                                    <br>
                                    <!--Ubicacion Fisica del Equipo.-->
                                    <label class="font-weight-bold" for="subred">Tipo de equipo:</label>
                                    <label id="tipo" name="tipo" class="form-control"
                                        placeholder="Disabled input"></label>
                                </div>
                                <div class="col-md-3 pl-0">
                                    <br>
                                    <!--UDG ID.-->
                                    <label class="font-weight-bold" for="subred">UDG ID:</label>
                                    <label id="udg_id" name="udg_id" class="form-control"
                                        placeholder="Disabled input"></label>
                                </div>
                                <div class="col-md-6 pl-0">
                                    <br>
                                    <!--Usuario Responsable del Equipo.-->
                                    <label class="font-weight-bold" for="subred">Responsable del equipo:</label>
                                    <label id="usuario" name="usuario" class="form-control" placeholder="Disabled input"
                                        value=""></label>
                                </div>
                                <div class="col-md-12 pl-0">
                                    <br>
                                    <!--Ubicacion Fisica del Equipo.-->
                                    <label class="font-weight-bold" for="subred">Ubicación del equipo:</label>
                                    <textarea style="background-color: #fcfcfc;" rows="2.5" disabled id="area" name="area" class="form-control"></textarea>
                                </div>
                                <div class="col-md-1 pl-0">
                                    <input type="hidden" class="form-control" id="id_equipo" name="id_equipo"
                                        value="" />

                                </div>
                            </div>
                            <br>
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <center>
                                        <a href="{{ route('disponible', $subred) }}'"class="btn btn-danger">Cancelar</a>
                                        <button type="submit" class="btn btn-success"> Guardar datos <i
                                                class="ml-1 fas fa-save"></i></button>
                                        <!--botón para editar los datos del equipo-->
                                        <a href="" id="equipo" name="equipo" class="btn btn-primary"
                                            style="display: none">Equipo</a>
                                    </center>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    @else
        El periodo de Registro de Proyectos a terminado
    @endif
@endsection


@section('js')
    <script>
        function buscar() {
            let data = document.getElementById("busqueda_equipo").value;
            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = "{{ route('ip.buscar_equipo', ':id') }}";
            url = url.replace(':id', data);
            $.ajax({
                url: url,
                method: 'POST',
                data: data
            }).done(function(data) {
                myFunction(data);
            });

        }

        function myFunction(data) {
            var obj = data;
            // recuperar la dirrecion MAC
            document.getElementById("mac").innerHTML = obj.mac;
            // recuperar  la ubicacion del equipo que se le asigna la IP
            document.getElementById("area").innerHTML = obj.area;
            // recuperar  el Nombre del resguardante
            document.getElementById("usuario").innerHTML = obj.resguardante;
            //  recuperar el tipo de equipo
            document.getElementById("tipo").innerHTML = obj.tipo_equipo;
            // reuperar el UDG ID
            document.getElementById("udg_id").innerHTML = obj.udg_id;
            //  reuperar el ID del Equipo
            document.getElementById("id_equipo").value = obj.id;
            //buscar equipo
            var url = "{{ route('equipos.edit', ':id') }}";
            url = url.replace(':id', obj.id);
            let equipo = document.getElementById('equipo');
            equipo.href = url;
            equipo.style = "display:inline-block;";

        }
    </script>
@endsection

@section('footer')
    <h5 class="text-end">En caso de inconsistencias, favor de reportarlas.</h5>
@endsection
