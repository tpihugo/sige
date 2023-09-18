@extends('adminlte::page')
@section('title', 'Crear Subred')

@section('css')
    @include('layouts.head_2')
@stop
@section('content')

@section('content')
    <div class="container">
        @if (Auth::check() &&
                (Auth::user()->role == 'admin' ||
                    Auth::user()->role == 'cta' ||
                    Auth::user()->role == 'auxiliar' ||
                    Auth::user()->role == 'redes'))
            @if (session('message'))
                <div class="alert alert-success">
                    <p>{{ session('message') }}</p>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            <div class="row">
                <div class="col-md-auto ml-3">
                    <h2>Captura de subred</h2>
                </div>
                <hr>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('subredes.store') }}" method="post" enctype="multipart/form-data">
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
                            <!--Inicio del formulario para la captura de datos -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <!--Captura de el numero de VLAN-->
                                                <label for="" class="font-weight-bold">VLAN <span
                                                        style="color: red"><b>*</b></span></label>
                                                <input type="number" min="1" class="form-control" id="vlan"
                                                    name="vlan"
                                                    title="El campo debe ser llenado en el formato correcto.&#013;Solo acepta números iguales a 1 o mayores"
                                                    value="{{ old('vlan') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <!--Puerta de enlace de la VLAN-->
                                                <label class="font-weight-bold" for="gateway">Gateway <span
                                                        style="color: red"><b>*</b></label>
                                                <input type="text" class="form-control" id="gateway" name="gateway"
                                                    pattern="((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$"
                                                    title="El campo debe ser llenado en el formato correcto.
                                            &#013; Ejemplo: (192.168.1.129)"
                                                    placeholder="192.168.1.129" value="{{ old('gateway') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <!--Rango de inicio de la VLAN-->
                                                <label for="" class="font-weight-bold">Rango inicial <span
                                                        style="color: red"><b>*</b></span></label>
                                                <input type="text" class="form-control" id="rangoInicial"
                                                    name="rangoInicial"
                                                    pattern="((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$"
                                                    title="El campo debe ser llenado en el formato correcto.
                                            &#013; Ejemplo: 192.168.1.0"
                                                    placeholder="192.168.1.0" value="{{ old('rangoInicial') }}"required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <!--Rango de final de la VLAN-->
                                                <label for="" class="font-weight-bold">Rango final <span
                                                        style="color: red"><b>*</b></span></label>
                                                <input type="text" class="form-control" id="rangoFinal" name="rangoFinal"
                                                    pattern="((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$"
                                                    title="El campo debe ser llenado en el formato correcto.
                                            &#013; Ejemplo: 192.168.1.128"
                                                    placeholder="192.168.1.128" value="{{ old('rangoFinal') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!--Descripción breve sobre la VLAN-->
                                        <label for=""class="font-weight-bold">Descripción <span
                                                style="color: red"><b>*</b></span></label>
                                        <textarea name="descripcion" class="form-control" required>{{ old('descripcion') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row align-items-center m-0">
                                    <div class="col-md-12">
                                        <center>
                                            <a href="{{ route('subredes.index') }}" class="btn btn-danger">Cancelar</a>
                                            <button type="submit" class="btn btn-success">Guardar datos <i
                                                    class="ml-1 fas fa-save"></i></button>
                                        </center>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
            <br>
            <div class="row align-items-center">
                <div class="col-md-12">
                    <center>
                        <h5>En caso de inconsistencias, favor de reportarlas.</h5>
                    </center>
                </div>
                <hr>
            </div>
    </div>
@else
    El periodo de Registro de Proyectos a terminado
    @endif

@endsection
