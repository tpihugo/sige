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
                    Auth::user()->role == 'redes' ||
                    Auth::user()->role == 'general'
                    ))
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>

                </div>
            @endif
            <div class="row">
                <h2>Captura de Tickets</h2>
                <hr>


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

                        <!--Validación de usuario para quitar el nombre del solicitante -->
                         @if( Auth::user()->role != 'general') 
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                    <label for="area_id">Solicitante</label>
                                </div>

                            </div>
                            <div class="row g-3 d-flex align-items-center">
                                <div class="col-md-12 d-flex">
                                        <select class="form-control" id="js-example-basic-single2" name="solicitante_id" required>
                                            <option disabled selected>Elegir un solicitante</option>
                                            @foreach ($solicitantes as $solicitante)
                                                <option value="{{ $solicitante->id }}">{{ $solicitante->nombre }} - {{ $solicitante->contacto_principal}}  </option>
                                            @endforeach
                                        </select>
                                    <a href="{{ route('solicitantes.create') }}" class="btn btn-sm btn-primary">Agregar</a>
                                </div>
                            </div>
                            <br>
                        @endif
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <label for="area_id">Áreas</label>
                                <select class="form-control" class="form-control" id="js-example-basic-single"
                                    name="area_id" required>
                                    <option disable selected>Selecciona una área</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->sede }} - {{ $area->area }} -
                                            {{ $area->edificio }} - {{ $area->piso }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <label for="servicio_id">Servicio </label>
                                <select class="form-control" id="js-example-basic-single3" name="servicio_id" required>
                                    <option disabled selected>Elegir</option>
                                    @foreach ($servicios as $servicio)
                                        <option value="{{ $servicio->id }}">{{ $servicio->nombre }} - {{ $servicio->descripcion}}  </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <label for="datos_reporte">Comentarios del reporte</label>
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
                        <a href="{{ route('tickets.index') }}" class="btn btn-danger">Cancelar</a>
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

@section('js')
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
@endsection
