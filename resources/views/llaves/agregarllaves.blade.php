@extends('adminlte::page')
@section('title', 'Agreagr Llave')

@section('css')
    @include('layouts.head_2')

@stop

@section('content')
    <div class="container">
        @if (Auth::check())
            @if (session('message'))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-success mt-3">
                            <h4>{{ session('message') }}</h4>
                        </div>
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-danger text-center mt-3">
                            Debe de escribir un criterio de búsqueda
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                @if (isset($llaves_agregadas) && $llaves_agregadas->count() > 0)
                    <div class="col-sm-12">
                        <h3 class="text-center w-100 mt-3">
                            Llaves en uso
                        </h3>
                        <hr>
                    </div>

                    @foreach ($llaves_agregadas as $llave)
                        <div class="col-sm-12  col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Área de Llave:
                                        {{ $llave->area }}</h5>
                                    <p class="card-text">
                                        {{ $llave->comentarios }}</p>

                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <a href="{{ route('devolverllave', $llave->id) }}"
                                        class="btn btn-outline-warning btn-sm">Devolver Llave</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="text-center mt-3">Busca una llave:</h4>
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
                                        <h5 class="card-title">Área de Llave: {{ $llave->area }}
                                        </h5>
                                        <p class="card-text">{{ $llave->comentarios }}</p>

                                    </div>
                                    <div class="card-footer d-flex justify-content-end">
                                        <a href="{{ route('seleccionarllave', $llave->id) }}"
                                            class="btn btn-success btn-sm">Agregar</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    </div>
@else
    El periodo de Registro de Proyectos a terminado
    @endif
@endsection
@section('footer')
    <h5>En caso de inconsistencias, favor de reportarlas a victor.ramirez@academicos.udg.mx</h5>
@stop
@section('js')
    @include('layouts.scripts')
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
@stop
