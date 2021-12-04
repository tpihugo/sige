@extends('layouts.plantillabase')

@section('contenido')

<div class="container g-4  p-5 text-center rounded h1" >
{{$usuario->name}}
</div>
<div class="container g-4 shadow-lg p-5 mb-5  rounded" >
<form action="{{route('profiles.update',$usuario->id)}}" method="POST">

@csrf
@method('PUT')
  <div class="mb-3">
    <label for="titulo" class="form-label">Nombre</label>
    <input type="text" class="form-control" name="name" id="name" aria-describedby="name" value="{{$usuario->name}}">

  </div>
  <div class="mb-3">
    <label for="descripcion" class="form-label">Correo</label>
    <input type="text" class="form-control" name="email" id="email" aria-describedby="email" value="{{$usuario->email}}">

  </div>
  <div class="mb-3">
    <label for="descripcion" class="form-label">Rol</label>
    <select name="rol" id="rol" class="form-control">
        <option value="Administrador" {{ $usuario->rol == 'Administrador' ? 'selected' : '' }}>Administrador</option>
        <option value="Estudiante" {{ $usuario->rol == 'Estudiante' ? 'selected' : '' }}>Estudiante</option>
    </select>

  </div>
  <a href="{{route('profile.index')}}" class="btn btn-secondary" tabindex="5">Cancelar</a>
  <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
</form>
</div>


@endsection
