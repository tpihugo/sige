@extends('adminlte::page')
@section('title', 'Crear Oficio Liberación')

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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row ">
                <h2 class="text-center my-3">Crear Oficio Liberación Prestador</h2>
            </div>
            <div>
                <form action="{{ route('oficios.update', $oficio) }}" method="POST" class="row">
                    @method('PUT')
                    @csrf
                    <div class="my-1 col-sm-12 col-md-1">
                        <label for="num_oficio" class=" text-center">Oficio CTA</label>
                        <input type="text" class="text-center form-control" name="num_oficio" id="num_oficio"
                            value="{{ $oficio->num_oficio }}">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="dirigido">Dirigido</label>
                        <input type="text" placeholder="Dirigido" value="{{ $oficio->dirigido }}" class="form-control"
                            name="dirigido" id="dirigido">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="atencion">Atención</label>
                        <input type="text" placeholder="Atención" value="{{ $oficio->atencion }}" class="form-control"
                            name="atencion" id="atencion">
                    </div>

                    <span class="text-muted my-1"><small>NOTA: Favor de introducir nombres completos del personal</small>
                    </span>
                    <hr>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="nombre">Nombre</label>
                        <input type="text" placeholder="Nombre del prestador" value="{{ $oficio->nombre }}"
                            class="form-control" name="nombre" id="nombre">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="carrera">Carrera</label>
                        <input type="text" placeholder="Carrera del prestador" value="{{ $oficio->carrera }}"
                            class="form-control" name="carrera" id="carrera">
                    </div>

                    <div class="my-1 col-sm-12 col-md-2">
                        <label for="codigo">Código</label>
                        <input type="text" placeholder="Código del prestador" class="form-control" name="codigo"
                            value="{{ $oficio->codigo }}"id="codigo">
                    </div>


                    <div class="my-1 col-sm-12 col-md-2">
                        <label for="tipo">Tipo de prestación</label>
                        <select class="form-control" id="tipo" name="tipo_prestacion">
                            <option value="{{ $oficio->tipo_prestacion }}" selected>{{ $oficio->tipo_prestacion }}</option>
                            <option value="Estadias">Estadias</option>
                            <option value="Practicas Profecionales">Practicas Profecionales</option>
                            <option value="Servicio Social">Servicio Social</option>
                        </select>
                    </div>

                    <div class="my-1 col-sm-12 col-md-3">
                        <label for="oficio">Núm. Oficio de procedencia.</label>
                        <input type="text" placeholder="Ejemplo: 0000/CUCEI/2023B" class="form-control"
                            value="{{ $oficio->oficio }}" name="oficio" id="oficio">
                    </div>

                    <div class="my-1 col-sm-12 col-md-7">
                        <label for="programa">Programa.</label>
                        <input type="text" placeholder="Programa" class="form-control" name="programa"
                            value="{{ $oficio->programa }}" id="programa">
                    </div>

                    <div class="my-1 col-sm-12 col-md-2">
                        <label for="programa">Fecha de Inicio.</label>
                        <input type="date" required class="form-control" name="fecha_inicio"
                            value="{{ $oficio->fecha_inicio }}" id="fecha_inicio">
                    </div>


                    <div class="my-1 col-sm-12 col-md-2">
                        <label for="fecha_fin">Fecha de Fin.</label>
                        <input type="date" required class="form-control" name="fecha_fin"
                            value="{{ $oficio->fecha_fin }}" id="fecha_fin">
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="my-2 btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        @else
            El periodo de Registro de Proyectos a terminado
        @endif
    </div>
@endsection
