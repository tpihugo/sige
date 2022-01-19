@extends('layout.plantilla')
@section('titulo', 'Mostrar - Libro')


@section('content')
    <h3><b>Titulo</b><br>{{ $libro->titulo }}</h3>
    <h5> <b>Autor</b><br>{{($libro->autor == '') ?'-' :$libro->autor }}</h5>
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <span><b>Clasificación </b><br>{{ $libro->clasificacion }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Año </b> <br>{{($libro->anio == 0) ?'-' :$libro->anio }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Editorial </b> <br>{{($libro->editorial == '') ?'-' :$libro->editorial }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Lugar Publicación </b><br> {{($libro->lugar_publicacion == '') ?'-' :$libro->lugar_publicacion }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <span><b>Volumen </b><br>{{($libro->volumen == '') ?'-' : $libro->volumen }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Fecha de Ingreso </b> <br>{{($libro->fecha_ingreso == '') ?'-' : $libro->fecha_ingreso }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Situación </b> <br>{{($libro->situacion == '') ?'-' : $libro->situacion }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Tómo o Número </b><br> {{($libro->tomo_numero == '') ?'-' : $libro->tomo_numero }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <span><b>Páginas </b><br>{{($libro->paginas == 0) ?'-' :$libro->paginas }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Serie </b> <br>{{($libro->serie == '') ?'-' :$libro->serie }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>ISBN o ISSN </b> <br>{{($libro->isbn_issn == '') ?'-' : $libro->isbn_issn }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Space </b><br>{{($libro->space == '') ?'-' :  $libro->space }}</span>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-sm-12 col-md-3">
            <span><b>Donación </b><br>{{($info->obtencion == '') ?'-' : $info->obtencion }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Resguardo </b> <br>{{($info->resguardo == '') ?'-' : $info->resguardo }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Fecha Publicación </b> <br>{{ ($info->fecha_publicacion == '0000-00-00' ) ? '-' : str_replace(' 00:00:00', '',$info->fecha_publicacion); }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Inventario </b> <br>{{($info->inventario == '') ?'-' : $info->inventario }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <span><b>Código de barras </b><br>{{($info->codigo_barras == '') ?'-' :$info->codigo_barras }}</span>
        </div>


    </div>
    <div class="row">
        <div class="col-sm-12">
            <span><b>Contenido </b> <br>{{($info->contenido == '') ?'-' :$info->contenido }}</span>
        </div>
    </div>

<br/>
@if (Auth::user()->rol == '2' || Auth::user()->rol == '1')
<a href="{{ route('libros.edit', ['libro' => $libro->id]) }}"
    class="btn btn-success col-2">Editar</a>
@endif
<a href="{{route('libros.index')}}" class="btn btn-outline-dark col-2">Regresar</a>
@endsection()
