@extends('adminlte::page')
@section('title', 'Editar área')

@section('css')
    @include('layouts.head_2')
@stop
@section('content')
    <div class="container">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>

                </div>
            @endif
            <div class="row">
                <div class="col-md-12 mt-5 text-center">
                    <h2>Edici&oacute;n de Área</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('areas.update', $area->id) }}" method="post" enctype="multipart/form-data"
                        class="col-12">
                        {!! csrf_field() !!}
                        {{ method_field('PUT') }}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    Debe de llenar los campos marcados con un asterisco (*).
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label class="font-weight-bold" for="tipo_espacio">Tipo de Espacio </label>
                                <select class="form-control" id="tipo_espacio" name="tipo_espacio">
                                    <option value="{{ $area->tipo_espacio }}" selected>{{ $area->tipo_espacio }}</option>
                                    <option value="Aula">Aula</option>
                                    <option value="Laboratorio">Laboratorio</option>
                                    <option value="Administrativo">Administrativo</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="font-weight-bold" for="sede">Sede </label>
                                <select class="form-control" id="sede" name="sede">
                                    <option value="{{ $area->sede }}" selected>{{ $area->sede }}</option>
                                    <option disabled>Elegir</option>
                                    <option value="Belenes">Belenes</option>
                                    <option value="La Normal">La Normal</option>
                                    <option value="Juan Manuel 130">Juan Manuel 130</option>
                                    <option value="C.U. DE CS. SOCIALES Y HUMANIDADES">C.U. DE CS. SOCIALES Y HUMANIDADES
                                    </option>
                                    <option value="Papirolas">Papirolas</option>
                                    <option value="FIL">FIL Expo</option>
                                    <option value="Prestamo Externo">Pr&eacute;stamo Externo</option>

                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="font-weight-bold" for="edificio">Edificio </label>
                                <select class="form-control" id="edificio" name="edificio">
                                    <option value="{{ $area->edificio }}" selected>{{ $area->edificio }}</option>
                                    <option disabled>Elegir</option>
                                    <option value="Edificio A">Edificio A</option>
                                    <option value="Edificio B">Edificio B</option>
                                    <option value="Edificio C">Edificio C</option>
                                    <option value="Edificio D">Edificio D</option>
                                    <option value="Edificio E">Edificio E</option>
                                    <option value="Edificio F">Edificio F</option>
                                    <option value="Edificio F 1">Edificio F 1</option>
                                    <option value="Edificio F 2">Edificio F 2</option>
                                    <option value="Edificio F 3">Edificio F 3</option>
                                    <option value="Edificio F 4">Edificio F 4</option>
                                    <option value="Edificio F 5">Edificio F 5</option>

                                    <option value="Edificio G">Edificio G</option>
                                    <option value="Edificio H">Edificio H</option>
                                    <option value="Edificio I">Edificio I</option>
                                    <option value="Edificio J">Edificio J</option>
                                    <option value="Edificio K">Edificio K</option>
                                    <option value="Edificio L">Edificio L</option>
                                    <option value="Edificio M">Edificio M</option>
                                    <option value="Edificio N">Edificio N</option>
                                    <option value="Edificio O">Edificio O</option>
                                    <option value="Edificio P">Edificio P</option>
                                    <option value="Edificio Q">Edificio Q</option>
                                    <option value="Edificio R">Edificio R</option>
                                    <option value="Edificio S">Edificio S</option>
                                    <option value="Edificio T">Edificio T</option>
                                    <option value="Edificio U">Edificio U</option>
                                    <option value="Edificio Servicios Generales Belenes">Servicios Generales Belenes
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="font-weight-bold" for="piso">Piso </label>
                                <select class="form-control" id="piso" name="piso">
                                    <option value="{{ $area->piso }}" selected>{{ $area->piso }}</option>
                                    <option disabled>Elegir</option>
                                    <option value="Planta Baja">Planta Baja</option>
                                    <option value="Piso 1">Piso 1</option>
                                    <option value="Piso 2">Piso 2</option>
                                    <option value="Piso 3">Piso 3</option>
                                    <option value="Piso 4">Piso 4</option>
                                    <option value="Piso 5">Piso 5</option>
                                    <option value="Piso 6">Piso 6</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="division">División </label>
                                <select class="form-control" id="division" name="division">
                                    <option value="{{ $area->division }}" selected>{{ $area->division }}</option>
                                    <option disabled>Elegir</option>
                                    <option value="Rectoría">Rectoría</option>
                                    <option value="Secretaría Académica">Secretaría Académica</option>
                                    <option value="Secretaría Administrativa">Secretaría Administrativa</option>
                                    <option value="División de Estudios Históricos y Humanos">División de Estudios
                                        Históricos y Humanos</option>
                                    <option value="División de Estudios Jurídicos">División de Estudios Jurídicos</option>
                                    <option value="División de Estudios de la Cultura">División de la Cultura</option>
                                    <option value="División de Estudios Políticos y Sociales">División de Estudios
                                        Politicos y Sociales
                                    </option>
                                    <option value="División de Estudios de Estado y Sociedad">División de Estudios de
                                        Estado y sociedad
                                    </option>
                                    <option value="C.U. DE CS. SOCIALES Y HUMANIDADES">C.U. DE CIENCIAS SOCIALES Y
                                        HUMANIDADES
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" for="coordinacion">Coordinación </label>
                                <input type="text" class="form-control" name="coordinacion"
                                    value="{{ $area->coordinacion }}">
                            </div>

                            <div class="col-md-12">
                                <label class="font-weight-bold" for="area">Área</label>
                                <input type="text" class="form-control" id="area" name="area"
                                    value="{{ $area->area }}">
                            </div>
                        </div>
                        
                        <div class="row align-items-center mt-2">
                            <div class="col-md-12">
                                <label class="font-weight-bold" for="imagen_1">Exclusivo para aulas o laboratorios</label>
                            </div>
                            <hr>
                            <div class="col-md-4">
                                <label class="font-weight-bold" for="imagen_1">Imagen 1</label>
                                <div class="custom-file">
                                    <input name="imagen_1" type="file" class="custom-file-input" id="customFileLang"
                                        lang="es" value="{{ $area->imagen_1 }}">
                                    <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                                </div>
                                {{-- <a href="storage/app/images/{{$area->imagen_1}}" class="thumb" title="Nombre imagen" target="_blank">Nombre imagen</a> --}}
                            </div>
                            <div class="col-md-4">
                                <label class="font-weight-bold" for="imagen_2">Imagen 2</label>
                                <div class="custom-file">
                                    <input name="imagen_2" type="file" class="custom-file-input" id="customFileLang"
                                        lang="es" value="{{ $area->imagen_2 }}">
                                    <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                                </div>
                                {{-- <a href="storage/app/images/{{$area->imagen_2}}" class="thumb" title="Nombre imagen" target="_blank">Nombre imagen</a> --}}
                            </div>
                            <div class="col-md-4 ">
                                <h6 class="font-weight-bold " for="Equipamiento">Equipamiento</h6>
                                <div class="d-flex flex-row flex-wrap">
                                    <div class="form-check d-flex flex-row m-1">
                                        <input class="form-check-input" type="checkbox" {{$equipamiento['Bocinas']}} name="equipamiento[]"
                                            value="Bocinas" id="equipamiento_bocinas">
                                        <label class="form-check-label" for="equipamiento_bocinas">
                                            Bocinas
                                        </label>
                                    </div>

                                    <div class="form-check d-flex flex-row m-1">
                                        <input class="form-check-input" type="checkbox" {{$equipamiento['Pantalla']}} name="equipamiento[]"
                                            value="Pantalla" id="equipamiento_pantalla">
                                        <label class="form-check-label" for="equipamiento_pantalla">
                                            Pantalla
                                        </label>
                                    </div>

                                    <div class="form-check d-flex flex-row m-1">
                                        <input class="form-check-input" type="checkbox" {{$equipamiento['PC']}} name="equipamiento[]"
                                            value="PC" id="equipamiento_pc">
                                        <label class="form-check-label" for="equipamiento_pc">
                                            PC
                                        </label>
                                    </div>

                                    <div class="form-check d-flex flex-row m-1">
                                        <input class="form-check-input" type="checkbox" {{$equipamiento['Proyector']}} name="equipamiento[]"
                                            value="Proyetor" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Proyector
                                        </label>
                                    </div>
                                    <div class="form-check d-flex flex-row m-1">
                                        <input class="form-check-input" type="checkbox" {{$equipamiento['Pantalla Proyección']}} name="equipamiento[]"
                                            value="Pantalla Proyección" id="equipamiento_proyeccion">
                                        <label class="form-check-label" for="equipamiento_proyeccion">
                                            Pantalla Proyección
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row align-items-center mt-3">
                            <div class="col-md-6">
                                <a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
                                <button type="submit" class="btn btn-success">
                                    Guardar datos
                                    <i class="ml-1 fas fa-save"></i>
                                </button>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
    </div>
@else
    El periodo de Registro de Proyectos a terminado
    @endif

@endsection

@section('footer')
    <h5 class="text-end">En caso de inconsistencias, favor de reportarlas</h5>
@endsection