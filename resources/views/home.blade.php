@extends('adminlte::page')
@section('title', 'Home')

@section('css')
    @include('layouts.head_2')

@stop

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="card card-chart mt-5">
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
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Debe de escribir un criterio de búsqueda
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row m-2">
                            @can('EQUIPOS#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6 my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-warning">
                                                        <i class="material-icons">devices</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">EQUIPOS</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <span><a href="{{ route('equipos.create') }}"
                                                            class="btn-sm  btn btn-sm m-1 btn-outline-success">Capturar
                                                            Equipo</a></span>
                                                    <span><a href="{{ route('prestamos.index') }}"
                                                            class="btn-sm  btn btn-sm m-1 btn-outline-danger">Consultar
                                                            Préstamos</a></span>
                                                    <span><a href="{{ route('nuevo-prestamo') }}"
                                                            class="btn-sm btn btn-sm m-1 btn-outline-info">Crear
                                                            Préstamo</a></span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="card-footer" style="font-size: 12px">
                                            <i class="material-icons text-dark" style="font-size: 12px">important_devices</i>
                                            Préstamos
                                            totales:
                                            {{ $prestamos }} <i class="material-icons text-dark"
                                                style="font-size: 12px">access_time</i> Fuera de
                                            tiempo: {{ $notificacion }}
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            <!-- Apartado de Tickets  -->
                            @can('TICKETS#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-danger">
                                                        <i class="material-icons">info_outline</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">TICKETS</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <span><a class="btn btn-outline-success btn-sm m-1"
                                                            href="{{ route('tickets.create') }}">Capturar
                                                            Tickets</a></span>
                                                    <span><a href="{{ route('tickets.index') }}"
                                                            class="btn btn-outline-danger btn-sm m-1">Consultar
                                                            Tickets</a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer" style="font-size: 12px">
                                            <i class="material-icons text-dark" style="font-size: 12px">local_offer</i> La
                                            Normal:
                                            {{ $ticketsNormal }}
                                            <i class="material-icons text-dark" style="font-size: 12px">local_offer</i> Belenes:
                                            {{ $ticketsBelenes }}
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            <!-- Apartado de LLaves   -->
                            @can('LLAVES#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-info">
                                                        <i class="material-icons">room_preferences</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">LLAVES</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <span><a href="{{ route('llaves.index') }}"
                                                            class="btn btn-outline-danger btn-sm m-1">Consultar
                                                            Llaves</a></span>
                                                    <span><a href="{{ route('agregarllaves') }}"
                                                            class="btn btn-outline-info btn-sm m-1">Elegir
                                                            Llaves</a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer" style="font-size: 12px">
                                            <i class="material-icons text-dark" style="font-size: 12px">local_offer</i> <a
                                                style="font-size: 12px" class="text-muted btn btn-sm p-0 m-0"
                                                href="{{ route('llaves.create') }}">Capturar
                                                Llave</a>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            <!-- Apartado de Inventario   -->
                            @can('INVENTARIOS#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-success">
                                                        <i class="material-icons">fact_check</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">INVENTARIO</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <span><a class="btn m-1 btn-outline-success btn-sm m-1"
                                                            href="{{ route('revision-inventario') }}">Revisión
                                                            Express</a></span>
                                                    <span><a class="btn m-1 btn-outline-danger btn-sm m-1"
                                                            href="{{ route('panel-inventario') }}">Panel de
                                                            Revisión</a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer" style="font-size: 12px">
                                            <i class="material-icons" style="font-size: 12px">inventory</i><a
                                                href="{{ route('inventario-cta') }}"> Inventario General</a>
                                            <i class="material-icons" style="font-size: 12px">location_searching</i><a
                                                href="{{ route('inventario-localizado') }}"> Inventario Localizado</a>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            <!-- Apartado de Aulas y áreas   -->
                            @can('AULAS_AREAS#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-secondary">
                                                        <i class="material-icons">fact_check</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">AULAS | &Aacute;REAS</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <span><a class="btn btn-outline-success btn-sm m-1"
                                                            href="{{ route('areas.index') }}">Listado
                                                            &Aacute;reas</a></span>
                                                    <span><a class="btn btn-outline-danger btn-sm m-1"
                                                            href="{{ route('area-ticket', 'Belenes') }}">Detalle
                                                            Aulas</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            <!-- Apartado de Cursos   -->
                            @can('CURSOS#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-info">
                                                        <i class="material-icons">school</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">CURSOS</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <span><a class="btn btn-outline-success btn-sm m-1"
                                                            href="{{ route('cursos-presenciales', '2023A') }}">Presenciales</a></span>
                                                    <span><a class="btn btn-outline-danger btn-sm m-1"
                                                            href="{{ route('cursos-laboratorios', '2023A') }}">Laboratorios</a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer" style="font-size: 12px">
                                            @can('CURSOS#crear')
                                                <i class="material-icons" style="font-size: 12px">spellcheck</i>
                                                <a href="{{ route('cursos.create') }}"> Capturar</a>
                                            @endcan
                                            <i class="material-icons" style="font-size: 12px">update</i><a
                                                href="{{ url('cursos/2022B') }}"> Todos</a>

                                            <i class="material-icons" style="font-size: 12px">update</i><a
                                                href="http://148.202.17.240/cursosCTA/public/"> Sistema de CURSOS</a>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            <!-- Apartado de Usuarios   -->
                            @can('USUARIOS#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-success">
                                                        <i class="material-icons">people</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info ">
                                                        <span class="widget-49-pro-title ">USUARIOS</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <span><a class="btn btn-outline-danger btn-sm m-1"
                                                            href="{{ route('usuarios.index') }}">Administrar
                                                            Usuarios</a></span>
                                                    <span><a class="btn btn-outline-success btn-sm m-1"
                                                            href="{{ route('roles.index') }}">Adm
                                                            Roles</a></span>
                                                    <span><a class="btn btn-outline-secondary  btn-sm m-1"
                                                            href="{{ route('permisos.index') }}">Adm
                                                            Permisos</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            <!-- Apartado de Mobiliario -->
                            @can('MOBILIARIO#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-danger">
                                                        <i class="material-icons">chair</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">MOBILIARIO</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    @can('MOBILIARIO#crear')
                                                        <span><a class="btn btn-outline-success  btn-sm m-1"
                                                                href="{{ route('mobiliarios.create') }}">Captura
                                                                Mobiliario</a></span>
                                                    @endcan
                                                    <span><a href="{{ route('mobiliarios.index') }}"
                                                            class="btn btn-outline-danger  btn-sm m-1">Consulta
                                                            Mobiliarios</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            <!-- Apartado de Proyectos -->
                            @can('PROYECTOS#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-warning">
                                                        <i class="material-icons">build</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">PROYECTOS</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <span><a class="btn btn-outline-success  btn-sm m-1"
                                                            href="{{ route('proyectos.create') }}">Capturar
                                                            Proyecto</a></span>
                                                    <span><a href="{{ route('proyectos.index') }}"
                                                            class="btn btn-outline-danger  btn-sm m-1">Consulta
                                                            Proyectos</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            <!-- Apartado de Licencias -->
                            @can('LICENCIAS#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-secondary">
                                                        <i class="material-icons">info_outline</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">LICENCIAS</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <span><a class="btn btn-outline-success  btn-sm m-1"
                                                            href="{{ route('licencias.create') }}">Capturar
                                                            licencia</a></span>
                                                    <span><a href="{{ route('licencias.index') }}"
                                                            class="btn btn-outline-danger  btn-sm m-1">Consultar
                                                            licencia</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            <!-- Apartado de Redes e IPs -->
                            @can('SUBREDES_IP#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-primary">
                                                        <i class="material-icons">info_outline</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">SUBREDES | IP'S</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <span><a class="btn btn-outline-success  btn-sm m-1"
                                                            href="{{ route('subredes.index') }}">Consultar
                                                            Subredes e IP'S</a></span>
                                                    <span><a class="btn btn-outline-danger  btn-sm m-1"
                                                            href="{{ route('subredes.create') }}">Capturar
                                                            Subred</a></span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            <!-- Apartado de Estadisticas -->
                            {{--
                            @can('ESTADISTICAS#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-success">
                                                        <i class="material-icons">dashboard</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">ESTADISTICAS</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <span><a class="btn btn-outline-success"
                                                            href="{{ route('estadisticas') }}">Consultar
                                                            Estadisticas</a></span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
--}}
                            <!-- Apartado de Logs -->
                            @can('LOGS#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-info">
                                                        <i class="material-icons">info_outline</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">LOGS</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">

                                                    <span><a class="btn btn-outline-danger  btn-sm m-1"
                                                            href="{{ route('logs.index') }}">Consultar
                                                            Logs</a></span>
                                                    @can('ESTADISTICAS#ver')
                                                        <span><a class="btn btn-outline-success  btn-sm m-1"
                                                                href="{{ route('estadisticas') }}">Consultar
                                                                Estadisticas</a></span>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            <!-- Apartado de Mantenimiento   -->
                            @can('MANTENIMIENTO#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-success">
                                                        <i class="material-icons">handyman</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">MANTENIMIENTO</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">

                                                    <span><a class="btn btn-outline-success  btn-sm m-1"
                                                            href="{{ route('mantenimiento.index') }}">Consultar
                                                            Mantenimientos</a></span>

                                                    <span><a class="btn btn-outline-danger  btn-sm m-1"
                                                            href="{{ route('mantenimiento.create') }}">Capturar
                                                            Mantenimientos</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            <!-- Apartado de Requisiciones -->
                            @can('REQUISICIONES#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-secondary">
                                                        <i class="material-icons">info_outline</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">REQUISICIONES</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">

                                                    <span><a class="btn btn-outline-success  btn-sm m-1"
                                                            href="{{ route('requisicion.create') }}">Capturar
                                                            Requisición</a></span>
                                                    <span><a href="{{ route('requisicion.index') }}"
                                                            class="btn btn-outline-danger  btn-sm m-1">Consultar
                                                            Requisición</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('cNormal_PERSONAL#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-danger">
                                                        <i class="material-icons">group</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">PERSONAL</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">

                                                    <span><a class="btn btn-outline-success  btn-sm m-1"
                                                            href="{{ route('personal.create') }}">Capturar
                                                            Personal</a></span>
                                                    <span><a href="{{ route('personal.index') }}"
                                                            class="btn btn-outline-danger  btn-sm m-1">Consultar
                                                            Personal</a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer" style="font-size: 12px">
                                            <i class="material-icons" style="font-size: 12px">info</i> <a
                                                href="{{ route('plazas.index') }}"> Ver
                                                plazas</a>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('TECNICOS#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-warning">
                                                        <i class="material-icons">group</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">TECNICOS</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <span><a class="btn btn-outline-danger  btn-sm m-1"
                                                            href="{{ route('tecnicos.index') }}">
                                                            Consultar Tecnicos
                                                        </a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('OFICIOS#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-primary">
                                                        <i class="material-icons">group</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">OFICIOS</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <span><a class="btn btn-outline-danger  btn-sm m-1"
                                                            href="{{ route('oficios.index') }}">
                                                            Consultar oficios
                                                        </a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('RESGUARDOS#ver')
                                <div class="col-lg-4 col-sm-12  col-md-6  my-3">
                                    <div class="card card-margin h-100">
                                        <div class="card-body pt-2">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper">
                                                    <div class="widget-49-date-secondary">
                                                        <i class="material-icons">info_outline</i>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="widget-49-pro-title">RESGAURDOS</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <span><a class="btn btn-outline-danger btn-sm m-1"
                                                            href="{{ route('entrega-resguardante.index') }}">
                                                            Consultar por resgaurdante
                                                        </a></span>
                                                    <span><a class="btn btn-outline-success btn-sm m-1"
                                                            href="{{ route('entrega-area.index') }}">
                                                            Consultar por área
                                                        </a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
