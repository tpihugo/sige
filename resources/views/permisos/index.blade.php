@extends('adminlte::page')
@section('title', 'Permisos')
{{--
@extends('layouts.app')
--}}
@section('css')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
@stop
@section('content')
    <div class="container">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>
                </div>
            @endif
            <div class="row mt-2">
                <h2>Administración de Permisos</h2>
            </div>
            <form method="POST" action="{{ route('permisos.store') }}">
                @csrf
                <div class="row">
                    <div class="col-mb-4 mx-1">
                        <label for="permiso" class="col-form-label text-md-right">{{ __('Nuevo Permiso') }}</label>
                    </div>
                    <div class="col-mb-5 mx-1">
                        <input id="permiso" type="text" class="form-control" name="permiso"
                            placeholder="NOMBRE_DEL_MODULO#accion" required>
                    </div>
                    <div class="col-mb-4 mx-1">
                        <button type="submit" class="btn btn-primary">{{ __('Nuevo Permiso') }}</button>
                    </div>
                </div>
            </form>
            <hr>

            <div class="row align-items-center justify-content-center">
                <div class="col-sm-12">
                    <table id="usersTable" class="display table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Modulo</th>
                                <th>Permiso</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permisos as $permiso)
                                <tr>
                                    <td>{{ $permiso['modulo'] }}</td>
                                    <td>{{ $permiso['permiso'] }}</td>
                                    <td>
                                        <form method="GET" action="{{ route('permisos.edit', $permiso['id']) }}">
                                            <button type="submit" class="btn btn-danger">
                                                {{ __('Eliminar') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        @else
            El periodo de Registro de Proyectos a terminado
        @endif
    </div>
@section('js')
    <script type="text/javascript" src="{{ asset('js/usuarios/main.js') }}"></script>
@stop

@endsection
