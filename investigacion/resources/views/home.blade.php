@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if(Auth::user()->role=='evaluador')
                        {{ __('Evaluador') }}</div>
                    @elseif(Auth::user()->role=='investigador')
                        {{ __('Investigador') }}</div>
                    @elseif(Auth::user()->role=='admin')
                        {{ __('Administrador') }}</div>
                    @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <table class="table">
                            <thead>
                            <tr>
                                <th colspan="4" scope="col">Menú</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row" width="20%"><br>Proyectos</th>
                                @if(Auth::user()->role != 'investigador-evaluador')
                                    <td width="50%"><br>Muestra el proyecto de investigación registrado o le permite capturar uno nuevo</td>
                                    <td width="15%"><br><a href="{{ route('proyectos.index') }}" class="btn btn-primary">Ver proyectos</a></td>
                                    <td width="15%"><br>
                                        @if(Auth::user()->role == 'admin')
                                            <p><a href="{{route('index-general')}}" class="btn btn-success">Tabla general</a></p>
                                        @endif
                                    </td>
                                @else
                                    <td width="50%"><br>Muestra el proyecto de investigación registrado o los proyectos para evaluarlos</td>
                                    <td width="15%"><br><a href="{{ route('proyectos.index') }}" class="btn btn-primary">Proyectos como investigador</a></td>
                                    <td width="15%"><br><p><a href="{{route('proyectos-evaluador')}}" class="btn btn-success">Proyectos como evaluador</a></p></td>
                                @endif

                            </tr>



                            </tbody>
                        </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
