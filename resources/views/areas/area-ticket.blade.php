@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    @if (Auth::check() &&
        (Auth::user()->role == 'admin' ||
            Auth::user()->role == 'rh' ||
            Auth::user()->role == 'redes' ||
            Auth::user()->role == 'cta'))
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-10 order-sm-1 order-md-0">
                    <h2>Sede {{ $sede }}</h2>
                    @foreach ($areas as $clave => $valor)
                        {{-- Muestra el listado de Aulas --}}
                        <div class="mb-2 p-4 shadow w-100">
                            <h2>Edificio {{ $clave }}</h2>
                            @php
                                $pisos = collect($valor);
                            @endphp
                            <hr class="border">
                            @foreach ($pisos as $p => $item)
                                <h4>{{ strcmp('Piso 0', $p) == 0 ? 'Planta Baja' : $p }}</h4>
                                @php
                                    $areas = collect($item);
                                @endphp
                                @foreach ($areas as $key => $value)
                                    @if (isset($value['tickets']))
                                        <a onclick="modal({{ collect($value) }})" class="btn bg-danger text-white text-wrap"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal">

                                            {{ $value['area'] }}
                                            @if (str_contains($value['equipamiento'], 'PC'))
                                                <i class="fa fa-laptop "></i>
                                            @endif
                                            @if (str_contains($value['equipamiento'], 'TV') == 1)
                                                <i class="fa fa-tv "></i>
                                            @endif
                                            @if (str_contains($value['equipamiento'], 'Proyector') == 1)
                                                <i class="fa fa-video "></i>
                                            @endif

                                        </a>
                                    @else
                                        <a onclick="modal({{ collect($value) }})"
                                            class="btn bg-success text-white text-wrap" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">{{ $value['area'] }}
                                            @if (str_contains($value['equipamiento'], 'PC') == 1)
                                                <i class="fa fa-laptop "></i>
                                            @endif
                                            @if (str_contains($value['equipamiento'], 'TV') == 1)
                                                <i class="fa fa-tv "></i>
                                            @endif
                                            @if (str_contains($value['equipamiento'], 'Proyector') == 1)
                                                <i class="fa fa-video "></i>
                                            @endif
                                        </a>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    @endforeach

                </div>
                <div class="col-md-2 col-sm-12 order-sm-0 order-md-1">
                    <div class="d-flex flex-column align-items-center">
                        <p class="font-weight-bold">Nomenclatura</p>

                        <div class="row">
                            <div class="col-6 d-flex flex-column align-items-center">
                                <button type="button" class="btn btn-danger mt-1" data-toggle="tooltip"
                                    data-placement="top" title="Ticket Abierto">
                                </button>
                                <button type="button" class="btn btn-primary btn-sm mt-1" data-toggle="tooltip"
                                    data-placement="left" title="Proyector">
                                    <i class="fas fa-video fa-xs"></i>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm mt-1" data-toggle="tooltip"
                                    data-placement="left" title="Computadora">
                                    <i class="fa fa-laptop  fa-xs"></i>
                                </button>
                            </div>
                            <div class="col-6 d-flex flex-column align-items-center">
                                <button type="button" class="btn btn-success mt-1" data-toggle="tooltip"
                                    data-placement="bottom" title="Sin tickets">
                                </button>
                                <button type="button" class="btn btn-primary btn-sm mt-1" data-toggle="tooltip"
                                    data-placement="left" title="Videoconferencia">
                                    <i class="fas fa-chalkboard-teacher fa-xs"></i>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm mt-1" data-toggle="tooltip"
                                    data-placement="left" title="Sin equipo">
                                    <i class="fas fa-ban fa-xs"></i>
                                </button>
                            </div>
                        </div>

                        <label class="font-weight-bold my-3" for="sede">Área </label>
                        @if (strcmp($sede, 'Belenes') == 0)
                            <a href="{{ route('area-ticket', 'Belenes') }}"
                                class="col-auto my-2 btn bg-secondary text-white">Belenes</a>
                            <a href="{{ route('area-ticket', 'La Normal') }}" class="col-auto my-2 btn ">La
                                Normal</a>
                        @else
                            <a href="{{ route('area-ticket', 'Belenes') }}" class="col-auto my-2 btn ">Belenes</a>
                            <a href="{{ route('area-ticket', 'La Normal') }}"
                                class="col-auto my-2 btn bg-secondary text-white">La
                                Normal</a>
                        @endif
                        <label class="font-weight-bold my-2" for="">Edificio </label>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                    </div>
                    <div class="modal-body ">
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-5" id="slide" style="display:none;">
                                <img id="img1" class="d-block" style="width: 300px;" src="..." alt="First slide">
                            </div>
                            <div class="col-sm-12 col-md-5" id="slide_2">
                                <img id="img2" class="d-block" style="width: 300px;" src="..." alt="First slide">
                            </div>
                        </div>
                        <div class="row mt-2" id="row_datos" style="display:none;">
                            <div class="col-sm-12">
                                <h5 class="text-center">Solicitante: <span id="solicitante"></span> - Contacto: <span
                                        id="contacto"></span></h5>
                                <hr>
                                <p>Datos reporte: <span id="datos"></span></p>
                                <p>Fecha reporte: <span id="fecha"></span></p>
                                <p>Prioridad: <span id="prioridad"></span></p>

                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-sm-12">
                                <hr>
                                <h4>Datos de Clase</h4>
                            </div>
   
                            <div class="col-sm-12" id="clases" style="display: none;">
                                <p>Curso: <span id="curso"></span> </p>
                                <p>Horario: <span id="horario"></span></p>
                                <p>Profesor: <span id="profesor"></span></p>
                            </div>
                            <div class="col-sm-12" id="sin_clase" style="display: none;">
                                <p>Sin clase</p>
                            </div>
                        </div>
                        <div class="row justify-content-center ">
                            <div class="col-sm-12 col-md-3">
                                <a href="" id="historial" class="btn btn-primary">Historial</a>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <a href="" id="equipos" class="btn btn-primary">Equipos</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <script>
            function modal(params) {
                console.log(params);
                $("#exampleModalLabel").html(params['area']);
                if (params['imagen_1'] == 'Sin imagen') {
                    document.getElementById('slide').style.display = 'none';
                } else {
                    document.getElementById('slide').style.display = 'block';
                    var url = "{{ route('area_imagenes', ':id') }}";
                    url = url.replace(':id', params['imagen_1']);
                    $('#img1').attr("src", url);
                    if (params['imagen_2'] == 'Sin imagen') {
                        document.getElementById('slide_2').style.display = 'none';
                    } else {
                        document.getElementById('slide_2').style.display = 'block';
                        var url = "{{ route('area_imagenes', ':id') }}";
                        url = url.replace(':id', params['imagen_2']);
                        $('#img2').attr("src", url);
                    }
                }
                if (params.hasOwnProperty('tickets')) {
                    document.getElementById('row_datos').style.display = 'block';
                    $("#datos").html(params['tickets'][0]['datos_reporte']);
                    $("#solicitante").html(params['tickets'][0]['solicitante']);
                    $("#fecha").html(params['tickets'][0]['fecha_reporte']);
                    $("#prioridad").html(params['tickets'][0]['prioridad']);
                    $("#contacto").html(params['tickets'][0]['contacto']);
                } else {
                    document.getElementById('row_datos').style.display = 'none';
                }
                if (params.hasOwnProperty('clase')){
                    document.getElementById('clases').style.display = 'block';
                    document.getElementById('sin_clase').style.display = 'none';
                    $("#horario").html(params['clase']['horario']);
                    $("#curso").html(params['clase']['curso']);
                    $("#profesor").html(params['clase']['profesor']);
                } else {
                    console.log('entro');
                    document.getElementById('clases').style.display = 'none';
                    document.getElementById('sin_clase').style.display = 'block';
                }
                var id = params['id'].toString();
                var url = "{{ route('ticket-historial', ':id') }}";
                url = url.replace(':id', id);
                document.getElementById('historial').href = url;
                var url = "{{ route('equipo-area', ':id') }}";
                url = url.replace(':id', id);
                document.getElementById('equipos').href = url;
            }
        </script>
    @else
        Acceso No válido
    @endif
@endsection