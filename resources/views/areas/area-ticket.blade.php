@extends('adminlte::page')
@php
    $titulo = 'Reporte Aulas ' . $sede;
@endphp
@section('title', $titulo)

@section('css')
    @include('layouts.head_2')
@stop

@section('content')
    @if (Auth::check() &&
            (Auth::user()->role == 'admin' ||
                Auth::user()->role == 'rh' ||
                Auth::user()->role == 'redes' ||
                Auth::user()->role == 'cta'))
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-10 order-sm-1 order-md-0">
                    <h2 class="text-center mt-4">Sede {{ $sede }}</h2>
                    @foreach ($areas as $clave => $valor)
                        {{-- Muestra el listado de Aulas --}}
                        <div class="mb-3 p-4 shadow-sm w-100 border">
                            <h2 class="text-center">Edificio {{ $clave }}</h2>
                            @php
                                $pisos = collect($valor);
                            @endphp
                            <hr class="border border-dark">
                            @foreach ($pisos as $p => $item)
                                <h4>{{ strcmp('Piso 0', $p) == 0 ? 'Planta Baja' : $p }}</h4>
                                @foreach (collect($item) as $key => $value)
                                    @php
                                        if (isset($value['tickets'])) {
                                            $estilos = 'btn bg-danger text-white text-wrap m-1';
                                        } else {
                                            $estilos = 'btn bg-success text-white text-wrap m-1';
                                        }
                                    @endphp
                                    <a onclick="modal({{ collect($value) }})" class=" {{ $estilos }}"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="d-flex">
                                            {{ $value['area'] }} 
                                            <span class="mx-1 material-icons md-10">videocam photo_camera</span>
                                        </span>
                                        
                                    </a>
                                @endforeach
                            @endforeach
                        </div>
                    @endforeach

                </div>
                <div class="col-md-2 col-sm-12 order-sm-0 order-md-1">
                    <div class="d-flex flex-column align-items-center ">
                        <p class="font-weight-bold">Sedes</p>
                        @if (strcmp($sede, 'Belenes') == 0)
                            <a href="{{ route('area-ticket', 'Belenes') }}"
                                class="col-auto my-2 btn  btn-primary  w-100">Belenes</a>
                            <a href="{{ route('area-ticket', 'La Normal') }}"
                                class="col-auto my-2 btn btn-outline-dark w-100">La
                                Normal</a>
                        @else
                            <a href="{{ route('area-ticket', 'Belenes') }}"
                                class="col-auto my-2 btn btn-outline-dark w-100">Belenes</a>
                            <a href="{{ route('area-ticket', 'La Normal') }}"
                                class="col-auto my-2 btn btn-primary  w-100">La
                                Normal</a>
                        @endif
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
                        <div class="row justify-content-center mt-2">
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
    @else
        Acceso No válido
    @endif

@endsection
@section('js')
    <script>
        function modal(params) {
            console.log(params);
            $("#exampleModalLabel").html(params['area']);
            if (params['imagen_1'] == 'Sin imagen') {
                document.getElementById('slide').style.display = 'none';
            } else {
                document.getElementById('slide').style.display = 'block';
                var url = "{{ url('storage/images/:id') }}";
                url = url.replace(':id', params['imagen_1']);
                $('#img1').attr("src", url);
                if (params['imagen_2'] == 'Sin imagen') {
                    document.getElementById('slide_2').style.display = 'none';
                } else {
                    document.getElementById('slide_2').style.display = 'block';
                    var url = "{{ url('storage/images/:id') }}";
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
            var id = params['id'].toString();
            var url = "{{ route('ticket-historial', ':id') }}";
            url = url.replace(':id', id);

            var url = "{{ route('equipo-area', ':id') }}";
            url = url.replace(':id', id);
            console.log(url);
            document.getElementById('equipos').href = url;
        }
    </script>
@endsection
@section('footer')
    <h6>En caso de inconsistencias, favor de reportarlas.</h6>
@endsection
