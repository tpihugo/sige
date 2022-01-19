@extends('layout.plantilla')
@section('titulo', 'Prestamos')

@section('content')
<br>
    <div class="row justify-content-between">
        <form class="row col-md-8 col-sm-12" id="form-busqueda" action="{{ route('prestamos.search') }}" method="POST">
            @csrf
            <div class="col-sm-12 col-md-4">
                <select class="form-control" name="buscar_por" id="buscar_por" onChange="cambio()">
                    <option value="" selected>Buscar por</option>
                    <option value="prestado_A">Nombre Prestado A</option>
		    <option value="clasificacion">Clasificaci&oacute;n</option>
                    <option value="fecha_prestamo">Fecha Prestamo</option>
                    <option value="status">Status</option>	
                </select>
                @error('buscar_por')
                    <small>{{ $message }}</small>
                    <br>
                @enderror
            </div>
            <div class="col-sm-12 col-md-4" >
                <div id='valor'>

                </div>
                @error('buscar')
                    <small>{{ $message }}</small>
                    <br>
                @enderror
            </div>
            <div class="col-sm-12 col-md-3">
                <button type="submit" class="w-100 btn btn-dark">Buscar</button>
            </div>

        </form>
        <div class="row">
            <div class="col-sm-12 text-center">
               Total Prestamos Cerrados  <b>{{ $entregados }}</b> Total Prestamos Abiertos <b>{{ $no_entregados }}</b>
               <br/> Total <b>{{$no_entregados + $entregados}}</b>
            </div>
        </div>
    </div>
    <div id="contenedor">

    </div>
    <script>
        if (!!window.performance && window.performance.navigation.type === 2) {
            // value 2 means "The page was accessed by navigating into the history"
            console.log('Reloading');
            window.location.reload(); // reload whole page

        }
        function cambio() {
            let valor = document.getElementById("buscar_por");
            let area = document.getElementById("valor");
            console.log(valor);
            if (area.hasChildNodes()) {
                area.removeChild(area.lastChild);
            }
            if (valor.value == "prestado_A" || valor.value == "clasificacion") {
                var input = document.createElement("input");
                input.type = "text";
                input.name = 'buscar';
                input.placeholder = 'Introduce para buscar';
                input.className = "form-control";
                input.setAttribute("id", 'buscar')
                area.appendChild(input);

            } else if (valor.value == "fecha_prestamo") {
                let date = document.createElement("INPUT");
                date.setAttribute("type", "date");
                date.name = 'buscar';
                date.className = 'form-control';
                date.setAttribute("id", 'buscar')
                area.appendChild(date);

            } else if (valor.value == "status") {
                let select = document.createElement("select");
                select.name = 'buscar';
                select.className = 'form-control';
                let opciones = ['- - -', 'Abierto', 'Cerrado'];
                let valores = ['', 'Abierto', 'Cerrado'];
                for (var i = 0; i < opciones.length; i++) {
                    let option = document.createElement("option");
                    option.text = opciones[i];
                    option.value = valores[i];
                    select.add(option);
                }
                select.setAttribute("id", 'buscar')
                area.appendChild(select);
            }
        }
    </script>
@endsection
