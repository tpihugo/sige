@extends('adminlte::page')
@section('title', 'Solicitantes')

@section('css')
    @include('layouts.head_2')
@stop
@section('content')
    <div class="container">
        @if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'auxiliar' || Auth::user()->role == 'cta'))
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>

                </div>
            @endif

            <div class="row">
                <div class="col-md-auto ml-3">
                    <h2>Captura de solicitante</h2>
                </div>
                <hr>
            </div>

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('solicitantes.store') }}" method="post" enctype="multipart/form-data"
                        class="col-12">
                        {!! csrf_field() !!}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    Debe de llenar los campos marcados con un asterisco (*).
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <br>
                        <div class="row align-items-center">

                            <div class="col-md-12">
                                <label class="font-weight-bold form-label" for="nombre">Nombre del solicitante </label>
                                <input name="nombre" id="nombre" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label class="font-weight-bold form-label" for="contacto_principal">Contacto
                                    principal</label>
                                <input name="contacto_principal" id="contacto_principal" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label class="font-weight-bold form-label" for="contacto_secundario">Contacto
                                    secundario</label>
                                <input name="contacto_secundario" id="contacto_secundario" class="form-control">
                            </div>
                                <div class="col-md-12">
                                    <label for="rol">Rol</label>
                                    <select class="form-control" class="form-control" id="js-example-basic-single"
                                        name="rol" required>
                                        <option disable selected value="">Selecciona una rol</option>
                                        <option value="1">1. Académico</option>
                                        <option value="2">2. Administrativo</option>
                                        <option value="3">3. Rectoría</option>
                                        <option value="4">4. Jefatura</option>
                                        <option value="5">5. Alumno</option>                                           
                                    </select>
                                </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                    <label for="area_principal">Área principal</label>
                                    <select class="form-control" class="form-control" id="js-example-basic-single"
                                        name="area_principal" required>
                                        <option disable selected value="">Selecciona una área</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->sede }} - {{ $area->area }} -
                                                {{ $area->edificio }} - {{ $area->piso }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </br>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <a href="{{ route('tickets.index') }}" class="btn btn-danger">Cancelar</a>
                                <button type="submit" class="btn btn-success">
                                    Guardar datos
                                    <i class="ml-1 fas fa-save"></i>
                                </button>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
            <br>
    </div>
@else
    Accceso no autorizado
    @endif

@endsection

@section('js')
    @include('layouts.scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#js-example-basic-single').select2({
                theme: "bootstrap-5"
            });
        });
    </script>
@endsection
