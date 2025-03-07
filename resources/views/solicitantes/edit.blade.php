@extends('adminlte::page')
@section('title', 'Servicios Edit')
@section('css')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    @include('layouts.head')
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
                <div class="col-md-auto ml-3">
                    <h2>Editar servicio</h2>
                </div>
                <hr>
            </div>

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('servicios.update', $servicio->id) }}" method="post"
                        enctype="multipart/form-data" class="col-12">
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
                            <div class="col-md-12">
                                <label class="font-weight-bold form-label" for="nombre">Nombre del servicio </label>
                                <textarea class="form-control" name="nombre" id="nombre">{{ $servicio->nombre }}</textarea class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="font-weight-bold form-label" for="categoria">Categoria </label>
                                <input class="form-control" type="text" name="categoria" id="categoria"value="{{ $servicio->categoria }}">
                            </div>
                            <div class="col-md-12">
                                <label class="font-weight-bold form-label" for="descripcion">Descripcion </label>
                                <textarea class="form-control" name="descripcion" id="descripcion">{{ $servicio->descripcion }}</textarea class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="font-weight-bold form-label" for="contacto">Contacto </label>
                                <textarea class="form-control" name="contacto" id="contacto">{{ $servicio->contacto }}</textarea class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="font-weight-bold form-label" for="requisitos">Requisitos </label>
                                <textarea class="form-control" name="requisitos" id="requisitos">{{ $servicio->requisitos }}</textarea class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="font-weight-bold form-label" for="procedimiento">Procedimiento </label>
                                <textarea class="form-control" name="procedimiento" id="procedimiento">{{ $servicio->procedimiento }}</textarea class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="font-weight-bold form-label" for="tiempo_de_respuesta">Tiempo de respuesta </label>
                                <input class="form-control" type="text" name="tiempo_de_respuesta"
                                    id="tiempo_de_respuesta"value="{{ $servicio->tiempo_de_respuesta }}">
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
                        <br>
                    </form>
                </div>
            </div>
            <br>
            <div class="row align-items-center">

                <br>
                <hr>
                <h5>Coordinación de Tecnologías para el Aprendizaje. CUCSH</h5>


            </div>
    </div>
@else
    Acceso no autorizado
    @endif

@endsection
