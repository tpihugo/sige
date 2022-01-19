@if (Auth::user()->rol == 'Administrador')

    @extends('layouts.plantillabase')


    @section('contenido')


        <div class="container g-4  p-5 text-center rounded h1">
            {{ $materials->titulo }}
        </div>
        <div class="container g-4 shadow-lg p-5 mb-5  rounded">
            <form action="{{ route('material.update', $materials->id) }}" method="POST">

                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="titulo" class="form-label">Titúlo</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="Titúlo"
                        value="{{ $materials->titulo }}">

                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion"
                        aria-describedby="Descripción" value="{{ $materials->descripcion }}">

                </div>
                <div class="mb-3">
                    <label for="formato" class="form-label">Formato</label>
                    <input type="text" class="form-control" name="formato" id="formato" aria-describedby="Formato"
                        value="{{ $materials->formato }}">

                </div>
                <div class="mb-3">
                    <label for="etiqueta" class="form-label">Etiqueta</label>
                    <input type="text" class="form-control" name="etiqueta" id="etiqueta" aria-describedby="Etiqueta"
                        value="{{ $materials->etiqueta }}">

                </div>
                <div class="mb-3">
                    <label for="tipo_material" class="form-label">Tipo de material</label>

                    <select name="tipo_material" id="tipo_material" class="form-select form-select-lg mb-3"
                                    aria-describedby="Tipo de material"  Required>
                                    <option value="{{ $materials->tipo_material }}" selected >{{ $materials->tipo_material }}</option>
                                    <option value="Conferencia">Conferencia</option>
                                    <option value="Clase magistral">Clase magistral</option>
                                    <option value="Video conferencia">Video conferencia</option>
                                    <option value="Foro">Foro</option>
                                    <option value="Transmisión en vivo">Transmisión en vivo</option>
                                </select>

                </div>                <div class="mb-3">
                    <label for="duracion" class="form-label">Duración</label>
                    <input type="text" class="form-control" name="duracion" id="duracion" aria-describedby="Duración"
                        value="{{ $materials->duracion }}">

                </div>
                <div class="mb-3">
                    <label for="anio_publicacion" class="form-label">Año de publicación</label>
                    <input type="date" class="form-control" name="anio_publicacion" id="anio_publicacion"
                        aria-describedby="Año de publicación" value="{{ $materials->anio_publicacion }}">


                </div>
                <div class="mb-3">
                    <label for="participantes" class="form-label">Participantes</label>
                    <input type="text" class="form-control" name="participantes" id="participantes"
                        aria-describedby="Participantes" value="{{ $materials->participantes }}">
                </div>
                <a href="{{ route('material.index') }}" class="btn btn-secondary" tabindex="5">Cancelar</a>
                <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
            </form>
        </div>


    @endsection
@else
    <script>
        window.location.replace("http://sige.cucsh.udg.mx/mediateca/public/home");
    </script>
@endif
