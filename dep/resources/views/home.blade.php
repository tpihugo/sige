@extends('layout.plantilla')
@section('titulo', 'Inicio')

@section('content')
    <div class="row justify-content-center mt-5">
        <a href="{{ route('libros.index') }}" class="text-center btn bg-dark m-1 col-sm-12 col-md-4">
            <div class="card text-white  bg-dark">
                <div class="card-body">
                    <h2><i class="bi bi-book"></i> Libros</h2>
                </div>
            </div>
        </a>
        <a href="{{ route('revistas.index') }}" class=" text-center btn bg-dark m-1 col-sm-12 col-md-3">
            <div class="card  text-white bg-dark">
                <div class="card-body">
                    <h2><i class="bi bi-book"></i> Revistas</h2>
                </div>
            </div>
        </a>
        <a href="{{ route('bibliografia_digital.index') }}" class="text-center btn m-1 bg-dark col-sm-12 col-md-4">
            <div class="card text-white  bg-dark">
                <div class="card-body">
                    <h2><i class="bi bi-book"></i> Bibliografia Digital</h2>
                </div>
            </div>
        </a>
    </div>


    <br>

    <div class="row justify-content-center">
	@if(Auth::user()->rol == '0')
        <a href="{{ route('cuadernos.index') }}" class="text-center btn m-1 bg-dark col-sm-12 col-md-5">
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <h2><i class="bi bi-book"></i> Cuadernos</h2>
                </div>
            </div>
        </a>
	@endif
        @if (Auth::user()->rol == '2' || Auth::user()->rol == '1')
        <a href="{{ route('cuadernos.index') }}" class="text-center btn m-1 bg-dark col-sm-12 col-md-3">
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <h2><i class="bi bi-book"></i> Cuadernos</h2>
                </div>
            </div>
        </a>
            @if (Auth::user()->rol == '2')
                <a href="{{ route('usuario.index') }}" class=" text-center btn m-1 bg-dark col-sm-12 col-md-5">
                    <div class="card text-white  bg-dark">
                        <div class="card-body">
                            <h2><i class="bi bi-person-circle"></i> Usuarios</h2>
                        </div>
                    </div>
                </a>
            @endif
            <a href="{{ route('prestamos.index') }}" class=" text-center btn m-1 bg-dark col-sm-12 col-md-3">
                <div class="card text-white  bg-dark">
                    <div class="card-body">
                        <h2>Prestamos</h2>
                    </div>
                </div>
            </a>
        @endif
    </div>

@endsection
