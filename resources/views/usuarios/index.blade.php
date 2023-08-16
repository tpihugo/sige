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

            <div class="row">
                <div class="col-sm-12">
                    <h2>Administración de Usuarios</h2>
                </div>


                @if (session('message'))
                    <div class="alert alert-success col-sm-12">
                        <h4>{{ session('message') }}</h4>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-auto mb-1">
                    <br>
                    <form method="POST" action="{{ route('usuarios.create') }}">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            {{ __('Nuevo Usuario') }}
                        </button>
                    </form>
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

            <div class="row">
                <div class="col-sm-12">
                    <table id="usersTable" class="display table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Activo</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    @if ($usuario->activo == 1)
                                        <td>Activo</td>
                                        <td>
                                            <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                                class="btn-sm btn btn-primary">
                                                Editar
                                            </a>

                                            <a href="{{ route('usuarios.delete', $usuario) }}"
                                                class="btn btn-danger btn-sm">Desactivar</a>
                                        </td>
                                    @else
                                        <td><span class="inactivo">Inactivo</span></td>
                                        <td>
                                            <form method="POST" action="{{ route('usuarios.show', $usuario->id) }}">
                                                @method('GET')
                                                <button type="submit" class=" btn-sm btn btn-success">
                                                    {{ __('Activar') }}
                                                </button>
                                            </form>
                                        </td>
                                    @endif
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