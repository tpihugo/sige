@extends('layout.plantilla')
@section('titulo', 'Registro - Prestamo')

@section('content')
    <form class="row" action="{{ route('prestamos.create') }}" method="post">
        @csrf
        <div class="col-12">
            <label class="form-label" for="clasificacion">
                <h3>Clasificación</h3>
            </label>
            <input class="form-control col-5" type="text" name="calsificacion" readonly id="calsificacion"
                value="{{ $clasificacion }}">
        </div>
        <div class="col-12">
            <br />
            <label class="form-label" for="clasificacion">
                <h4>Tipo</h4>
            </label>
            <input class="form-control col-5" type="text" name="tipo" readonly id="tipo" value="{{ $tipo }}">
        </div>
        <div class="col-12">
            <br />
            <label class="form-label" for="clasificacion">
                <h4>Fecha Prestamo</h4>
            </label>
            <input class="form-control col-5" type="date" name="fecha_prestamo" id="fecha_prestamo">
            @error('fecha_prestamo')
            <small>{{$message}}</small>
            <br>
            @enderror
        </div>

        <div class="col-12">
            <br />
            <label class="form-label" for="clasificacion">
                <h4>Prestado A</h4>
            </label>
            <input class="form-control col-8" type="text" name="nombre" id="nombre" placeholder="Nombre completo">
            @error('nombre')
            <small>{{$message}}</small>
            <br>
            @enderror
            <input class="form-control col-8" type="email" name="email" id="email" placeholder="Correo">
            @error('email')
            <small>{{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="col-12">
            <br />
            <button type="submit" class="btn btn-success col-2">Registrar Prestamo</button>
        </div>

    </form>
@endsection
