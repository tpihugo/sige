@extends('layouts.app')
@section('content')
    <div class="container">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>

                </div>
            @endif
            <div class="row">
                <div class="col-md-auto ml-3">
                    <h2>Edici&oacute;n de Plazas</h2>
                </div>
                <hr>
            </div>

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('plazas.update', $plaza->id) }}" method="post" enctype="multipart/form-data"
                        class="col-12">
                        {!! csrf_field() !!}
                        {{ method_field('PUT') }}
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
                        <div class="row align-items-center mt-4">
                            <div class="col-md-8 col-sm-12">
                                <label class="font-weight-bold" for="plaza">Plaza *</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    value="{{ $plaza->nombre }}" spellcheck="true">
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label class="font-weight-bold" for="carga_horaria">Carga Horaria *</label>
                                <input type="number" class="form-control" id="carga_horaria" name="carga_horaria"
                                    value="{{ $plaza->carga_horaria }}">
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-1 col-sm-12">
                                <label class="font-weight-bold" for="activo">Activo *</label>
                                <input type="text" class="form-control" id="activo" name="activo"
                                    value="{{ $plaza->activo }}">
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
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
            <div class="row align-items-center">

                <br>
                <hr>
                <h5>Coordinación de Tecnologías para el Aprendizaje. CUCSH</h5>


            </div>
    </div>
@else
    El periodo de Registro de Proyectos a terminado
    @endif

@endsection
