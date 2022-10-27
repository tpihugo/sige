@extends('adminlte::page')
@section('title', 'Expediente |')
{{--@extends('layouts.app')--}}
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('plugins.BsCustomFileInput', true)
@section('content')
@include('expediente.edit')
@if(Auth::check() && Auth::user()->role == 'admin')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
<!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0">Expediente</h1>
            </div><!-- /.col -->
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li ><a class="btn bg-gradient-dark mb-0" href="{{route('Imprimirexpediente',$equipo[0])}}" target="_blank"> <i class="fas fa-file-pdf"></i>&nbsp;&nbsp;Imprimir expediente</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

    {{--Contenido de equipo y tickets--}}
    <div class="row">
        {{--card contenido del equipo--}}
        <div class="col-md-7">
        <x-adminlte-card title="Información de equipo" theme="success" icon="fas fa-desktop" footer-class="mx-auto bg-white" >
            @foreach($equipo as $value)
                <strong><i class="fas fa-desktop"></i> Tipo de Equipo:</strong>
            <div class="row">
                <div class="col-md-9">

                <h3 class="m-y3">{{$value[2]}}</h3>
                </div>
                <div class="col-md-3">
                <x-adminlte-button class="btn bg-gradient-info"  data-toggle="modal" data-target="#modal-editar-equipo2" icon="fas fa-edit"/>
                <x-adminlte-button class="btn bg-gradient-danger" data-toggle="modal" data-target="#modal-eliminar" icon="fas fa-trash"/>

                </div>
            </div>
                <hr>
                <strong><i class="fas fa-book mr-1"></i> Descripción</strong>
                <p >{{$value[6]}}</p><hr>
                <strong><i class="fas fa-book mr-1"></i> Modelo:</strong>
                <p >{{$value[4]}}</p><hr>
                <strong><i class="fas fa-book mr-1"></i> Marca:</strong>
                <p >{{$value[3]}}</p><hr>
            @endforeach
            <x-slot name="footerSlot" >
                <x-adminlte-button class="btn btn-app bg-gradient-info" data-toggle="modal" data-target="#modal-requisicion" label="Requisición" icon="fas fa-inbox"/>
                <x-adminlte-button class="btn btn-app bg-gradient-info" data-toggle="modal" data-target="#modal-cotizacion" label="Cotización" icon="fas fa-inbox"/>
                <x-adminlte-button class="btn btn-app bg-gradient-info" data-toggle="modal" data-target="#modal-factura" label="Factura" icon="fas fa-inbox"/>
                <x-adminlte-button class="btn btn-app bg-gradient-info" data-toggle="modal" data-target="#modal-otros" label="Otros" icon="fas fa-inbox"/>

            </x-slot>
        </x-adminlte-card>
        </div>
        {{--card contenido del los tickets del equipo--}}
        <div class="col-md-5">
        <x-adminlte-card title="Tickets"  theme="success" icon="fas fa-desktop"  icon="fas fa-file" >
            <div class="row">
                <div class="col-md-10">
                    @if ($ticket)
                        <ul class="list-group">
                            @foreach($ticket as $tickets)
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-1 text-dark text-sm">Id del ticket: {{$tickets[1]}} </h6>
                                                <h6 class="mb-1 text-dark text-sm">Resguardante: {{$tickets[2]}}</h6>
                                                {!! $tickets[0] !!}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Sin tickets</p>
                    @endif
                </div>
                <div class="col-md-2">
                    <a class="btn bg-gradient-info" icon="fas fa-edit" href="{{ route('tickets.create') }}">Crear</a>

                </div>
            </div>

        </x-adminlte-card>
        </div>
    </div>
<!-- /.row fin contenido equipo y tickets -->
    {{--Contenido de matenimientos, revisiónes express y proyectos--}}
    <div class="row">
        {{--card contenido mantenimientos--}}
        <div class="col-md-6">
            <x-adminlte-card title="Mantenimientos" theme="success" icon="fas fa-desktop" footer-class="mx-auto bg-white" >
                <div class="row">
                    <div class="col-md-10">
                        <ul class="list-group">
                            @if ($mantenimiento)
                                    @foreach($mantenimiento as $mantenimiento)
                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                            <div class="col-lg-10">
                                                <h6 class="mb-3 text-sm">Realizo</h6>
                                                <span class="mb-12 text-xs">Fecha: <span class="text-dark font-weight-bold ms-sm-2">{{\Carbon\Carbon::parse($mantenimiento[2])->format('d/m/Y')}}</span></span>
                                                <span class="mb-12 text-xs">Detalles: <span class="text-dark ms-sm-2 font-weight-bold">{{$mantenimiento[1]}}</span></span>
                                                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="{{route('delete-man-equipo',$mantenimiento[0],$equipo[0])}}"><i class="material-icons text-sm me-2">delete</i>Eliminar</a>
                                            </div>
                                    @endforeach
                                @else
                                    <p>Sin mantenimientos</p>
                                        </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-2">
                        <x-adminlte-button class="btn bg-gradient-info" data-toggle="modal" data-target="#modalManto" label="Crear" />

                    </div>
                </div>
        </x-adminlte-card>
        </div>
        {{--card contenido revisiones express--}}
        {{--card contenido proyectos--}}
        <div class="col-md-6">
            <x-adminlte-card title="Proyectos"  theme="success" icon="fas fa-desktop"  icon="fas fa-file" >
            <div class="row">
                <div class="col-md-10">
                    <ul class="list-group">
                        @if($proyecto)
                            @foreach($proyecto as $proyectos)
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex flex-column">

                                        <h6 class="mb-1 text-dark font-weight-bold text-sm">Titulo:</h6>
                                        <span class="text-xs">{{$proyectos[1]}}</span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark font-weight-bold text-sm">Area interna</h6>
                                        <span>{{$proyectos[2]}}</span>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <p>Sin proyectos</p>
                        @endif

                    </ul>
                </div>
                <div class="col-md-2">
                    <a href="{{route('proyectos.create')}}" class="btn bg-gradient-info">Agregar</a>
                </div>
            </div>

        </x-adminlte-card>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <x-adminlte-card title="Revisiones express"  theme="success" icon="fas fa-desktop"  icon="fas fa-file" >
                <ul class="list-group">
                    @if ($revicion)
                        @foreach($revicion as $reviciones)
                            <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <span><h6 class="mb-3 text-sm" style="font-family: Arial, Helvetica, sans-serif">Sede: <span class="text-dark ms-sm-2 font-weight-bold">{{$reviciones[1]}}</span></h6> </span>
                                    <span class="mb-2 text-12" style="font-family: Arial, Helvetica, sans-serif"><h6>Area: <span class="text-dark ms-sm-2 font-weight-bold">{{$reviciones[4]}}</span>&nbsp; Piso:<span class="text-dark ms-sm-2 font-weight-bold">{{$reviciones[3]}}</span>&nbsp; Edificio:<span class="text-dark ms-sm-2 font-weight-bold">{{$reviciones[2]}}</span></h6></span>
                                    <span class="mb-2 text-xs" style="font-family: Arial, Helvetica, sans-serif"><h6>Estatus: <span class="text-dark font-weight-bold ms-sm-2">{{$reviciones[5]}}</span></h6></span>
                                    <span class="mb-2 text-12" style="font-family: Arial, Helvetica, sans-serif"><h6>Fecha: <span class="text-dark ms-sm-2 font-weight-bold">{{\Carbon\Carbon::parse($reviciones[6])->format('d/m/y')}} &nbsp;</span>Hora:<span class="text-dark ms-sm-2 font-weight-bold">{{\Carbon\Carbon::parse($reviciones[6])->format('h:m:s')}}</span></h6></span>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <h6>Sin revisiones</h6>
                    @endif
                </ul>
            </x-adminlte-card>
        </div>
    </div>
<!-- /.row de matenimientos, revisiónes express y proyectos -->

    {{-- modal-edición-de-equipo --}}
{{--<x-adminlte-modal id="modal-editar-equipo" title="Editar equipo" theme="primary" icon="fas fa-inbox" size='lg' disable-animations>
    --}}{{-- Placeholder, sm size and prepend icon --}}{{--
    @foreach($equipo as $value)
    --}}{{--<iframe src="{{route('equipos.edit', $value[0])}}" frameborder="0" ></iframe>--}}{{--
    @endforeach
    <x-slot name="footerSlot">
        <x-adminlte-button  theme="danger" label="Cancelar" data-dismiss="modal"/>
        <x-adminlte-button  theme="success" label="Cargar"/>
    </x-slot>
</x-adminlte-modal>--}}
    {{-- modal-requisicion --}}
{{--<x-adminlte-modal id="modal-requisicion2" title="Cargar requisiciòn" theme="primary" icon="fas fa-inbox" size='lg' disable-animations>
    --}}{{-- Placeholder, sm size and prepend icon --}}{{--
    <x-adminlte-input-file name="ifPholder" igroup-size="sm" legend="Buscar archivo" placeholder="Seleccionar archivo...">
        <x-slot name="prependSlot">
            <div class="input-group-text text-primary">
                <i class="fas fa-file-upload"></i>
            </div>
        </x-slot>
    </x-adminlte-input-file>
    <x-slot name="footerSlot">
        <x-adminlte-button  theme="danger" label="Cancelar" data-dismiss="modal"/>
        <x-adminlte-button  theme="success" label="Cargar"/>
    </x-slot>
</x-adminlte-modal>--}}

    <div class="container-fluid">
        <div class="row">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif


<body class="g-sidenav-show bg-gray-200">
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      {{--<h1 class="font-weight-bolder mb-0">Expediente</h1>--}}
    </nav>
    <div class="col-6 text-end">
{{--
      <a class="btn bg-gradient-dark mb-0" href="{{route('Imprimirexpediente',$equipo[0])}}" target="_blank"> <i class="fas fa-file-pdf"></i>&nbsp;&nbsp;Imprimir expediente</a>
--}}
      </div>


    </div>
  </div>
</nav>
<!-- End Navbar -->
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="row">
        <div class="col-md-9mb-lg-0 mb-4">
          <div class="card">
            <div class="card-header pb-0 p-1">
              <div class="card-body p-1">
                <ul class="list-group">
                @foreach($equipo as $equipo)
                  <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                    {{--<div class="d-flex flex-column">
                      <h3>Información del equipo</h3>
                      <h6>Tipo de equipo: <span class="text-dark ms-sm-1 font-weight-bold">{{$equipo[2]}}</span><h6>
                      <h6>Descripción: <span class="text-dark ms-sm-2 font-weight-bold">{{$equipo[6]}}</span></h6>
                      <h6>Modelo: <span class="text-dark ms-sm-2 font-weight-bold">{{$equipo[4]}}</span></h6>
                      <h6>Marca: <span class="text-dark ms-sm-2 font-weight-bold">{{$equipo[3]}}</span></h6>
                    </div>--}}
                    <div class="ms-auto text-end">
                      <a href="#delete" role="button" class="btn btn-link text-danger text-gradient px-3 mb-0" data-toggle="modal" title="Eliminar">
                              Eliminar
                          </a>
                            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                               <div class="modal-content">
                                  <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este equipo?</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                       </button>
                                 </div>
                         <div class="modal-body">
                        <p class="text-primary">
                          <small>
                            Marca: '.{{$equipo[3]}}.', Modelo:'.{{$equipo[4]}}.', N/S: '.{{$equipo[5]}}.'
                          </small>
                           </p>
                         </div>
                           <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="{{route('delete-equipo', $equipo[0])}}" type="button" class="btn btn-danger">Eliminar</a>
                         </div>
                          </div>
                      </div>
                  </div>
                      <a class="btn btn-link text-dark px-3 mb-0" href="{{route('equipos.edit', $equipo[0])}}"><i class="material-icons text-sm me-2">edit</i>Editar</a>
                    </div>
                  </li>

                </ul>
              </div>
            </div>

            <div class="container-fluid">
              <div class="row row-cols-1 row-cols-sm-2 row-cols-md-6">

              @if($equipo[8]=="")

                <div class="col">
                  <a href="javascript:;" type="button" data-toggle="modal" data-target="#modalR" data-dismiss="modal">
                    <div class="btn p-3">
                      <div class="card-header mx-5 p-1 text-center">
                        <div class=" pt-3 icon-lg fas fa-file border-radius-lg text-center">
                          <i class="fas fa-file-pdf " style="color:#fff"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-1 text-center">
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">Requisición</h5>
                      </div>
                    </div>
                  </a>
                </div>

                     <div class="modal fade" id="modalR" tabindex="-1" role="dialog" aria-labelledby="modalProyecto" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           <form action="{{route('expedientes.update', $equipo[0])}}" method="post" enctype="multipart/form-data" class="col-12">
                              @method('put')
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cargar requisición</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body p-3">
                           <div class="mb-3">
                            <input type="hidden" name="requisicion" id="requisicion" value="1">
                            <input class="form-control btn btn-outline" type="file" name="file" id="file">
                          </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <button type="submit" class="btn btn-primary">Cargar</button>
                            </div>
                              @csrf
                          </form>
                          </div>
                        </div>
                      </div>

                @else
                <div class="col">
                  <a href="../../storage/app/documentos/{{$equipo[8]}}" target="_blank">
                    <div class="btn p-3">
                      <div class="card-header mx-5 p-1 text-center">
                        <div class=" pt-3 icon-lg fas fa-file border-radius-lg text-center">
                          <i class="fas fa-file-pdf " style="color:#fff"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-1 text-center">
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">Ver requisición</h5>
                      </div>
                    </div>
                  </a>
                </div>
                @endif


                @if($equipo[9]=="")

                <div class="col">
                  <a href="javascript:;" type="button" data-toggle="modal" data-target="#modalC" data-dismiss="modal">
                    <div class="btn p-3">
                      <div class="card-header mx-5 p-1 text-center">
                        <div class=" pt-3 icon-lg fas fa-money border-radius-lg text-center">
                          <i class="fas fa-file-pdf " style="color:#fff"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-1 text-center">
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">Cotización</h5>
                      </div>
                    </div>
                  </a>
                </div>

                     <div class="modal fade" id="modalC" tabindex="-1" role="dialog" aria-labelledby="modalProyecto" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           <form action="{{route('expedientes.update', $equipo[0])}}" method="post" enctype="multipart/form-data" class="col-12">
                              @method('put')
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cargar Cotización</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body p-3">
                           <div class="mb-3">
                            <input type="hidden" name="cotizacion" id="cotizacion" value="2">
                            <input class="form-control btn btn-outline" type="file" name="file" id="file">
                          </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <button type="submit" class="btn btn-primary">Cargar</button>
                            </div>
                              @csrf
                          </form>
                          </div>
                        </div>
                      </div>

                @else
                <div class="col">
                  <a href="../../storage/app/documentos/{{$equipo[9]}}" target="_blank">
                    <div class="btn p-3">
                      <div class="card-header mx-5 p-1 text-center">
                        <div class=" pt-3 icon-lg fas fa-money  border-radius-lg text-center">
                          <i class="fas fa-file-pdf " style="color:#fff"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-1 text-center">
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">Ver cotización</h5>
                      </div>
                    </div>
                  </a>
                </div>
                @endif

                @if($equipo[10]=="")

                <div class="col">
                  <a href="javascript:;" type="button" data-toggle="modal" data-target="#modalF" data-dismiss="modal">
                    <div class="btn p-3">
                      <div class="card-header mx-5 p-1 text-center">
                        <div class=" pt-3 icon-lg fas fa-file-invoice  border-radius-lg text-center">
                          <i class="fas fa-file-pdf " style="color:#fff"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-1 text-center">
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">Factura</h5>
                      </div>
                    </div>
                  </a>
                </div>

                     <div class="modal fade" id="modalF" tabindex="-1" role="dialog" aria-labelledby="modalProyecto" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           <form action="{{route('expedientes.update', $equipo[0])}}" method="post" enctype="multipart/form-data" class="col-12">
                              @method('put')
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cargar Factura</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body p-3">
                           <div class="mb-3">
                            <input type="hidden" name="factura" id="factura" value="3">
                            <input class="form-control btn btn-outline" type="file" name="file" id="file">
                          </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <button type="submit" class="btn btn-primary">Cargar</button>
                            </div>
                              @csrf
                          </form>
                          </div>
                        </div>
                      </div>

                @else
                <div class="col">
                  <a href="../../storage/app/documentos/{{$equipo[10]}}" target="_blank">
                    <div class="btn p-3">
                      <div class="card-header mx-5 p-1 text-center">
                        <div class="pt-3 icon-lg fas fa-file-invoice  border-radius-lg text-center">
                          <i class="fas fa-file-pdf " style="color:#fff"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-1 text-center">
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">Ver factura</h5>
                      </div>
                    </div>
                  </a>
                </div>
                @endif

                @if($equipo[11]=="")

                <div class="col">
                  <a href="javascript:;" type="button" data-toggle="modal" data-target="#modalO" data-dismiss="modal">
                    <div class="btn p-3">
                      <div class="card-header mx-5 p-1 text-center">
                        <div class=" pt-3 icon-lg fas fa-plus border-radius-lg text-center">
                          <i class="fas fa-file-pdf " style="color:#fff"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-1 text-center">
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">Otros</h5>
                      </div>
                    </div>
                  </a>
                </div>

                     <div class="modal fade" id="modalO" tabindex="-1" role="dialog" aria-labelledby="modalProyecto" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           <form action="{{route('expedientes.update', $equipo[0])}}" method="post" enctype="multipart/form-data" class="col-12">
                              @method('put')
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cargar Otros</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body p-3">
                           <div class="mb-3">
                            <input type="hidden" name="otros" id="otros" value="4">
                            <input class="form-control btn btn-outline" type="file" name="file" id="file">
                          </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <button type="submit" class="btn btn-primary">Cargar</button>
                            </div>
                              @csrf
                          </form>
                          </div>
                        </div>
                      </div>

                @else
                <div class="col">
                  <a href="../../storage/app/documentos/{{$equipo[11]}}" target="_blank">
                    <div class="btn p-3">
                      <div class="card-header mx-5 p-1 text-center">
                        <div class=" pt-3 icon-lg fas fa-plus  border-radius-lg text-center">
                          <i class="fas fa-file-pdf " style="color:#fff"></i>
                        </div>
                      </div>
                      <div class="card-body pt-0 p-1 text-center">
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">Ver otros</h5>
                      </div>
                    </div>
                  </a>
                </div>
                @endif

              </div>
            </div>
          </div>
        </div>


      </div>
    </div>

    <div class="col-md-4 mt-0 d-flex">
      <div class="card h-100 mb-4">
        <div class="card-header pb-0 px-3">
          <div class="row">
            <div class="col-md-6">
              <h6 class="mb-0">TICKETS</h6>
            </div>
            <div class="col-6 text-end">
              <a class="btn btn-outline-primary btn-md mb-0" href="{{ route('tickets.create') }}"><i class="material-icons text-sm"></i>Crear ticket</a>
              </div>

          </div>
        </div>
        <div class="card-body pt-4 p-3">
          <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3"></h6>
        @if ($ticket)

          <ul class="list-group">


            @foreach($ticket as $tickets)

            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
              <div class="d-flex align-items-center">
                <div class="d-flex flex-column">

                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Id del ticket: {{$tickets[1]}} </h6>
                      <h6 class="mb-1 text-dark text-sm">Resguardante: {{$tickets[2]}}</h6>
                      {!! $tickets[0] !!}


                    </div>


                </div>
              </div>

            </li>


            @endforeach



          </ul>

        @else
        <h2>No hay tickets a mostrar</h2>
        @endif
        </div>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-8 mt-1 d-flex">
      <div class="card">
        <div class="card-header pb-0 px-3">
          <h6 class="mb-0">MANTENIMIENTOS</h6>
          <div class="row-4 text-end">
            <a class="btn btn-outline-primary btn-md mb-0" href="" data-toggle="modal" data-target="#modalManto" data-dismiss="modal"><i class="material-icons text-sm"></i>Crear mantenimiento</a> &nbsp; &nbsp;
          </div>
        </div>
        <div class="modal fade" id="modalManto" tabindex="-1" aria-labelledby="modalMantenimientos" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">


                <h5 class="modal-title" id="exampleModalLabel">Crear mantenimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            <form action="{{route('mantenimiento-equipo',$equipo[0])}}" method="post" enctype="multipart/form-data" class="col-12">
              {!! csrf_field() !!}

              <div class="modal-body">
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label" >Detalles del mantenimiento</label>
                  <input type="hidden" name="equipos_id" value="{{$equipo[0]}}">
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="detalles"></textarea>

                  <label for="id_area">Área para mantenimiento</label>
                                <select class="form-control" class="form-control" id="js-example-basic-single" name="area_id">
                                    <option value="No Aplica" selected>No Aplica</option>
                                    @foreach($areas as $area)
                                        <option value="{{$area->id}}">{{$area->sede}} - {{$area->division}} - {{$area->coordinacion}} - {{$area->area}}</option>
                                    @endforeach
                                </select>

                    <label for="tecnico_id">Técnico para mantenimiento</label>
                    <select class="form-control" class="form-control" id="js-example-basic-single2" name="tecnico_id">
                        <option value="No Aplica" selected>No Aplica</option>
                        @foreach($tecnicos as $tecnicos)
                            <option value="{{$tecnicos->id}}">{{$tecnicos->nombre}} - {{$tecnicos->telefono}} - {{$tecnicos->telefono_emergencia}} </option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            </form>

            </div>

          </div>
        </div>
        <div class="card-body pt-4 p-3">
          <ul class="list-group">
            @if ($mantenimiento)
            @foreach($mantenimiento as $mantenimiento)
          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">

                  <div class="col-lg-10">
                    <h6 class="mb-3 text-sm">Realizo</h6>
                    <span class="mb-12 text-xs">Fecha: <span class="text-dark font-weight-bold ms-sm-2">{{\Carbon\Carbon::parse($mantenimiento[2])->format('d/m/Y')}}</span></span>
                    <span class="mb-12 text-xs">Detalles: <span class="text-dark ms-sm-2 font-weight-bold">{{$mantenimiento[1]}}</span></span>

                      <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="{{route('delete-man-equipo',$mantenimiento[0],$equipo[0])}}"><i class="material-icons text-sm me-2">delete</i>Eliminar</a>

                  </div>
                  @endforeach

                  @else
                  <h2>Sin mantenimientos</h2>
            </li>

            @endif

          </ul>
        </div>
      </div>
    </div>

    <div class="col-md-4 mt-5 d-flex">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-6 d-flex align-items-center">
              <h6 class="mb-0">PROYECTOS</h6>
            </div>
            <div class="col-6 text-end">
              <a href="{{route('proyectos.create')}}" class="btn btn-outline-primary btn-sm mb-0">Agregar</a>
            </div>
          </div>
        </div>
        <div class="card-body p-3 pb-0">
          <ul class="list-group">
            @if($proyecto)

            @foreach($proyecto as $proyectos)
            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
              <div class="d-flex flex-column">

                <h6 class="mb-1 text-dark font-weight-bold text-sm">Titulo:</h6>
                <span class="text-xs">{{$proyectos[1]}}</span>
              </div>
              <div class="d-flex flex-column">
                <h6 class="mb-1 text-dark font-weight-bold text-sm">Area interna</h6>
                <span>{{$proyectos[2]}}</span>

              </div>
            </li>
            @endforeach
            @else
            Sin proyectos
            @endif

          </ul>
        </div>
      </div>
    </div>


    <div class="col-sm-12 mt-5 d-flex ">
      <div class="card">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-6 d-flex align-items-center">
              <h6 class="mb-0">Revición express</h6>
            </div>
          </div>
          </div>

        <div class="card-body pt-4 p-3">
          <ul class="list-group">
            @if ($revicion)
            @foreach($revicion as $reviciones)
            <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
              <div class="d-flex flex-column">
                <span><h6 class="mb-3 text-sm" style="font-family: Arial, Helvetica, sans-serif">Sede: <span class="text-dark ms-sm-2 font-weight-bold">{{$reviciones[1]}}</span></h6> </span>
                <span class="mb-2 text-12" style="font-family: Arial, Helvetica, sans-serif"><h6>Area: <span class="text-dark ms-sm-2 font-weight-bold">{{$reviciones[4]}}</span>&nbsp; Piso:<span class="text-dark ms-sm-2 font-weight-bold">{{$reviciones[3]}}</span>&nbsp; Edificio:<span class="text-dark ms-sm-2 font-weight-bold">{{$reviciones[2]}}</span></h6></span>
                <span class="mb-2 text-xs" style="font-family: Arial, Helvetica, sans-serif"><h6>Estatus: <span class="text-dark font-weight-bold ms-sm-2">{{$reviciones[5]}}</span></h6></span>
                <span class="mb-2 text-12" style="font-family: Arial, Helvetica, sans-serif"><h6>Fecha: <span class="text-dark ms-sm-2 font-weight-bold">{{\Carbon\Carbon::parse($reviciones[6])->format('d/m/y')}} &nbsp;</span>Hora:<span class="text-dark ms-sm-2 font-weight-bold">{{\Carbon\Carbon::parse($reviciones[6])->format('h:m:s')}}</span></h6></span>

              </div>

            </li>
            @endforeach
            @else
                <h6>Sin revicion</h6>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
       @endforeach




  <!--   Core JS Files   -->
{{--  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>--}}
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
{{--  <script async defer src="https://buttons.github.io/buttons.js"></script>--}}
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
{{--  <script src="../assets/js/material-dashboard.min.js?v=3.0.0"></script>--}}
</body>

@else
    Acceso No válido
@endif
@endsection
