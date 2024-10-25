@extends('adminlte::page')
@section('title', 'Home')

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
                <h2 class="mt-3">Edición de ticket folio {{ $ticket->id }}</h2>
                <p>Creado el: {{ \Carbon\Carbon::parse($ticket->creado)->format('d/m/Y H:i') }}</p>
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
            <form action="{{ route('tickets.update', $ticket->id) }}" method="post" enctype="multipart/form-data"
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
                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="estatus">Estatus</label>
                                <select class="form-control" class="form-control" id="js-example-basic-single"
                                    name="estatus" required>
                                    <option value="{{ $ticket->estatus }}" selected>
                                        @if ($ticket->estatus='1')
                                            Abierto
                                        @else
                                            Cerrado
                                        @endif
                                    </option>
                                        <option value="1">Abierto</option>
                                        <option value="0">Cerrado</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="area_id">Área</label>
                                <select class="form-control" class="form-control" id="js-example-basic-single"
                                    name="area_id" required>
                                    <option value="{{ $ticket->area_id }}" selected>{{ $ticket->area }}</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->sede }} - {{ $area->area }} -
                                            {{ $area->edificio }} - {{ $area->piso }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <label for="solicitante_id">Solicitante </label>
                                <select class="form-control" id="js-example-basic-single2" name="solicitante_id" required>
                                    <option value="{{ $ticket->solicitante_id }}" selected>{{ $ticket -> solicitante }}</option>
                                    @foreach ($solicitantes as $solicitante)
                                        <option value="{{ $solicitante->id }}">{{ $solicitante->nombre }} - {{ $solicitante->contacto_principal}}  </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tecnico_id">Técnico </label>
                                <select class="form-control" id="js-example-basic-single2" name="tecnico_id" required>
                                    <option value="{{ $ticket->tecnico_id }}" selected>{{ $ticket -> tecnico }}</option>
                                    @foreach ($tecnicos as $tecnico)
                                        <option value="{{ $tecnico->id }}">{{ $tecnico->nombre }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <label for="servicio_id">Servicio </label>
                                <select class="form-control" id="js-example-basic-single2" name="servicio_id" required>
                                    <option value="{{ $ticket->servicio_id }}" selected>{{ $ticket -> nombre_servicio }}</option>
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
                                <textarea class="form-control" id="datos_reporte" name="datos_reporte">{{ $ticket->datos_reporte }} </textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <a href="{{ route('tickets.index') }}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar datos</button>
                        </div>
                    </div>
                </div>
            </form>
    </div>
@else
    El periodo de Registro de tickets a terminado
    @endif


@endsection
@section('footer')
    <div class="row g-3 align-items-center">
        <h5 class="text-end">En caso de inconsistencias, favor de reportarlas.</h5>
    </div>
@endsection
