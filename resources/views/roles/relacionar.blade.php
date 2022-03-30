@extends('layouts.app')
@section('content')
    <div class="container">
        @if(Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>
                </div>
            @endif
            <div class="row">
                <h2>Asignar Permisos a Roles</h2>
            </div>
            <hr>
                <h4>{{$rol->name }}</h4>
            <hr>
            <div class="row align-items-center">
                <form method="POST" action="{{ route('guardar_relacion_permisos') }}">
                    @method('POST')
                    @csrf
                    <input type="hidden" name="role_id" value="{{ $rol->id }}" />
                    <table id="usersTable" class="display table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Modulo</th>
                                <th>Permiso</th>
                                <th>Asignado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permisos as $permiso)
                                <tr>
                                    <td>{{$permiso['modulo']}}</td>
                                    <td>{{$permiso['permiso']}}</td>
                                    <td>
                                        <input type="checkbox" name="permisos[]" value="{{$permiso['valor']}}" {{ $permiso['checked'] }} />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-success" type="submit">Guardar</button>
                </form>
            </div>
        @else
            El periodo de Registro de Proyectos a terminado
        @endif
    </div>
    <script
        type="text/javascript"
        src="{{ asset('js/usuarios/main.js') }}"
    >
    </script>
@endsection
