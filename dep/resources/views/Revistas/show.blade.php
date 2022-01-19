@extends('layout.plantilla')
@section('titulo', 'Mostrar - Revista')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h3><b>Titulo </b><br>{{ $revista->titulo == '' ? '-' : $revista->titulo }}</h3>
        </div>
        <div class="col-sm-12 col-md-3">
            <h4><b>Clasificación </b><br>{{ $revista->clasificacion == '' ? '-' : $revista->clasificacion }}</h4>
        </div>
        <div class="col-sm-12">
            <h5> <b>Autor</b><br>{{ $revista->autor == '' ? '-' : $revista->autor }}</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-3">
            <span><b>Año: </b> <br>{{ $revista->anio == 0 ? '-' : $revista->anio }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Editorial: </b> <br>{{ $revista->editorial == '' ? '-' : $revista->editorial }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Lugar Publicación: </b><br>
                {{ $revista->lugar_publicacion == '' ? '-' : $revista->lugar_publicacion }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Volumen: </b><br>{{ $revista->volumen == '' ? '-' :$revista->volumen }}</span>
        </div>
    </div>
    <div class="row">


        <div class="col-sm-12 col-md-3">
            <span><b>Situación: </b> <br>{{ $revista->situacion == '' ? '-' :$revista->situacion }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Tómo o Número: </b><br> {{ $revista->tomo_numero == '' ? '-' : $revista->tomo_numero }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Páginas: </b><br>{{ $revista->paginas == 0 ? '-' :$revista->paginas }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Serie: </b> <br>{{ $revista->serie == '' ? '-' :$revista->serie }}</span>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-12 col-md-3">
            <span><b>ISBN o ISSN: </b> <br>{{ $revista->isbn_issn == '' ? '-' :$revista->isbn_issn }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Space: </b> <br>{{ $revista->space == '' ? '-' :$revista->space }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Space 2: </b> <br>{{ $revista->space2 == '' ? '-' :$revista->space2 }}</span>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-sm-12 col-md-3">
            <span><b>Obtencion: </b><br>{{ $info->obtencion == '' ? '-' :$info->obtencion }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Resguardo: </b> <br>{{ $info->resguardo == '' ? '-' :$info->resguardo }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Código de Barras: </b><br>{{ $info->codigo_barras == 0 ? '-' :$info->codigo_barras }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <span><b>Inventario: </b> <br>{{ $info->inventario == '' ? '-' :$info->inventario }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Fecha Publicación: </b> <br>{{ ($info->fecha_publicacion == 0 ) ? 'Desconocida' : str_replace(' 00:00:00', '',$info->fecha_publicacion); }}</span>
        </div>
        <div class="col-sm-12 col-md-3">
            <span><b>Fecha de Ingreso: </b> <br>{{ str_replace(' 00:00:00', '',$revista->fecha_ingreso) }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <span><b>Contenido: </b> <br>{{ $info->contenido == '' ? '-' :$info->contenido }}</span>
        </div>
    </div>
<br/>
    @if (Auth::user()->rol == '2' || Auth::user()->rol == '1')
        <a href="{{ route('revistas.edit', ['revista' => $revista->id]) }}"
            class="btn btn-success col-2">Editar</a>
    @endif
    <a href="{{ route('revistas.index') }}" class="btn btn-outline-dark col-2">Regresar</a>
@endsection
