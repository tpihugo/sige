@extends('layouts.app')
@section('content')

    <div class="container">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h4>{{ session('message') }}</h4>

                </div>
            @endif

            <div class="row">
                <div class="col-sm-12">
                    <h2 class="text-center">Bienvenido<br /> {{ $user }}</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <h3>
                        <p>Llaves en uso</p>
                    </h3>
                    @if (isset($llaves_agregadas))
                        @foreach ($llaves_agregadas as $llave)
                            <div class="col-sm-12  col-md-4">
                                <div class="card ">
                                    <div class="card-body">
                                        <h5 class="card-title">ID: {{ $llave->id }} - Área de Llave:
                                            {{ $llave->area }}</h5>
                                        <p class="card-text">Num de LLaves: {{ $llave->num_copias }} <br>
                                            {{ $llave->comentarios }}</p>
                                        <a href="{{ route('devolverllave', $llave->id) }}"
                                            class="btn btn-outline-warning">Devolver Llave</a>
                                    </div>
                                </div>
                        @endforeach
                    @endif
                </div>
            </div>
    </div>
    <div class="col-sm-12">
        <div class="container">


            <div class="row">
                <div class="col-sm-12">
                    <h4 class="text-center">Haz tu búsqueda de llave:</h4>
                </div>
                <div class="col-sm-12">
                    <form action="" class="row" id="form-busqueda">
                        @csrf
                        <div class="col-sm-12">
                            <input class="form-control" type="text" id="buscador" name="buscador">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div id="contenedor"></div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <h3 class="text-center">Llaves Disponibles:</h3>
            
        </div>
        <div class="col-sm-12">
            @if (isset($llaves_disponibles))
                <div class="container">
                    <div class="row p-2">
                        @foreach ($llaves_disponibles as $llave)
                            <div class="col-sm-4 p-1 m-0">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">ID: {{ $llave->id }} - Área de Llave: {{ $llave->area }}
                                        </h5>
                                        <p class="card-text">Num de LLaves: {{ $llave->num_copias }} <br>
                                            {{ $llave->comentarios }}</p>
                                        <a href="{{ route('seleccionarllave', $llave->id) }}"
                                            class="btn btn-outline-success">Agregar</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <br>
        <div class="col-md-6 text-center">
            <a href="{{ route('home') }}" class="btn btn-danger ">Cancelar</a>

        </div>
    </div>

    <br>
    <div class="row align-items-center">
        <div class="col-sm-12 text-center">
            <h5>En caso de inconsistencias, favor de reportarlas a victor.ramirez@academicos.udg.mx</h5>
        </div>

    </div>
    </div>


    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>




    <script>
        $(document).ready(function() {
            const input = document.getElementById('buscador');
            input.addEventListener('keyup', logKey);
            console.log($('#buscador').val());
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                console.log(page);
                fetch_data(page);
            });

            function fetch_data(page) {
                $.ajax({
                    method: 'POST',
                    data: $('#form-busqueda').serialize(),
                    url: "{{ route('buscador-llaves') }}" + "?page=" +
                        page,
                    success: function(data) {
                        $('#contenedor').html(data);
                    }
                });
            }
        });

        function logKey() {
            let search = $('#buscador').val();
            console.log(search);
            $.ajax({
                url: "{{ route('buscador-llaves') }}",
                method: 'POST',
                data: $('#form-busqueda').serialize()
            }).done(function(data) {
                $('#contenedor').html(data);
            });
        }
    </script>
@else
    El periodo de Registro de Proyectos a terminado
    @endif
@endsection
