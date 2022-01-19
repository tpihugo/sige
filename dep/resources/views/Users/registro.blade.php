@extends('layout.plantilla')
@section('titulo', 'Registro - Usuarios')

@section('content')
<h1>Registro de Usuario</h1>
<form class="row justify-content-beetwen" action="{{ route('usuario.create') }}" method="POST">
    @csrf
    <div class="col-12">
        <label for="" class="form-label">Nombre</label>
        <input type="text" class="form-control" name="name">
    </div>

    <div class="col-12">
        <label for="" class="form-label">Correo</label>
        <input type="email" class="form-control" name="email">
    </div>

    <div class="col-12">
        <label for="" class="form-label">Contraseña</label>
        <input type="password" class="form-control" name="password">
    </div>

    <div class="col-12">
        <label for="tipo" class="form-label">Rol</label>
        <select name="tipo" id="tipo" class="form-control">
            <option value="0">General</option>
            <option value="1">Trabajador UdG</option>
            <option value="2">Administrador</option>
        </select>
    </div>
    <div class="col-12 m-2 ">
        <button type="submit" class="btn btn-success col-2">Registrar</button>
    </div>
</form>
@endsection
