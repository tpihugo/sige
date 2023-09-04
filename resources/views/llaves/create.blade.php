@extends('adminlte::page')
@section('title', 'Crear Llave')

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
                <h2>Captura de Llave</h2>
                <hr>


            </div>
            <form action="{{ route('llaves.store') }}" method="post" enctype="multipart/form-data" class="col-12">
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
                            <div class="row g-3 align-items-center">
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="area">Área de la Llave</label>
                                    <input type="text" class="form-control" id="area" name="area">
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="comentarios">Comentario</label>
                                    <input type="text" class="form-control" id="comentarios" name="comentarios">
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="num_copias">Número de Llaves:</label>
                                    <input type="number" id="num_copias" name="num_copias" min="1" max="5">
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
                                <button type="submit" class="btn btn-success">Guardar datos</button>
                            </div>
                        </div>
                    </div>
                    <br>

                </div>
            </form>
    </div>
@else
    Acceso No válido
    @endif
@endsection

@section('footer')
    <h5>En caso de inconsistencias, favor de reportarlas a victor.ramirez@academicos.udg.mx</h5>
@stop
