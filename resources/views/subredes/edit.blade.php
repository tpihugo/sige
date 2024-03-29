@extends('adminlte::page')
@section('title', 'Editar Subred')

@section('css')
    @include('layouts.head_2')
@stop
@section('content')
    <div class="container">
        @if (Auth::check() &&
                (Auth::user()->role == 'admin' ||
                    Auth::user()->role == 'cta' ||
                    Auth::user()->role == 'auxiliar' ||
                    Auth::user()->role == 'redes'))
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>

                </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="text-center w-100">
                        Actualizar subred
                    </h2>
                </div>
                <hr>
            </div>

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('subredes.update', $subred->id) }}" method="post" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
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
                            <!--Inicio del formulario para la captura de datos -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"><!--Captura de el nuemro de VLAN-->
                                                <label for="" class="font-weight-bold">VLAN <span
                                                        style="color: red"><b>*</b></span></label>
                                                <input type="text" class="form-control" id="vlan" name="vlan"
                                                    title="El campo debe ser llenado en el formato correcto."
                                                    value="{{ $subred->vlan }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"><!--Puerta de enlace de la VLAN-->
                                                <label class="font-weight-bold" for="gateway">Gateway</label>
                                                <label type="text" class="form-control" id="gateway"
                                                    name="gateway">{{ $subred->gateway }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"><!--Rango de inicio de la VLAN-->
                                                <label for="" class="font-weight-bold">Rango inicial</label>
                                                <label type="text" class="form-control" id="rangoInicial"
                                                    name="rangoInicial">{{ $subred->rangoInicial }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"><!--Rango de final de la VLAN-->
                                                <label for="" class="font-weight-bold">Rango final</label>
                                                <label type="text" class="form-control" id="rangoFinal"
                                                    name="rangoFinal">{{ $subred->rangoFinal }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"> <!--Descripcion breve sobre la VLAN-->
                                        <label for="" class="font-weight-bold">Descripción<span
                                                style="color: red"><b>*</b></span></label>
                                        <input rows="" name="descripcion" id="descripcion" class="form-control"
                                            required value="{{ $subred->descripcion }}" />
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row align-items-center m-0">
                                <div class="col-md-6">
                                    <a href="{{ route('subredes.index') }}" class="btn btn-danger">Cancelar</a>
                                    <button type="submit" class="btn btn-success">
                                        Guardar datos <i class="ml-1 fas fa-save"></i>
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
    </div>
@else
    El periodo de Registro de Proyectos a terminado
    @endif
@endsection

@section('footer')
    <h5 class="text-end">En caso de inconsistencias, favor de reportarlas.</h5>
@endsection
