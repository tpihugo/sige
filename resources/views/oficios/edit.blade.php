@extends('adminlte::page')
@section('title', 'Crear Oficio Liberación')

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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row ">
                <h2 class="text-center my-3">Crear Oficio Liberación Prestador</h2>
            </div>
            <div>
                <form action="{{ route('oficios.update', $oficio->id) }}" method="POST" class="row">
                    @csrf
                    @method('PUT')
                    <div class="my-1 col-sm-12 col-md-1">
                        <label for="num_oficio" class=" text-center">Oficio CTA</label>
                        <input type="text" class="text-center form-control" name="num_oficio" id="num_oficio"
                            value="{{ $oficio->num_oficio }}">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="dirigido">Dirigido</label>
                        <input type="text" placeholder="Dirigido" value="{{ $oficio->dirigido }}" class="form-control"
                            name="dirigido" id="dirigido">
                    </div>

                    <div class="my-1 col-sm-12 col-md-4">
                        <label for="atencion">Atención</label>
                        <input type="text" placeholder="Atención" value="{{ $oficio->atencion }}" class="form-control"
                            name="atencion" id="atencion">
                    </div>
                    @if (strcmp($oficio->centro_universitario, '-') != 0)
                        <div class="my-1 col-sm-12 col-md-2">
                            <label for="centro_universitario">Centro Universitario</label>
                            <input type="text" placeholder="Atención" value="{{ $oficio->centro_universitario }}"
                                class="form-control" name="centro_universitario" id="centro_universitario">
                        </div>
                    @endif
                    <span class="text-muted my-1"><small>NOTA: Favor de introducir nombres completos del personal</small>
                    </span>
                    <hr>
                    <div class="col-md-12 p-2 ">
                        <label class="form-label" for="">Descripción</label>
                        <textarea class="form-control" name="cuerpo" placeholder="Cuerpo del oficio" id="oficio">
                            {!! $oficio->cuerpo !!}                            
                        </textarea>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="my-2 btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        @else
            El periodo de Registro de Proyectos a terminado
        @endif
    </div>
@endsection
