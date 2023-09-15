@extends('adminlte::page')
@section('title', 'Personal')

@section('css')
    @include('layouts.head_2')
@stop
@section('content')
    @can('cNormal_PERSONAL#editar')
        <div class="container">
            @if (Auth::check())
                @if (session('message'))
                    <div class="alert alert-success">
                        <h2>{{ session('message') }}</h2>

                    </div>
                @endif
                <div class="row">
                    <h2>Captura de Personal</h2>
                    <hr>
                </div>

                <form action="{{ route('personal.store') }}" method="post" enctype="multipart/form-data" class="col-12"
                    name="Alta_Personal">
                    <div class="row">
                        <div class="col">
                            {!! csrf_field() !!}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <br>

                            <div class="row g-3 align-items-center">
                                <input class="form-control" id="activo" name="activo" type="hidden" value="1">
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="codigo">Código: *</label>
                                    <input class="form-control" id="codigo" name="codigo" type="number">
                                </div>
                                <div class="col-md-3">
                                    <label class="font-weight-bold" for="apellido_paterno">Apellido paterno: *</label>
                                    <input class="form-control" id="apellido_paterno" name="apellido_paterno" type="text">
                                </div>
                                <div class="col-md-3">
                                    <label class="font-weight-bold" for="apellido_materno">Apellido materno: *</label>
                                    <input class="form-control" id="apellido_materno" name="apellido_materno" type="text">
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="nombre">Nombre (s): *</label>
                                    <input class="form-control" id="nombre" name="nombre" type="nombre">
                                </div>
                            </div>
                            <br>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-6">
                                    <label class="font-weight-bold" for="grado_estudios">Grado de Estudios: *</label>
                                    <input class="form-control" id="grado_estudios" name="grado_estudios" type="text">
                                </div>
                                <div class="col-md-6">
                                    <label class="font-weight-bold" for="plaza">Plaza: *</label>
                                    <select class="form-control" id="js-example-basic-single" name="plaza">
                                        <option disable selected>-Elegir</option>
                                        @foreach ($plazas as $Plaza)
                                            <option value="{{ $Plaza->nombre }}">{{ $Plaza->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="categoria">Categoria: *</label>
                                    <select class="form-control" id="js-example-basic-single2" name="categoria">
                                        <option disable selected>-Elegir</option>
                                        <option>Administrativo</option>
                                        <option>Confianza</option>
                                        <option>Directivo</option>
                                        <option>Operativo</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="font-weight-bold" for="adscripcion">Adscripción: *</label>
                                    <select class="form-control" id="js-example-basic-single3" name="adscripcion">
                                        <option disable selected>-Elegir</option>
                                        @foreach ($areas as $item)
                                            <option value="{{ $item->id }}-{{ $item->area }}"> {{ $item->division }} -
                                                {{ $item->coordinacion }} - {{ $item->area }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="area_fisica">Área Física: *</label>
                                    <input class="form-control" id="area_fisica" name="area_fisica" type="text">
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="sede">Sede: *</label>
                                    <input class="form-control" id="sede" name="sede" type="text">
                                </div>

                                <div class="col-md-6">
                                    <label for="" class="form-label">Adjuntar Reporte</label>
                                    <input type="file" name="reporte" id="reporte" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">Vencimiento del documento</label>
                                    <input type="date" name="fecha_documento" id="fecha_documento" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label class="font-weight-bold">Horario:</label>
                            </div>
                            <br>
                            <!-- DÍAS DE LA SEMANA -->
                            <div class="row g-3 align-items-center">
                                <div class="col-md-2">
                                    <label class="font-weight-bold">Lunes: *</label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold">Martes: *</label>
                                </div>

                                <div class="col-md-2">
                                    <label class="font-weight-bold">Miércoles: *</label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold">Jueves: *</label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold">Viernes: *</label>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold">Sábado: *</label>
                                </div>
                            </div>
                            <!--CIERRE DIV ALINEACIÓN TEXTO-->

                            <!-- CAJAS DE TEXTO DE LOS DÍAS -->
                            <div class="row g-3 align-items-center">
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="lunes"></label>
                                    <input type="text" class="form-control" id="lunes" name="lunes"
                                        placeholder="Lunes">
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="martes"></label>
                                    <input type="text" class="form-control" id="martes" name="martes"
                                        placeholder="Martes">
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="miercoles"></label>
                                    <input type="text" class="form-control" id="miercoles" name="miercoles"
                                        placeholder="Miércoles">
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="jueves"></label>
                                    <input type="text" class="form-control" id="jueves" name="jueves"
                                        placeholder="Jueves">
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="viernes"></label>
                                    <input type="text" class="form-control" id="viernes" name="viernes"
                                        placeholder="Viernes">
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="sabado"></label>
                                    <input type="text" class="form-control" id="sabado" name="sabado"
                                        placeholder="Sábado">
                                </div>
                            </div>
                            <!--CIERRE DIV ALINEACIÓN CAJAS-->
                        </div>
                    </div>


                    <br>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-12">
                            <a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar datos</button>
                        </div>
                    </div>

                </form>
        </div>
    @endcan
@else
    Acceso No válido
    @endif
@endsection

@section('footer')
    <div class="row g-3 align-items-center">
        <h5 class="text-end">En caso de inconsistencias, favor de reportarlas.</h5>
    </div>
@endsection


@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#js-example-basic-single').select2();
        });
        $(document).ready(function() {
            $('#js-example-basic-single2').select2();

        });
        $(document).ready(function() {
            $('#js-example-basic-single3').select2();

        });

        window.onload = function() {

            var plazaSelect = document.forms['Alta_Personal'].
            elements['js-example-basic-single'];
            plazaSelect.options[0].disabled = true;

            var habitacionesSelect = document.forms['Alta_Personal'].
            elements['js-example-basic-single2'];
            habitacionesSelect.options[0].disabled = true;

            var habitacionesSelect = document.forms['Alta_Personal'].
            elements['js-example-basic-single3'];
            habitacionesSelect.options[0].disabled = true;
        }
    </script>
@endsection
