@extends('adminlte::page')
@section('title', 'Editar Oficio')

@section('css')
    @include('layouts.head_2')
    @php
        $ruta = asset('js/es_MX.js');
    @endphp
<script src="https://cdn.tiny.cloud/1/hxrvn0kxyxx274tvb7b2a0ruwwvc0kpe8d59dle7zc9ggndh/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>    <script>
        tinymce.init({
            selector: 'textarea.cuerpo',
            language: 'es_MX',
            language_url: '{{ $ruta }}',
            width: "100%",
            height: 500,
            plugins: 'table',
            menubar: true, // removes the menubar
        });
    </script>
@stop
@section('content')
    <div class="container">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row ">
                <h2 class="text-center my-3">Editar Oficio</h2>
            </div>
            <div>
                <form action="{{ route('oficios.update', $oficio->id) }}" method="POST" class="row justify-content-center">
                    @csrf
                    @method('PUT')
                    <div class="my-1 col-sm-12 col-md-2">
                        <label for="num_oficio" class=" text-center">Oficio CTA</label>
                        <input type="text" class="text-center form-control" name="num_oficio" id="num_oficio"
                            value="{{ $oficio->num_oficio }}">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="dirigido">Dirigido</label>
                        <input type="text" placeholder="Dirigido" value="{{ $oficio->dirigido }}" class="form-control"
                            name="dirigido" id="dirigido">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="puesto_dirigido">Puesto Dirigido</label>
                        <input type="text" placeholder="Puesto a quien va dirigido"
                            value="{{ $oficio->puesto_dirigido }}" class="form-control" name="puesto_dirigido"
                            id="puesto_dirigido">
                    </div>

                    <div class="my-1 col-sm-12 col-md-2">
                        <label for="centro_universitario">Centro Universitario</label>
                        <input type="text" placeholder="C.U." value="{{ $oficio->centro_universitario }}"
                            class="form-control" name="centro_universitario" id="centro_universitario">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="atencion">Atención</label>
                        <input type="text" placeholder="Puesto a quien va en Atención" value="{{ $oficio->atencion }}"
                            class="form-control" name="atencion" id="atencion">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="atencion">Puesto Atención</label>
                        <input type="text" placeholder="Atención" value="{{ $oficio->puesto_atencion }}"
                            class="form-control" name="puesto_atencion" id="puesto_atencion">
                    </div>
                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="atencion">Asunto</label>
                        <input type="text" placeholder="Asunto del oficio"
                            value="{{ $oficio->asunto }}" class="form-control" name="asunto"
                            id="asunto">
                    </div>
                    <span class="text-muted my-1"><small>NOTA: Favor de introducir nombres completos del personal</small>
                    </span>
                    <hr>
                    <div class="col-md-12 p-2 ">
                        <label class="form-label" for="">Descripción</label>
                        <textarea class="form-control cuerpo" name="cuerpo" placeholder="Cuerpo del oficio" id="oficio">
                            {!! $oficio->cuerpo !!}                            
                        </textarea>
                    </div>

                    <div id="formulario">
                        @if (strcmp($oficio->con_copia, '-') != 0)
                            @php
                                $temp = explode('@', $oficio->con_copia);
                            @endphp
                            @foreach (collect($temp) as $item)
                                <div class="input-group d-flex flex-wrap" id="{{ $item }}">
                                    <input type="text" class="form-control col-md-3 m-1" name="con_copia[]"
                                        value="{{ $item }}">
                                    <span class="btn  btn-danger m-1" onclick="eliminar('{{ $item }}')">X</span>
                                    <br>
                                </div>
                            @endforeach
                        @endif

                    </div>
                    <div>
                        <button type="button" class="clonar btn btn-secondary btn-sm">+</button>
                        <label for="con_copia">Agregar C.C.</label>
                    </div>

                    <div class="col-sm-12">
                        <button type="submit" class="my-2 btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        @else
            El periodo de Registro de Proyectos a terminado
        @endif
    </div>
@endsection
@if (strcmp($oficio->con_copia, '') != 0)
    @section('js')
        <script>
            var cont = 0;

            function eliminar(eliminar) {
                console.log(eliminar);
                let elemento = document.getElementById(eliminar);
                let padre = elemento.parentNode;
                padre.removeChild(elemento);
            }

            $('.clonar').click(function() {
                // Clona el .input-group
                //let $clone = $('#formulario .input-group').last().clone();
                let form = document.getElementById('formulario');
                let arreglo = ['con_copia[]'];

                var div = document.createElement("div");
                var span = document.createElement("span");
                span.className = "btn btn-danger m-1";
                span.textContent = 'X';
                let numero = cont;

                span.addEventListener("click", function() {
                    eliminar(numero)
                }, false);

                let status = ['C.C.'];
                arreglo.forEach(function(element) {

                    var input = document.createElement("input");
                    input.type = "text";
                    input.name = element;
                    input.placeholder = "Con Copia";

                    input.className = "form-control col-md-3 m-1";
                    div.appendChild(input);

                });
                div.setAttribute('id', cont);
                div.className = 'input-group d-flex flex-wrap';
                cont = cont + 1;
                div.appendChild(span);
                form.appendChild(div);

            });
        </script>
    @endsection
@endif
