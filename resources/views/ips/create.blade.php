@extends('layouts.app')
@section('content')

    <div class="container">
        @if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'cta' || Auth::user()->role == 'auxiliar' || Auth::user()->role == 'redes'))
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
                <div class="col-md-12">
                    <center>
                    <h2>Captura de IP.</h2>
                    </center>
                    <script type="text/javascript">

                    $(document).ready(function() {
                        $('#numero_serie').select2();
                    });
                </script>
                </div>
                <hr>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('ips.store') }}" method="post">
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
                            <br>
                            <div class="row align-items-end">
                                <div class="col-md-9 pl-0">
                                    <!--Campo para la asignacion de Subred (VLAN,Rango y Gateway)-->
                                    <label for="Subred_id" class="font-weight-bold">Subred <span style="color: red"><b>*</b></span></label>
                                    <select class="form-control" id="Subred_id" name="Subred_id">
                                        @if (isset($EquipoElegido->id) && !is_null($EquipoElegido->id))
                                            <option value="{{ $EquipoElegido->id }}" selected>
                                                 {{ $EquipoElegido->vlan }}
                                                 {{ $EquipoElegido->rango }}
                                                 {{ $EquipoElegido->gateway }}
                                            </option>
                                            <option disabled>Elegir</option>
                                        @else
                                            <option disabled selected>Elegir</option>
                                        @endif
                                        @foreach ($subredes as  $subred)
                                            <option value="{{ $subred->id}}">
                                                VLAN: {{ $subred->vlan }} ,
                                                Rango de IP: {{ $subred->rangoInicial }} al {{ $subred->rangoFinal }} ,
                                                Gateway: {{ $subred->gateway }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-3 pl-0">
                                        <label class="font-weight-bold" for="subred">IP <span style="color: red"><b>*</b></span></label>
                                         <input type="text" class="form-control" id="ip" name="ip" pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{1,3}\.[0-9]{1,3}"
                                           title="El campo debe ser llenado en el formato correcto.&#013;Ejemplo: (255.255.255.255)"
                                           placeholder="255.255.255.255" max="19" maxlength=""
                                           value="{{ old('ip') }}">
                                </div>
                        </div>
                            <br>
                        <!--Aparto para que le usuario selecione los datos del equipo al selecionar el número de serie los campos(MAC, nombre del usuario,
                        tipo de equipo, ID UDG, loración-->
                            <center><label class="font-weight-bold" for="">Datos del Equipo. </label></center>
                            <div class="row align-items-center">
                                <div class="col-md-6 pl-0">
                                    <!--Numero de Serie del equipo.-->
                                    <label class="font-weight-bold" for="equipo">Número de Serie <span style="color: red"><b>*</b></span></label>
                                    <select class="form-control" class="form-control" id="numero_serie" name="numero_serie" onchange="datosEquipo()" selected >
                                    <option value="No Aplica">Selecione un Número de Serie</option>
                                    <option value="{{old('id_equipo')}}">Sin equipo</option>
                                    <option value="0">Sin equipo</option>
                                            @foreach($vs_equipos as $vs_equipo)
                                                <option value="{{$vs_equipo}}">
                                                Número de Serie: {{$vs_equipo->numero_serie}},
                                                UDG ID: {{$vs_equipo->udg_id}},
                                                ID: {{$vs_equipo->id}}
                                                </option>
                                            @endforeach
                                </select>

                                        <script>
                                             function datosEquipo() {
                                                var x = document.getElementById("numero_serie").value;
                                                var obj = JSON.parse(x);
                                                //senetcniaentica para recuperar la dirrecion MAC
                                                    document.getElementById("mac").innerHTML = obj.mac;
                                                ///sentica para recuperar  la ubicacion del equipo que se le asigna la IP
                                                    document.getElementById("area").innerHTML = obj.area;
                                                //sentica para recuperar  el ID del resguardante/nombre
                                                    document.getElementById("usuario").innerHTML = obj.nombre ;
                                                // reuperar el Tipo de Equipo Asignado
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
                                </div>
                                <br>
                                <div class="col-md-6 pl-0">
                                            <!--Direccion MAC del Equipo.-->
                                        <label class="font-weight-bold" for="subred">MAC:</label>
                                        <label  id="mac" name="mac" type="hidden" class="form-control"placeholder="Disabled input"></label>
                                </div>
                                <div class="col-md-3 pl-0">
                                        <!--Tipo de Equipo.-->
                                        <label class="font-weight-bold" for="subred">Tipo de Equipo:</label>
                                        <label  id="tipo" name="tipo" type="hidden" class="form-control" placeholder="Disabled input"></label>
                                    </div>
                                <div class="col-md-3 pl-0">

                                        <!--UDG ID.-->
                                        <label class="font-weight-bold" for="subred">UDG ID:</label>
                                        <label  id="udg_id" name="udg_id"  type="hidden" class="form-control"  placeholder="Disabled input"></label>
                                    </div>
                                    <div class="col-md-6 pl-0">

                                        <!--Usuario Responsable del Equipo.-->
                                        <label class="font-weight-bold" for="subred">Usuario Asignado:</label>
                                        <label  id="usuario" name="usuario" type="hidden" class="form-control"  placeholder="Disabled input"></label>
                                    </div>
                                    <div class="col-md-12 pl-0">
                                        <!--Ubicacion Fisica del Equipo.-->
                                        <label class="font-weight-bold" for="subred">Locación del equipo:</label>
                                        <textarea  id="area" name="area" type="hidden" class="form-control" placeholder=""></textarea>
                                    </div>
                                     <div class="col-md-1 pl-0">
                                        <input   type="hidden" class="form-control" id="id_equipo" name="id_equipo" />
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="container">
                        <div class="row align-items-center m-0">
                            <div class="col-md-12">
                            <center>
                            <label class="font-weight-bold">
                                <span style="color: red"><b>*</b></span>
                                Si algún dato del equipo está erróneo presioné el botón Morado, para poder editar los datos. <span style="color: red"><b>*</b></span>
                            </label>
                             </center>
                             </div>
                        </div>
                        </div>
                        <br>
                        <div class="container">
                        <div class="row align-items-center m-0">
                            <div class="col-md-12">
                                <center>
                                <a href="{{ route('ips.index') }}" class="btn btn-danger">Cancelar</a>
                                <button type="submit" class="btn btn-success">Guardar datos <i class="ml-1 fas fa-save"></i></button>
                                <!--botón para editar los datos del equipo-->
                                 <a  href="" id="equipo" name="equipo" class="btn btn-primary">Equipo</a>
                                </center>
                            </div>
                        </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-12 ml-3">
                    <center>
                    <h5>En caso de inconsistencias, favor de reportarlas.</h5>
                    </center>
                </div>
                <hr>
            </div>
    </div>
    @else
        El periodo de Registro de Proyectos a terminado
    @endif
@endsection


