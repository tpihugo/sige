@extends('layout.plantilla')
@section('titulo', 'Resgistro - Bibliografia Digital')

@section('content')
    <form class="row justify-content-beetwen" action="{{ route('bibliografia_digital.create') }}" method="POST">
        @csrf
        <div class="col-12">
            <label for="" class="form-label">Titulo</label>
            <input type="text" class="form-control" name="titulo">
        </div>

        <div class="col-12">
            <label for="" class="form-label">Autor</label>
            <input type="text" class="form-control" name="autor">
        </div>

        <div class="col-12">
            <label for="" class="form-label">Clasificación</label>
            <input type="text" class="form-control" name="clasificacion">
        </div>

        <div class="col-12">
            <label for="" class="form-label">Año</label>
            <input type="text" class="form-control" name="anio">
        </div>

        <div class="col-12 m-2 ">
            <button type="submit" class="btn btn-success col-sm-3">Registrar</button>
            <a class="btn btn-outline-dark col-sm-3" href="{{ route('bibliografia_digital.index') }}">Regresar</a>
        </div>

    </form>

@endsection
