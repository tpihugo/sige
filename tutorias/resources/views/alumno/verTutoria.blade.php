@extends('layouts.app')
@section('content')

    <div class="container">
        @if(Auth::user()->id == $tutoria->user_id || Auth::user()->role == 'admin')
            <div class="row">
                <p>
                    <a href="{{ route('home') }}" class="btn btn-primary">< Regresar</a>
                </p>
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tutor Elegido</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tbody>
                            @if(isset($tutoria->tutorNombre))
                                <tr>
                                    <th scope="row">Nombre:</th>
                                    <td>{{ $tutoria->tutorNombre }}</td>
                                    <th scope="row">Apellido</th>
                                    <td>{{ $tutoria->apellidos }}</td>
                                    <th scope="row">Correo:</th>
                                    <td>{{ $tutoria->correo }}</td>
                                    <th scope="row">Ciclo</th>
                                    <td>{{ $tutoria->ciclo_tutoria }}</td>
                                </tr>
                            @else
                                <tr>
                                    <th colspan="6">Sin Tutor Seleccionado</th>
                                </tr>
                            @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        @endif
        <p>En caso de tener algún problema, enviar correo a la Coordinación de la Licenciatura en Relaciones Internacionales: coordinacion.lri.udg@gmail.com</p>
        <div class="row">
            <br>

            <hr>
            <p>CENTRO UNIVERSITARIO DE CIENCIAS SOCIALES Y HUMANIDADES.</p>
            <p>Licenciatura en Relaciones Internacionales</p>
            <p>Belenes</p>
        </div>
    </div>


@endsection
