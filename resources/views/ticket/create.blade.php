@extends('adminlte::page')
@section('title', 'Home')

@section('css')
    @include('layouts.head_2')
    <!-- Styles -->

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
                <h2>Captura de Tickets</h2>
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
                </script>

            </div>

            <form action="{{ route('tickets.store') }}" method="post" enctype="multipart/form-data" class="col-12">
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

                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="prioridad">Prioridad </label>
                                <select class="form-control" id="prioridad" name="prioridad">
                                    <option disabled>Elegir</option>
                                    <option value="Baja">Baja</option>
                                    <option value="Media">Media</option>
                                    <option value="Alta" selected>Alta</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="estatus">Estatus </label>
                                <select class="form-control" id="estatus" name="estatus">
                                    <option disabled>Elegir</option>
                                    <option value="Abierto" selected>Abierto</option>
                                    <option value="Cerrado">Cerrado</option>
                                    <option value="En Espera">En Espera</option>
                                    <option value="Escalado">Escalado</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="categoria">Categoría </label>
                                <select class="form-control" id="categoria" name="categoria">
                                    <option disabled>Elegir</option>
                                    <option value="Incidente" selected>Incidente</option>
                                    <option value="Solicitudes de Servicio">Solicitudes de Servicio</option>
                                    <option value="Reporte de aula">Reporte de aula</option>
                                    <option value="Reinstalación  de S.O.">Reinstalación de S.O.</option>
                                    <option value="Instalación de Paqueteria">Instalación de Paqueteria</option>
                                    <option value="Asignación de IP">Asignación de IP</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <label for="area_id">Áreas</label>
                                <select class="form-control" class="form-control" id="js-example-basic-single"
                                    name="area_id" required>
                                    <option disable selected>Selecciona una área</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->sede }} - {{ $area->division }} -
                                            {{ $area->coordinacion }} - {{ $area->area }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="tecnico_id">Técnico </label>
                                <select class="form-control" id="js-example-basic-single2" name="tecnico_id" required>
                                    <option disabled selected>Elegir</option>
                                    @foreach ($tecnicos as $tecnico)
                                        <option value="{{ $tecnico->id }}">{{ $tecnico->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="solicitante">Solicitante</label>
                                <input type="text" class="form-control" id="solicitante" name="solicitante"
                                    value="{{ old('solicitante') }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="contacto">Contacto</label>
                                <input type="text" class="form-control" id="contacto" name="contacto"
                                    value="{{ old('contacto') }}" required>
                            </div>
                        </div>
                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <label for="datos_reporte">Reporte</label>
                                <textarea class="form-control" id="datos_reporte" name="datos_reporte">{{ old('datos_reporte') }}</textarea>
                            </div>
                        </div>
                        <br>
                    </div>
                    <br>

                </div>
                <br>
                <div class="row align-items-end justify-content-end">
                    <div class="col-md-4">
                        <a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
                        <button type="submit" class="btn btn-success">
                            Guardar datos
                            <i class="ml-1 fas fa-save"></i>
                        </button>
                    </div>
                </div>
            </form>
    </div>
@else
    Acceso no Valido
    @endif
@endsection
@section('footer')
    <div class="row g-3 align-items-center">
        <h5 class="text-end">En caso de inconsistencias, favor de reportarlas.</h5>
    </div>
@endsection
