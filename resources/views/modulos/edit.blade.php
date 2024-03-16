@extends('adminlte::page')
@section('title', 'Modulos')

@section('css')
    @include('layouts.head_2')

@stop
@section('content')
    <div class="container">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>
                </div>
            @endif
            <div class="row mt-3">
                <h2 class="text-center">Editar Modulo</h2>
            </div>
            <div class=" my-2">
                <form action="{{ route('modulos.update', $modulo->id) }}" class="d-flex align-items-center flex-wrap"
                    method="post">
                    @method('PUT')
                    @csrf
                    <div class="mx-1">
                        <input type="text" placeholder="Nombre" name="nombre" value="{{ $modulo->nombre }}"
                            class="form-control">
                    </div>
                    <div class="mx-1">
                        <input type="text" placeholder="Nombre permiso" name="nombre_permiso"
                            value="{{ $modulo->nombre_permiso }}" class="form-control">
                    </div>
                    <div class="mx-1">
                        <input type="text" placeholder="Icono" name="icono" value="{{ $modulo->icono }}"
                            class="form-control">
                    </div>
                    <div class="mx-1">
                        <input type="number" placeholder="Orden de ubicación" name="orden" class="form-control"
                            value="{{ $modulo->orden }}">
                    </div>
                    <div class="mx-1">
                        <input type="color" placeholder="Color" name="color" value="{{ $modulo->color }}"
                            class="form-control form-control-color">
                    </div>

                    <div class="col-12 my-2">
                        <div id="formulario">
                            @if (strcmp($enlaces, '-') != 0)
                                @foreach ($enlaces as $item)
                                    <div class="input-group d-flex flex-wrap" id="{{ $item->id }}">
                                        <input type="text" class="form-control col-md-3 m-1" name="titulo[]"
                                            value="{{ $item->titulo }}">

                                        <input type="text" class="form-control col-md-3 m-1" name="enlaces[]"
                                            value="{{ $item->enlace }}">

                                        <input type="text" class="form-control col-md-3 m-1" name="parametros[]"
                                            value="{{ $item->parametro }}">

                                        <input type="text" class="form-control col-md-3 m-1" name="estilos[]"
                                            value="{{ $item->estilos }}">

                                        <a class="btn btn-danger btn-sm m-1 d-flex align-items-center"
                                            onclick="eliminar('{{ $item->id }}')"><span class="material-icons"
                                                style="display: flex; align-items: center;">
                                                toggle_off
                                            </span></a>

                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div>
                            <button type="button" id="agregar" class="clonar btn btn-secondary btn-sm">+</button>
                            <label for="agregar">Agregar enlace al modulo</label>
                        </div>
                    </div>

                    <div class="mx-1">
                        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                    </div>

                </form>
            </div>
        @else
            No tienes permisos para acceder a este apartado
        @endif
    </div>
@endsection

@section('js')
    @include('sweetalert::alert')
    <script>
        var cont = 0;
        $('.clonar').click(function() {
            let form = document.getElementById('formulario');
            let arreglo = ['titulo[]', 'enlaces[]', 'parametros[]', 'estilos[]'];

            var div = document.createElement("div");
            var span = document.createElement("span");
            var enlace = document.createElement("a");

            enlace.className = "btn btn-danger btn-sm m-1 d-flex align-items-center";

            span.className = "material-icons";
            span.textContent = 'toggle_off';
            span.style = "display: flex;align-items: center;";

            let numero = cont;

            span.addEventListener("click", function() {
                eliminar(numero)
            }, false);
            arreglo.forEach(function(element) {
                var input = document.createElement("input");
                input.type = "text";
                input.name = element;
                input.placeholder = element.split('[]')[0].toUpperCase();

                input.className = "form-control col-md-3 m-1";
                div.appendChild(input);

            });
            div.setAttribute('id', cont);
            div.className = 'input-group d-flex flex-wrap';
            cont = cont + 1;
            enlace.appendChild(span)
            div.appendChild(enlace);
            form.appendChild(div);

        });

        async function eliminar(item) {
            let elemento = document.getElementById(item);
            let padre = elemento.parentNode;
            padre.removeChild(elemento);
            var url = "{{ route('eliminar.enlace') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    'id': item
                }
            }).done(function(data) {
                location.reload();
            });
        }

        async function activar(item) {
            var elemento = document.getElementById(item);
            var url = "{{ route('activar.enlace') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    'enlace': item,
                    'modulo_id': "{{ $modulo->id }}"
                }
            }).done(function(data) {
                location.reload();
            });
        }
    </script>
@endsection
