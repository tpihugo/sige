@extends('adminlte::page')
@section('title', 'Requisiciones')

@section('css')
    @include('layouts.head_2')
@stop
@section('content')
    @if (Auth::check() &&
            (Auth::user()->role == 'admin' ||
                Auth::user()->role == 'cta' ||
                Auth::user()->role == 'auxiliar' ||
                Auth::user()->role == 'redes'))


        <div class="container-fluid ">
            <div class="row g-3 align-items-center">
                <div class="col-md-12">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <h2 class="w-100 text-center">Requisiciones</h2>
                    <p align="right">
                        <a href="{{ route('requisiciones.create') }}" class="btn btn-success">Capturar requisición</a>
                        <a href="{{ route('home') }}" class="btn btn-primary">Regresar</a>
                    </p>
                </div>
            </div>

            <br>

            <div class="row g-3 align-items-center">
                <div class="col-sm-12 mb-3">
                    <table id="example" class="table table-striped table-bordered " style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Solicitud</th>
                                <th>Fecha</th>
                                <th>Usuario</th>
                                <th>Proyecto</th>
                                <th>Fondo</th>
                                <th>Fecha recibido</th>
                                <th>Nombre quien recibe</th>
                                <th>Evidencia</th>
                                <th>Acciones</th>
                                <th>Artículos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requisiciones as $requisicion)
                                <tr>
                                    <td>{{ $requisicion->id }}</td>
                                    <td>{{ $requisicion->num_sol }}</td>
                                    <td>{{ \Carbon\Carbon::parse($requisicion->fecha)->format('d/m/Y') }}</td>
                                    <td>{{ $requisicion->user }}</td>
                                    <td>{{ $requisicion->proyecto }}</td>
                                    <td>{{ $requisicion->fondo }}</td>
                                    <td>{{ \Carbon\Carbon::parse($requisicion->fecha_recibido)->format('d/m/Y') }}</td>
                                    <td>{{ $requisicion->quien_recibe }}</td>
                                    <td><a href="{{ asset('almacen/requis/' . $requisicion->documento) }}"
                                            target="blank_">VER</a></td>
                                    <td>
                                        <div class="btn-circle">
                                            <form action="{{ route('requisiciones.destroy', $requisicion->id) }}"
                                                method="POST">
                                                <a class="btn btn-info btn-sm" title="Editar"
                                                    href="{{ route('requisiciones.edit', $requisicion->id) }}"><i
                                                        class="far fa-edit"></i></a>

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Borrar" class="btn btn-danger btn-sm"> <i
                                                        class="far fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-circle">
                                            <a class="btn btn-success btn-sm" title="Agregar artículos"
                                                href="{{ route('requisicion-articulos-create', $requisicion->id) }}"><i
                                                    class="far fa-edit"></i></a>
                                            <a class="btn btn-primary btn-sm" title="Ver"
                                                href="{{ route('requisicion-articulos', $requisicion->id) }}"><i
                                                    class="fas fa-check"></i></a>
                                            <a class="btn btn-warning btn-sm" title="Imprimir formato"
                                                href=" {{ route('imprimirrequisicion', $requisicion->id) }}"
                                                target="blank"><i class="far fa-file-alt"></i></a>

                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    @else
        Acceso No válido
    @endif
@endsection
@section('js')
    @include('layouts.scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
@section('footer')
    <h5 class="text-end">En caso de inconsistencias, favor de reportarlas.</h5>
@endsection
