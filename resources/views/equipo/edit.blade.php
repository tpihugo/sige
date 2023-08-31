@extends('adminlte::page')
@section('title', 'Equipo edit')

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
                <div class="col-12">
                    <h4>Información de Equipo</h4>
                </div>
                
                <hr>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#js-example-basic-single').select2();

                    });

                    $(document).ready(function() {
                        $('#js-example-basic-single2').select2();

                    });
                </script>

            </div>
            <form action="{{ route('equipos.update', $equipo->id) }}" method="post" enctype="multipart/form-data"
                class="col-12">
                @method('PUT')
                <div class="row">
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
                    </div>

                </div>
                <h5 class="text-center"><span class="border-1 border-dark border-bottom px-2">Información SICI</span></h5>
                    <div class="row align-items-center">
                        <div class="col-2">
                            <label for="id">Id SIGE</label>
                            <input type="text" class="form-control-plaintext" id="id" name="id"
                                value="{{ $equipo->id }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="udg_id">Id UdeG</label>
                            <input type="text" class="form-control" id="udg_id" name="udg_id"
                                value="{{ $equipo->udg_id }}">
                        </div>
                        <div class="col-md-3">
                            <label for="id_resguardante">Código resguardante</label>
                            <input class="form-control" disabled type="text" name="resguardante[]" id="resguardante"
                                value="{{ $equipo->id_resguardante }}">
                        </div>
                        <div class="col-md-4">
                            <label for="resguardante">Resguardante nombre</label>
                            <input class="form-control" disabled type="text" name="resguardante[]" id="resguardante"
                                value="{{ $equipo->resguardante }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="usuario">Usuario</label>
                            <select class="form-control" name="usuario" id="js-example-basic-single">
                                <option disabled selected>Elige una opción</option>
                                @foreach ($empleados as $item => $value)
                                    <option value="{{ $value->id }}"
                                        {{ $equipo->id_empleado == $value->id ? 'selected' : '' }}>{{ $value->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="localizado_sici">localizado entrega recepción</label>
                            <select name="localizado_sici" id="localizado_sici" class="form-control">
                                <option value="{{ $equipo->localizado_sici }}" selected>{{ $equipo->localizado_sici }}
                                </option>
                                <option disable>Elegir</option>
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <h5 class="mt-2 pt-2 text-center"><span class="border-1 border-dark border-bottom px-2">Información equipo</span></h5>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-3">
                            <label for="tipo_equipo">Tipo de Equipo </label>
                            <select class="form-control" id="tipo_equipo" name="tipo_equipo">
                                <option selected value="{{ $equipo->tipo_equipo }}">{{ $equipo->tipo_equipo }}</option>
                                @foreach ($tipo_equipos as $tipos)
                                    <option value="{{ $tipos->tipo_equipo }}">{{ $tipos->tipo_equipo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="marca">Marca </label>
                            <input type="text" class="form-control" id="marca" name="marca"
                                value="{{ $equipo->marca }}">
                        </div>

                        <div class="col-md-3">
                            <label for="modelo">Modelo </label>
                            <input type="text" class="form-control" id="modelo" name="modelo"
                                value="{{ $equipo->modelo }}">
                        </div>
                        <div class="col-md-3">
                            <label for="numero_serie">Número de Serie </label>
                            <input type="text" class="form-control" id="numero_serie" name="numero_serie"
                                value="{{ $equipo->numero_serie }}">
                        </div>
                    </div>
                    <br>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="mac">MAC separado por ":" ej 18:AB:34:45 </label>
                            <input type="text" class="form-control" id="mac" name="mac"
                                value="{{ $equipo->mac }}">
                        </div>

                        <div class="col-md-4">
                            <label for="tipo_conexion">Tipo de Conexión</label>
                            <select class="form-control" id="tipo_conexion" name="tipo_conexion">
                                <option value="{{ $equipo->tipo_conexion }}" selected>{{ $equipo->tipo_conexion }}
                                </option>
                                <option disabled>Elegir otra opción</option>
                                <option value="No Aplica">No Aplica</option>
                                <option value="Red Cableada">Red Cableada</option>
                                <option value="Solo Wifi<">Solo Wifi</option>
                                <option value="Wifi y Ethernet">Wifi y Ethernet</option>
                                <option value="Sin conexión">Sin conexión</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row g-3 align-items-center">

                    </div>

                    <br>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-12">
                            <label for="detalles">Detalles</label>
                            <textarea class="form-control w-100" id="detalles" name="detalles">{{ $equipo->detalles }}</textarea>
                        </div>
                    </div>
                    <br>
                    <hr>

                    <br>
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar datos</button>
                        </div>
                    </div>
            </form>
            <br>
            <div class="row g-3 align-items-center">

                <br>
                <h5>En caso de inconsistencias enviar un correo a victor.ramirez@academicos.udg.mx</h5>
                <hr>

            </div>
    </div>
@else
    El periodo de Registro de Proyectos a terminado
    @endif

@endsection
