@extends('layouts.app')
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
                    <h2>Captura de servicio</h2>
                </div>
                <hr>
            </div>

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('servicios.store') }}" method="post" enctype="multipart/form-data" class="col-12">
                        {!! csrf_field() !!}
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
                                <label class="font-weight-bold" for="nombre">Nombre del servicio </label>
                                <input type="text" name="nombre" id="nombre">
                            </div>
                            <div class="col-md-3">
                                <label class="font-weight-bold" for="categoria">Categoria </label>
                                <input type="text" name="categoria" id="categoria">
                            </div>
                            <div class="col-md-3">
                                <label class="font-weight-bold" for="descripcion">Descripcion </label>
                                <input type="text" name="descripcion" id="descripcion">
                            </div>
                            <div class="col-md-3">
                                <label class="font-weight-bold" for="contacto">Contacto </label>
                                <input type="text" name="contacto" id="contacto">
                            </div>
                            <div class="col-md-3">
                                <label class="font-weight-bold" for="requisitos">Requisitos </label>
                                <input type="text" name="requisitos" id="requisitos">
                            </div>
                            <div class="col-md-3">
                                <label class="font-weight-bold" for="procedimiento">Procedimiento </label>
                                <input type="text" name="procedimiento" id="procedimiento">
                            </div>
                            <div class="col-md-3">
                                <label class="font-weight-bold" for="tiempo_de_respuesta">Tiempo de respuesta </label>
                                <input type="text" name="tiempo_de_respuesta" id="tiempo_de_respuesta">
                            </div>
                            
                        </div>
                        
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
    Accceso no autorizado
    @endif

@endsection
