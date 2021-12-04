@extends('layouts.plantillabase')


@section('contenido')
<form action="" method="POST">
@csrf
  <div class="mb-3">
    <label for="titulo" class="form-label">Titúlo</label>
    <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="Titúlo">

  </div>
  <div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="Descripción">

  </div>
  <div class="mb-3">
    <label for="formato" class="form-label">Formato</label>
    <input type="text" class="form-control" name="formato" id="formato" aria-describedby="Formato">

  </div>
  <div class="mb-3">
    <label for="etiqueta" class="form-label">Etiqueta</label>
    <input type="text" class="form-control" name="etiqueta" id="etiqueta" aria-describedby="Etiqueta">

  </div>
  <div class="mb-3">
    <label for="tipo_material" class="form-label">Tipo de material</label>
    <input type="text" class="form-control" name="tipo_material" id="tipo_material" aria-describedby="Tipo de material">

  </div>
  <div class="mb-3">
    <label for="duracion" class="form-label">Duración</label>
    <input type="text" class="form-control" name="duracion" id="duracion" aria-describedby="Duración">

  </div>
  <div class="mb-3">
    <label for="anio_publicacion" class="form-label">Año de publicación</label>
    <input type="date" class="form-control" name="anio_publicacion" id="anio_publicacion" aria-describedby="Año de publicación">

  </div>
  <div class="mb-3">
    <label for="participantes" class="form-label">Participantes</label>
    <input type="text" class="form-control" name="participantes" id="participantes" aria-describedby="Participantes">
  </div>
  <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
</form>


@endsection
