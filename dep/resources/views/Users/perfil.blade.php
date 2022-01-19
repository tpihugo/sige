@extends('layout.plantilla')
@section('titulo', 'Perfil')

@section('content')
    <br />
    @if (Session::has('message'))
        <div class="text-danger">
            {{ Session::get('message') }}
        </div>
    @endif
    @if (Session::has('status'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('status') }}
        </div>
    @endif
    <div class="container
    ">
        <h5>
            @if ($usuario->rol == '0')
                <?php $rol = 'General'; ?>
            @endif
            @if ($usuario->rol == '1')

                <?php $rol = 'Trabajador UDG'; ?>
            @endif
            @if ($usuario->rol == '2')
                <?php $rol = 'Adminsitrador'; ?>
            @endif
        </h5>
    </div>

    <form class="row align-items-center" action="{{ route('usuario.change_password') }}" method="post">

        @csrf
        @method('PUT')
        <div class="col-sm-12">
            <hr class="border border-2 border-dark">
            <h5>Datos Generales</h5>

        </div>

        <div class="col-sm-12   m-1">
            <label for="" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="{{ Auth::user()->name }}">
        </div>
        <div class="col-sm-12 ">
            <h5 class="mt-1">
                <label for="" class="form-label">Rol</label><br />
                <label for="" class="form-label">{{ $rol }}</label>
            </h5>
        </div>
        <div class="col-sm-12   m-1">
            <label for="" class="form-label">Email</label>
            <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}">
        </div>

        <div class="col-sm-12 m-1 p-2">
            <hr class="border border-2 border-dark">
            <h5>Cambiar contraseña</h5>
        </div>
        <div class="col-sm-12 col-md-4  m-1 p-1">
            <input type="password" name="password" class="form-control" placeholder="Contraseña Nueva">
            @error('password')
                <small>{{ $message }}</small>
            @enderror
        </div>
        <div class="col-sm-12 col-md-4 m-1">
            <input type="password" name="password_confirmation" class="form-control " placeholder="Confirmar Contraseña">
            @error('password_confirmation')
                <small>{{ $message }}</small>
            @enderror
        </div>
        <div class="col-sm-12 col-md-2 m-1">
            <button type="submit" class="btn btn-success w-100">Cambiar contraseña</button>
        </div>
    </form>


@endsection
