@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(Auth::check())
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Tablero</div>

                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}

                                </div>
                            @endif
                            <br>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th colspan="4" scope="col">Menú</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(Auth::user()->role =='admin')
                                    <tr>
                                        <th scope="row"><br>Ciclo escolar {{$ciclo}}</th>
                                    </tr>
                                    <tr>
                                        <td align="center"><br><a class="btn btn-primary" href="{{ route('listaInscritosDT',['ciclo' => $ciclo]) }}">Ya inscritos con tutor</a></td>
                                        <td align="center"><br><a class="btn btn-primary" href="{{ route('listaNoInscritosDT',['ciclo' => $ciclo]) }}">Sin inscripción a tutor</a></td>
                                        <td align="center"><br><a class="btn btn-primary" href="{{ route('listaTutorias',['ciclo' => $ciclo]) }}">Listado de Tutorías</a></td>
                                    </tr>
                                    <tr><p></p></tr>
                                    <tr>
                                        <th scope="row" colspan="3"><br>Administración {{$ciclo}}<br></th>
                                    </tr>
                                    <tr>
                                        <td align="center"><br><a class="btn btn-primary" href="{{ route('listaTutores') }}">Listado de Tutores</a></td>
                                        <td align="center"><br><a class="btn btn-success" href="{{ route('createTutor') }}">Capturar Tutores</a></td>
                                        <td align="center"><br><a class="btn btn-success" href="{{ route('createTutoria') }}">Capturar Tutorías</a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="3"><br>Estadísticas {{$ciclo}}<br></th>
                                    </tr>
                                    <tr>

                                        <td align="center"><br><a class="btn btn-success" href="{{ route('graficas') }}">Estadísticas</a></td>
                                    </tr>

                                @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
