@extends('adminlte::page')
@section('title', 'Llaves')

@section('css')
    @include('layouts.head_2')

@stop

@section('content')
    @if (Auth::check())
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger text-center">
                            Debe de escribir un criterio de búsqueda
                        </div>
                    @endif
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2>Listado de Llaves </h2>
                    <br>
                    <p align="right">
                        <a href="{{ route('home') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Regresar</a>
                        <a href="{{ route('llaves.create') }}" class="btn btn-success"> <i class="fa fa-plus"></i> Capturar
                            Llave</a>
                    </p>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Área de la Llave</th>
                                <th>Usuario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>

                    </table>
                </div>
            </div>
            <p>
                <a href="{{ route('home') }}" class="btn btn-primary">
                    <- Regresar</a>
            </p>
        </div>
    @else
        Acceso No válido
    @endif
@endsection
@section('js')
    @include('layouts.scripts')
@stop
