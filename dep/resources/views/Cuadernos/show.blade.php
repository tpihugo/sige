@extends('layout.plantilla')
@section('titulo', 'Mostrar - Cuadernos')


@section('content')
    <h3><b>Titulo </b><br>{{ $cuaderno->titulo }}</h3>
    <h5> <b>Autor</b><br>{{($cuaderno->autor == '') ?'-' :$cuaderno->autor }}</h5>
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <span><b>Clasificación</b><br>{{ $cuaderno->clasificacion }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Año </b> <br>{{($cuaderno->anio == 0) ?'-' :$cuaderno->anio }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Editorial </b> <br>{{($cuaderno->editorial == '') ?'-' :$cuaderno->editorial }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Lugar Publicación </b><br> {{($cuaderno->lugar_publicacion == '') ?'-' :$cuaderno->lugar_publicacion }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <span><b>Volumen </b><br>{{($cuaderno->volumen == '') ?'-' : $cuaderno->volumen }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Fecha de Ingreso </b> <br>{{ str_replace(' 00:00:00', '',$cuaderno->fecha_ingreso) }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Situación </b> <br>{{($cuaderno->situacion == '') ?'-' : $cuaderno->situacion }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Tómo o Número </b><br> {{($cuaderno->tomo_numero == '') ?'-' :$cuaderno->tomo_numero }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <span><b>Páginas </b><br>{{($cuaderno->paginas == 0) ?'-' :$cuaderno->paginas }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Serie </b> <br>{{($cuaderno->serie == '') ?'-' :$cuaderno->serie }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>ISBN o ISSN </b> <br>{{($cuaderno->isbn_issn == '') ?'-' :$cuaderno->isbn_issn }}</span>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <span><b>Obtencion </b><br>{{($info->obtencion == '') ?'-' :$info->obtencion }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Resguardo </b> <br>{{($info->resguardo == '') ?'-' :$info->resguardo }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Contenido </b> <br>{{($info->contenido == '') ?'-' :$info->contenido }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <span><b>Código de Barras </b><br>{{($info->codigo_barras == 0) ?'-' : $info->codigo_barras }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Inventario </b> <br>{{($info->inventario == '') ?'-' :$info->inventario }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Fecha Publicación </b> <br>{{ ($info->fecha_publicacion == '0000-00-00' or $info->fecha_publicacion == '') ? '-'  :str_replace(' 00:00:00', '',$info->fecha_publicacion); }}</span>
        </div>
    </div>
<hr/>
    @if (Auth::user()->rol == '2' || Auth::user()->rol == '1')
        <a href="{{ route('cuadernos.edit',$cuaderno->id) }}"
            class="btn btn-success col-sm-3">Editar</a>
    @endif
    <a class="btn btn-outline-dark col-sm-12 col-md-3 col-xl-2" href="{{ route('cuadernos.index') }}">Regresar</a>
@endsection()
