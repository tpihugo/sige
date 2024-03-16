@extends('adminlte::page')
@section('title', 'Home')

@section('css')
    @include('layouts.head_2')
@stop
@section('content')
    <div class="container">
        <div class="row">
            @can('EQUIPOS#ver')
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="d-flex justify-content-center" style="font-size: 12px">
                            <div class="m-2 p-2 border-bottom border-danger text-center text-uppercase">Tickets Abiertos <br> <i
                                    class="material-icons text-dark" style="font-size: 12px">local_offer</i> La
                                Normal:
                                {{ $ticketsNormal }} |
                                <i class="material-icons text-dark" style="font-size: 12px">local_offer</i> Belenes:
                                {{ $ticketsBelenes }}
                            </div>
                            <div class="m-2 p-2 border-bottom border-danger text-center text-uppercase">Cantidad de prestamos
                                <br>
                                <i class="material-icons text-dark" style="font-size: 12px">important_devices</i>
                                Préstamos
                                totales:
                                {{ $prestamos }} | <i class="material-icons text-dark"
                                    style="font-size: 12px">access_time</i> Fuera de
                                tiempo: {{ $notificacion }}
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            <div class="card card-chart mt-2">
                <div class="card-header card-header-success row m-0">
                    <div class="col-sm-12">
                        <h3 class="text-center w-100 my-4">Sistema Integral de Gesti&oacute;n</h3>
                    </div>
                    <div class="col-sm-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (session('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    @foreach ($modulos as $item)
                        <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                            <div class="card card-margin h-100">
                                <div class="card-body pt-2">
                                    <div class="widget-49">
                                        <div class="widget-49-title-wrapper">
                                            <div class="widget-49-date-primary" style="background: {{ $item->color }}">
                                                <i class="material-icons">{{ $item->icono }}</i>
                                            </div>
                                            <div class="widget-49-meeting-info">
                                                <span class="widget-49-pro-title">{{ $item->nombre }}</span>
                                            </div>
                                        </div>
                                        @if (isset($item->enlaces))
                                            <div class="mt-3">
                                                @foreach ($item->enlaces as $enlace)
                                                    @php
                                                        if (Str::contains($enlace->enlace, '148.202.')) {
                                                            $link = $enlace->enlace;
                                                        } else {
                                                            $link = route($enlace->enlace, $enlace->parametro);
                                                        }
                                                    @endphp
                                                    <span><a class="{{ $enlace->estilos }}" href="{{ $link }}">
                                                            {{ $enlace->titulo }}
                                                        </a></span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
