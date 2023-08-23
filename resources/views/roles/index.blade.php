@extends('adminlte::page')
@section('title', 'Usuarios')
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
            <div class="row">
                <h2>Administración de Roles</h2>
                @if (isset($success))
                    <div class="alert alert-success">
                        {{ $success }}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-auto mb-1">
                    <a type="submit" href="{{ route('roles.create') }}" class="btn btn-primary">
                        {{ __('Nuevo Rol') }}
                    </a>

                </div>
            </div>

            @if (isset($retorno))
                @if (count($retorno['Error']) > 0)
                    <div class="alert alert-danger" id="alert" role="alert">
                        {{ implode("\n", $retorno['Error']) }}
                    </div>
                @else
                    <div class="alert alert-info" id="alert" role="alert">
                        {{ implode("\n", $retorno['Success']) }}
                    </div>
                @endif
            @endif

            <div class="row align-items-center justify-content-center">
                <div class="col-sm-12">
                    <table id="usersTable" class=" display table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Rol</th>
                                <th>Descripción</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->description }}</td>
                                    <td>
                                        <form method="GET" action="{{ route('roles.edit', $role->id) }}">
                                            <button type="submit" class="btn btn-info">
                                                {{ __('Editar') }}
                                            </button>
                                            <a href="{{ route('asignar_permisos', $role->id) }}"><button type="button"
                                                    class="btn btn-success">Relacionar Permisos</button> </a>
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
    <script type="text/javascript" src="{{ asset('js/usuarios/main.js') }}"></script>
@endsection
