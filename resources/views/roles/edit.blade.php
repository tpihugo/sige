@extends('adminlte::page')
@section('title', 'Préstamos edit')

@section('css')
    @include('layouts.head_2')
@stop
@section('content')
    <div class="container">
        @if (Auth::check() &&
                (Auth::user()->role == 'admin' ||
                    Auth::user()->role == 'cta' ||
                    Auth::user()->role == 'aulas' ||
                    Auth::user()->role == 'redes' ||
                    Auth::user()->role == 'auxiliar'))
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>
                </div>
            @endif
            <div class="row">
                <div class="col-md-auto ml-3">
                    <h2>Editar Rol</h2>
                </div>
                <hr>
            </div>

            <form action="{{ route('roles.update', $rol->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        @csrf
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
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <label class="font-weight-bold" for="name">Rol</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $rol->name }}">
                    </div>
                    <div class="col-md-7">
                        <label class="font-weight-bold" for="description">Descripción</label>
                        <input type="text" class="form-control" id="description" name="description"
                            value="{{ $rol->description }}">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('roles.index') }}" class="btn btn-info">Regresar</a>
                                <button type="submit" class="btn btn-success">
                                    Actualizar
                                    <i class="ml-1 fas fa-save"></i>
                                </button>
                                <a href="{{ route('roles.show', $rol->id) }}" class="btn btn-danger">Eliminar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
@endsection
