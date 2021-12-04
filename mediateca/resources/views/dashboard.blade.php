<<<<<<< HEAD

@extends('layouts.plantillabase')


@section('contenido')
 
<a href="material/create" class="btn btn-primary">CREAR</a>


<table class="table table-dark table-striped">
<thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Título</th>
        <th scope="col">Descripción</th>
        <th scope="col">Formato</th>
        <th scope="col">Etiqueta</th>
        <th scope="col">Tipo de material</th>
        <th scope="col">Duración</th>
        <th scope="col">Año de publicación</th>
        <th scope="col">Participantes</th>
        <th scope="col">Acciones</th>
    </tr>
</thead>
<tbody> 

    @foreach($materials as $material)
    <tr>
        <td>{{$material->id}}</td>
        <td>{{$material->titulo}}</td>
        <td>{{$material->descripcion}}</td>
        <td>{{$material->formato}}</td>
        <td>{{$material->etiqueta}}</td>
        <td>{{$material->tipo_material}}</td>
        <td>{{$material->duracion}}</td>
        <td>{{$material->anio_publicacion}}</td>
        <td>{{$material->participantes}}</td>
        <td>
            <a href="" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Editar</a>
            <button class="btn btn-danger">Borrar</button>
        </td>
    </tr>

    @endforeach
</tbody>
</table>

@endsection
=======
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            </div>
        </div>
    </div>
</x-app-layout>
>>>>>>> ef6d054103bb35bc30a1118bada17638dda61d3c
