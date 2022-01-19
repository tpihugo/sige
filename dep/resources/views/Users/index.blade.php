@extends('layout.plantilla')
@section('titulo', 'Usuarios')

@section('content')
    <div class="row d-flex justify-content-end">
        <a href="{{ route('usuario.registro') }}" class="btn btn-primary">Registrar Usuario</a>
    </div>
    <br />
    <div class="row justify-content-center">
        <form class="row col-md-8 col-sm-12" id="form-busqueda" action="{{route('usuarios.search')}}" method="POST">
            @csrf
            <div class="col-sm-12 col-md-6">
                <input type="text" placeholder="Nombre" class="form-control" name="nombre">
                @error('nombre')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-12 col-md-4">
                <button type="submit" class="btn btn-dark w-100">Buscar</button>
            </div>
        </form>

    </div>
    <script>
        if (!!window.performance && window.performance.navigation.type === 2) {
            // value 2 means "The page was accessed by navigating into the history"
            console.log('Reloading');
            window.location.reload(); // reload whole page

        }
    </script>
@endsection
