@extends('layout.plantilla')
@section('titulo', 'Mostrar - Bibliografia Digital')


@section('content')
    <h3><b>Titulo</b><br>{{ $bibliografia->titulo }}</h3>
    <h5><b>Autor</b><br>{{ $bibliografia->autor }}</h5>
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <span><b>Clasificación</b><br>{{ $bibliografia->clasificacion }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Año</b> <br>{{ $bibliografia->anio }}</span>
        </div>
    </div>
    <br>
    @if (Auth::user()->rol == '2' or Auth::user()->rol == '1')
        <a href="{{ route('bibliografia_digital.edit', $bibliografia->id) }}"
            class="btn btn-success col-sm-2">Editar</a>
    @endif
    <a class="btn btn-outline-dark col-sm-2"
                href="{{ route('bibliografia_digital.index') }}">Regresar</a>
@endsection()
