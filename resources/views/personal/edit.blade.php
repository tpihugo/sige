@extends('adminlte::page')
@section('title', 'Editar Personal')

@section('css')
    @include('layouts.head_2')
@stop
@section('content')
    @php
        use App\Models\Area;
        use App\Models\Plaza;

        $areas = Area::all();
        $plazas = Plaza::all();
    @endphp
    @can('cNormal_PERSONAL#editar')
        <div class="container">
            @if (Auth::check())
                @if (session('message'))
                    <div class="alert alert-success">
                        <h2>{{ session('message') }}</h2>

                    </div>
                @endif
                <div class="row">
                    <h2 class="mt-3">Edici&oacute;n de Personal:
                        {{ $personal->apellido_paterno . ' ' . $personal->apellido_materno . ' ' . $personal->nombre }}</h2>
                    <hr>
                </div>
                <form action="{{ route('personal.update', $personal->id) }}" method="post" enctype="multipart/form-data"
                    class="col-12">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
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
                                    <input class="form-control" id="codigo" name="codigo" type="number"
                                        value="{{ $personal->codigo }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="font-weight-bold" for="apellido_paterno">Apellido paterno: *</label>
                                    <input class="form-control" id="apellido_paterno" name="apellido_paterno" type="text"
                                        value="{{ $personal->apellido_paterno }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="font-weight-bold" for="apellido_materno">Apellido materno: *</label>
                                    <input class="form-control" id="apellido_materno" name="apellido_materno" type="text"
                                        value="{{ $personal->apellido_materno }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="nombre">Nombre (s): *</label>
                                    <input class="form-control" id="nombre" name="nombre" type="nombre"
                                        value="{{ $personal->nombre }}" required>
                                </div>
                            </div>
                            <br>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-6">
                                    <label class="font-weight-bold" for="grado_estudios">Grado de Estudios: *</label>
                                    <input class="form-control" id="grado_estudios" name="grado_estudios" type="text"
                                        value="{{ $personal->grado_estudios }}">
                                </div>

                                <div class="col-md-6">

                                    <label class="font-weight-bold" for="plaza">Plaza: *</label>
                                    <select class="form-control" id="js-example-basic-single2" name="plaza">
                                        <option>{{ $personal->plaza }}</option>
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
                                    <select class="form-control" id="js-example-basic-single" name="categoria">
                                        <option>{{ $personal->categoria }}</option>
                                        <option>Administrativo</option>
                                        <option>Confianza</option>
                                        <option>Directivo</option>
                                        <option>Operativo</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="carga_horaria">Carga Horaria: *</label>
                                    <input class="form-control" id="carga_horaria" name="carga_horaria" type="number"
                                        value="{{ $personal->carga_horaria }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="font-weight-bold" for="adscripcion">Adscripción: *</label>
                                    <select class="form-control" id="js-example-basic-single3" name="adscripcion">
                                        <option selected value="{{ $personal->id_adscripcion }}-{{ $personal->adscripcion }}">{{ $personal->adscripcion }}
                                        </option>
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
                                    <input class="form-control" id="area_fisica" name="area_fisica" type="text"
                                        value="{{ $personal->area_fisica }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="sede">Sede: *</label>
                                    <input class="form-control" id="sede" name="sede" type="text"
                                        value="{{ $personal->sede }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="" class="form-label">Adjuntar Reporte</label>
                                    <input type="file" name="pdf" id="pdf" class="form-control" accept="application/pdf">
                                </div>

                                <div class="col-md-3">
                                    <label for="" class="form-label">Vencimiento del documento</label>
                                    <input type="date" value="{{ $personal->fecha_documento }}" name="fecha_documento"
                                        id="fecha_documento" class="form-control">
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
                                        placeholder="Lunes" value="{{ $personal->lunes }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="martes"></label>
                                    <input type="text" class="form-control" id="martes" name="martes"
                                        placeholder="Martes" value="{{ $personal->martes }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="miercoles"></label>
                                    <input type="text" class="form-control" id="miercoles" name="miercoles"
                                        placeholder="Miércoles" value="{{ $personal->miercoles }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="jueves"></label>
                                    <input type="text" class="form-control" id="jueves" name="jueves"
                                        placeholder="Jueves" value="{{ $personal->jueves }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="viernes"></label>
                                    <input type="text" class="form-control" id="viernes" name="viernes"
                                        placeholder="Viernes" value="{{ $personal->viernes }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="font-weight-bold" for="sabado"></label>
                                    <input type="text" class="form-control" id="sabado" name="sabado"
                                        placeholder="Sábado" value="{{ $personal->sabado }}">
                                </div>
                            </div>
                            <!--CIERRE DIV ALINEACIÓN CAJAS-->
                        </div>
                    </div>
                    <br>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-success">
                                Guardar datos
                                <i class="ml-1 fas fa-save"></i>
                            </button>
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
            $('#js-example-basic-single2').select2();
            $('#js-example-basic-single3').select2();
        });
    </script>
@endsection
