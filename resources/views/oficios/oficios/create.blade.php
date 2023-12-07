@extends('adminlte::page')
@section('title', 'Crear Oficio Liberación')

@section('css')
    @include('layouts.head_2')
@stop
@section('content')
    <script src="https://cdn.tiny.cloud/1/83792vt0p2ntv8uaehq9hr5zxl05u8zv8n7fkyza9xnw4hqn/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#cuerpo',
            width: "100%",
            height: 500,
            menubar: false, // removes the menubar
        });
    </script>
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
                <h2 class="text-center my-3">Crear Oficio</h2>
            </div>
            <div>
                <form action="{{ route('oficios.store') }}" method="POST" class="row">
                    @csrf

                    <div class="my-1 col-sm-12 col-md-2">
                        <label for="num_oficio" class=" text-center">Oficio CTA</label>
                        <input type="text" class="text-center form-control" name="num_oficio" id="num_oficio"
                            value="{{ old('num_oficio') }}">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="dirigido">Dirigido</label>
                        <input type="text" placeholder="Dirigido" value="{{ old('dirigido') }}" class="form-control"
                            name="dirigido" id="dirigido">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="puesto_dirigido">Puesto Dirigido</label>
                        <input type="text" placeholder="Puesto a quien va dirigido" value="{{ old('puesto_dirigido') }}"
                            class="form-control" name="puesto_dirigido" id="puesto_dirigido">
                    </div>

                    <div class="my-1 col-sm-12 col-md-2">
                        <label for="centro_universitario">Centro Universitario</label>
                        <input type="text" placeholder="C.U." value="{{ old('centro_universitario') }}"
                            class="form-control" name="centro_universitario" id="centro_universitario">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="atencion">Atención</label>
                        <input type="text" placeholder="Puesto a quien va en Atención" value="{{ old('atencion') }}"
                            class="form-control" name="atencion" id="atencion">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="atencion">Puesto Atención</label>
                        <input type="text" placeholder="Atención" value="{{ old('puesto_atencion') }}"
                            class="form-control" name="puesto_atencion" id="puesto_atencion">
                    </div>


                    <span class="text-muted my-1"><small>NOTA: Favor de introducir nombres completos del personal</small>
                    </span>

                    <hr>
                    <div class="col-md-12 p-2 ">
                        <label class="form-label" for="">Descripción</label>
                        <textarea class="form-control" name="cuerpo" placeholder="Cuerpo del oficio" id="cuerpo">{{ old('cuerpo') }}</textarea>
                    </div>
                    <div id="formulario">

                    </div>
                    <div>
                        <button type="button" id="agregar" class="clonar btn btn-secondary btn-sm">+</button>
                        <label for="agregar">Agregar C.C.</label>
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

@section('footer')
    <div class="row g-3 align-items-center">
        <h5 class="text-end">En caso de inconsistencias, favor de reportarlas.</h5>
    </div>
@endsection
@section('js')
    <script>
        var cont = 0;

        function eliminar(eliminar) {
            let elemento = document.getElementById(eliminar);
            elemento.parentNode.removeChild(elemento);
        }

        $('.clonar').click(function() {
            // Clona el .input-group
            //let $clone = $('#formulario .input-group').last().clone();
            let form = document.getElementById('formulario');
            let arreglo = ['con_copia[]'];

            var div = document.createElement("div");
            var span = document.createElement("span");
            span.className = "btn btn-danger";


            span.className = "btn btn-danger m-1";
            span.textContent = 'X';
            let numero = cont;
            span.addEventListener("click", function() {
                eliminar(numero)
            }, false);

            let status = ['C.C.'];
            arreglo.forEach(function(element) {

                if (element == 'status[]') {
                    var input = document.createElement("select");
                    input.name = element;
                    input.className = "form-control col-md-3 m-1";
                    input.setAttribute("id", 'enfermedades');
                    div.appendChild(input);

                    for (var i = 0; i < status.length; i++) {
                        var option = document.createElement("option");
                        option.value = status[i];
                        option.text = status[i];
                        input.appendChild(option);
                    }

                } else {
                    var input = document.createElement("input");
                    input.type = "text";
                    input.name = element;
                    input.placeholder = element.split('[]')[0];

                    if (element.split('[]')[0] == 'descripcion') {
                        input.className = "form-control col-md-5 m-1";
                        console.log(input);
                    } else {
                        input.className = "form-control col-md-3 m-1";
                    }

                    input.setAttribute("id", 'articulos');

                    div.appendChild(input);
                }
            });
            div.setAttribute('id', cont);
            div.className = 'input-group d-flex flex-wrap';
            cont = cont + 1;
            div.appendChild(span);
            form.appendChild(div);

        });
    </script>
@endsection
