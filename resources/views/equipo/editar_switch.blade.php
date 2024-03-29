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
                <h2>Captura de Equipos</h2>
                <hr>
                <script type="text/javascript">

                    $(document).ready(function() {
                        $('#js-example-basic-single').select2({
                            theme: 'bootstrap-5'
                        });

                    });
                    $(document).ready(function() {
                        $('#js-example-basic-single2').select2({
                            theme: 'bootstrap-5'
                        });

                    });
                    $(document).ready(function() {
                        $('#js-example-basic-single3').select2({
                            theme: 'bootstrap-5'
                        });

                    });
                </script>

            </div>

            <form action="{{route('update-switch',$equipo->id)}}" method="post" enctype="multipart/form-data" class="col-12">
                <div class="row">
                    <div class="col">
                        {!! csrf_field() !!}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    Debe de llenar los campos marcados con un asterisco (*){{$errors}}.
                                </ul>
                            </div>
                        @endif
                        <br>
                        <div class="row align-items-center">
                            
                                
                                
                            
                            <div class="col-md-3">
                                <label for="udg_id">Id UdeG</label>
                                <input type="text" class="form-control" id="udg_id" name="udg_id" value="{{$equipo->udg_id}}" readonly>
                            </div>
                           
                            <div class="col-md-4">
                                <label for="tipo_conexion">Tipo de Conexión</label>
                                <select class="form-control" id="tipo_conexion" name="tipo_conexion">
                                    <option value="No Aplica" selected>No Aplica</option>
                                    <option value="Red Cableada">Red Cableada</option>
                                    <option value="Solo Wifi<">Solo Wifi</option>
                                    <option value="Wifi y Ethernet">Wifi y Ethernet</option>
                                    <option value="Sin conexión">Sin conexión</option>
                                </select>
                            </div>

                            
                            <div class="col-md-4">
                                <label for="switch">Switch por ":" eje: IDF-C-P4</label>
                                <input type="text" class="form-control" id="switch" name="switch"  value="{{$switch->switch}}">

                            </div>
                            
                        </div>
                        <br>
                        <div class="row align-items-center">

                            <div class="col-md-4">
                                <label for="switch">Licencias</label>
                                <input type="text" class="form-control" name="licencias" value="{{$switch->licencias}}">

                            </div>
                            
                            <div class="col-md-4">
                                <label for="marca">Marca </label>
                                <input type="text" class="form-control" id="marca" name="marca" value="{{$equipo->marca}}" >
                            </div>

                            <div class="col-md-4">
                                <label for="modelo">Modelo </label>
                                <input type="text" class="form-control" id="modelo" name="modelo" value="{{$equipo->modelo}}" >
                            </div>
                            
                            
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label for="enlace">Enlace</label>
                                <select id="enlace" name="enlace" class="form-control">
                                    <option disabled selected>Elegir</option>
                                    <option value="{{$switch->enlace}}" selected>{{$switch->enlace}}</option>
                                    <option value="utp">utp</option>
                                    <option value="fibra">fibra</option>
                                </select>

                            </div>

                            <div class="col-md-4">
                                <label for="acceso">Acceso</label>
                                <select id="acceso" name="acceso" class="form-control">
                                    <option disabled selected>Elegir</option>
                                    <option value="{{$switch->accesso}}"selected>{{$switch->accesso}}</option>
                                    <option value="telnet">telnet</option>
                                    <option value="telnet/web">telnet/web</option>
                                    <option value="ssh/https">ssh/https</option>
                                </select>

                            </div>

                            <div class="col-md-4">
                                <label for="descripcion">Descripcion</label>
                                <input type="text" class="form-control" name="descripcion" value="{{$switch->descripcion}}">

                            </div>
    
                        </div>
                        <br>

                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label for="numero_serie">Número de Serie </label>
                                <input type="text" class="form-control" id="numero_serie" name="numero_serie" value="{{$equipo->numero_serie}}" >
                            </div>
                            
                            <div class="col-md-4">
                                <label for="mac">MAC separado por ":" ej 18:AB:34:45</label>
                                <input type="text" class="form-control" id="mac" name="mac" value="{{$equipo->mac}}" >
                            </div>

                            <div class="col-md-4">
                                <label for="ip_id">IP</label>
                                <select class="form-control" id="js-example-basic-single3" name="ip_id">
                                    <option value="No Aplica" selected>No Aplica</option>
                                    <option value="{{$equipo->ip}}" selected>{{$equipo->ip}}</option>
                                    @foreach($ips as $ip)
                                        <option value="{{$ip->ip}}" >{{$ip->ip}}</option>
                                    @endforeach
                                </select>
                                <!--<input type="text" class="form-control" id="ip" name="ip" value="No aplica/No Especificado" >-->

                            </div>
                            <br>

                            <div class="col-md-5"><br>
                                <label for="id_resguardante">Resguardante</label>
                                <select class="form-control" id="js-example-basic-single" name="id_resguardante">
                                    <option value="No Aplica" selected>No Aplica</option>
                                    <option value="{{$resguardante->id}}" selected>{{$resguardante->nombre}}</option>
                                    @foreach($empleados as $empleado)
                                        <option value="{{$empleado->id}}">{{$empleado->nombre}} {{$empleado->codigo}}</option>
                                    @endforeach
                                </select>
                            </div>

                            

                        </div>
			<br>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <label for="resguardante">Dependencia Resguardante</label>
                                <select name="resguardante" id="resguardante" class="form-control">
                                    
				                    <option  selected>Elegir</option>
                                    <option value="{{$equipo->resguardante}}" selected>{{$equipo->resguardante}}</option>
                                    <option value="Otra dependencia">Otra dependencia</option>
                                    <option value="CTA">CTA</option>
                                    <option value="No inventariable">No inventariable</option>
                                </select>
                            </div>
                            {{-- <div class="col-md-6">
                                <label for="localizado_sici">Inventariable</label>
                                <select name="localizado_sici" id="localizado_sici" class="form-control">
				                    <option disable selected>Elegir</option>
                                    <option value="No">No</option>
                                    <option value="Si">Si</option>
                                </select>
                            </div> --}}
                            <div class="col-md-6">
                                <label for="detalles">Detalles</label>
                                <textarea class="form-control" id="detalles" name="detalles">{{$equipo->detalles}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            
                            <input type="hidden" name="area_id" value="{{$area_actual->id_area}}">
                        </div>
                        <br>
                        
                        <br>
			<div class="row align-items-center">
                    		<div class="col-md-6">
                        		<a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
                        		<button type="submit" class="btn btn-success">Guardar datos</button>
                    		</div>
                    	</div>
               	 	</div>
                	<br>

            	</div>
            </form>
            <br>
            <div class="row align-items-center">

                <br>
                <h5>En caso de inconsistencias enviar un correo a victor.ramirez@academicos.udg.mx</h5>
                <hr>

            </div>
    </div>

    @else
        El periodo de Registro de Proyectos a terminado
    @endif

@endsection
