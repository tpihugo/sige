@extends('adminlte::page')
@section('title', 'Crear Mantenimiento')

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
                <h2 class="text-center border-bottom mb-2 pb-2">Captura de Mantenimiento</h2>
            </div>
            <form action="{{ route('mantenimiento.store') }}" method="post" enctype="multipart/form-data" class="col-12 row">

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

                <div class="row g-3 align-items-center justify-content-center">
                    <div class="col-md-10">
                        <label for="id_area">Área para mantenimiento</label>
                        <select class="form-control" class="form-control" id="js-example-basic-single" name="area_id">
                            <option value="No Aplica" selected>No Aplica</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->sede }} - {{ $area->division }} -
                                    {{ $area->coordinacion }} - {{ $area->area }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-3 align-items-center justify-content-center">
                    <div class="col-md-5">
                        <label for="tecnico_id">Técnico para mantenimiento</label>
                        <select class="form-control" class="form-control" id="js-example-basic-single2" name="tecnico_id">
                            <option value="No Aplica" selected>No Aplica</option>
                            @foreach ($tecnicos as $tecnicos)
                                <option value="{{ $tecnicos->id }}">{{ $tecnicos->nombre }} -
                                    {{ $tecnicos->telefono }} - {{ $tecnicos->telefono_emergencia }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="fecha_mantenimiento">Fecha:</label>
                        <input type="date" class="form-control" id="fecha_mantenimiento" name="fecha_mantenimiento"
                            value="{{ old('fecha_mantenimiento') }}" required>
                    </div>
                </div>
                <div class="row align-items-center justify-content-end mt-2 py-2">
                    <div class="col-auto">
                        <a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
                        <button type="submit" class="btn btn-success">Continuar</button>
                    </div>
                </div>
            </form>
    </div>
@else
    El periodo de Registro de Proyectos a terminado
    @endif


@endsection
@section('footer')
    <h5 class="text-end">En caso de inconsistencias, favor de reportarlas.</h5>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#js-example-basic-single').select2({
                theme: 'bootstrap-5'
            });
            $('#js-example-basic-single2').select2({
                theme: 'bootstrap-5'
            });
            $('#equipos').select2({
                theme: 'bootstrap-5'
            });
        });
    </script>
@endsection
