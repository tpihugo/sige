@extends('layout.plantilla')
@section('titulo', 'Prestamos')

@section('content')
@foreach ($usuarios as $item)
    <div class="card w-100 m-1">
        <div class="card-body">
            <h3 class="card-title"><b>Nombre </b>{{ $item->name }}</h3>
            <h5>
                <b class="card-text">Rol </b>
                @if ($item->rol == '0')

                    <td>General</td>
                @endif
                @if ($item->rol == '1')

                    <td>Trabajador UDG</td>
                @endif
                @if ($item->rol == '2')

                    <td>Administrador</td>
                @endif
                <b class="card-text">Correo </b>{{ $item->email }}
            </h5>

        </div>
    </div>
@endforeach
@if ($usuarios->all() == null)
    <hr>
    <h2>No hay coincidencias</h2>
@endif
@endsection
