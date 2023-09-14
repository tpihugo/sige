@extends('adminlte::page')
@section('title', 'Articulos requisición')

@section('css')
    @include('layouts.head_2')
@stop


@section('content')
    <div class="container">
        @if (Auth::check() &&
                (Auth::user()->role == 'admin' ||
                    Auth::user()->role == 'cta' ||
                    Auth::user()->role == 'auxiliar' ||
                    Auth::user()->role == 'redes'))
            <div class="row ">
                <div class="col-md-12 my-5 border-bottom border-dark pb-3">
                    <h2> Requisición {{ $requisicion }} | Añadir artículos</h2>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Ingresa todos los campos en cada uno de los artículos
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            @endif
            <form action="{{ route('articulos.store') }}" method="POST">
                @csrf

                {{--
                <div class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <label for="" class="form-label">Código</label>
                        <input type="number" name="codigo[]" id="codigo" class="form-control" tabindex="1" required>
                    </div>

                    <div class="col-md-4">
                        <label for="" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad[]" id="cantidad" class="form-control" tabindex="2" required>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Status</label>
                        <select class="form-control" name="status[]" id="status" tabindex="5">
                            <option value="solicitado">SOLICITADO</option>
                            <option value="comprado">COMPRADO NO RECIBIDO EN ALMACEN</option>
                            <option value="almacen">EN ALMACÉN</option>
                            <option value="entregado">ENTREGADO A CTA</option>
                            <option value="instalado">INSTALADO</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row g-3 align-items-center">
                    <div class="col-md-12">
                        <label for="" class="form-label">Descripción</label>
                        <input type="text" name="descripcion[]" id="descripcion" class="form-control" tabindex="3"
                            required>
                    </div>
                </div><br>
                <div class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <label for="" class="form-label">Observación</label>
                        <input type="text" name="observacion[]" id="observacion" class="form-control" tabindex="4"
                            required>
                    </div>

                </div>
                <br> --}}
                <div class="col-md-4 d-none">
                    <label for="" class="form-label">Id Requisición</label>
                    <input class="form-control" type="text" readonly value="{{ $requisicion }}" name="requisicion_id"
                        placeholder="{{ $requisicion }}">
                </div>

                <div id="formulario" >

                </div>
                <div>
                    <button type="button" id="agregar" class="clonar btn btn-secondary btn-sm">+</button>
                    <label for="agregar">Agregar articulo</label>
                </div>

                <button type="submit" class="btn btn-primary" tabindex="9">Guardar</button>
            </form>

    </div>
    @endif
@endsection
@section('footer')
    <h5 class="text-end">En caso de inconsistencias, favor de reportarlas</h5>
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
            let arreglo = ['codigo[]', 'cantidad[]', 'status[]', 'descripcion[]', 'observacion[]'];

            var div = document.createElement("div");
            var span = document.createElement("span");
            span.className = "btn btn-danger";


            span.className = "btn btn-danger m-1";
            span.textContent = 'X';
            let numero = cont;
            span.addEventListener("click", function() {
                eliminar(numero)
            }, false);

            let status = ['solicitado', 'comprado', 'almacen', 'entregado', 'instalado'];

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



            /*
              // Borra los valores de los inputs clonados
              $clone.find(':input').each(function () {
                if ($(this).is('select')) {
                  this.selectedIndex = 0;
                } else {
                  this.value = '';
                }
              });

              $clone.id = (parseInt(Object.keys(anterior)[0]) + 1).toString();
              console.log($clone);
              // Agrega lo clonado al final del #formulario
              $clone.appendTo('#formulario');*/
        });
    </script>
@endsection
