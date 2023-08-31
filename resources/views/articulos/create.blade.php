@extends('adminlte::page')
@section('title', 'Articulos requisición')

@section('css')
    @include('layouts.head_2')
@stop


@section('content')
    <div class="container">
        @if (Auth::check() &&
                (Auth::user()->role == 'admin' ||
                    Auth::user()->role == 'cta' ||
                    Auth::user()->role == 'auxiliar' ||
                    Auth::user()->role == 'redes'))
            <div class="row ">
                <div class="col-md-12 my-5 border-bottom border-dark pb-3">
                    <h2> Requisición {{ $requisicion }} | Añadir nuevo artículo</h2>
                </div>
            </div>
            <form action="{{ route('articulos.store') }}" method="POST">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <label for="" class="form-label">Código</label>
                        <input type="number" name="codigo" id="codigo" class="form-control" tabindex="1" required>
                    </div>

                    <div class="col-md-4">
                        <label for="" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" tabindex="2" required>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Status</label>
                        <select class="form-control" name="status" id="status" tabindex="5">
                            <option value="solicitado">SOLICITADO</option>
                            <option value="comprado">COMPRADO NO RECIBIDO EN ALMACEN</option>
                            <option value="almacen">EN ALMACÉN</option>
                            <option value="entregado">ENTREGADO A CTA</option>
                            <option value="instalado">INSTALADO</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row g-3 align-items-center">
                    <div class="col-md-12">
                        <label for="" class="form-label">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" tabindex="3"
                            required>
                    </div>
                </div><br>
                <div class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <label for="" class="form-label">Observación</label>
                        <input type="text" name="observacion" id="observacion" class="form-control" tabindex="4"
                            required>
                    </div>
                    <div class="col-md-4 d-none">
                        <label for="" class="form-label">Id Requisición</label>
                        <input class="form-control" type="text" readonly value="{{ $requisicion }}"
                            name="requisicion_id" placeholder="{{ $requisicion }}">
                    </div>
                </div>
                <br>
                <a href="/articulos" class="btn btn-secondary" tabindex="8">Cancelar</a>
                <button type="submit" class="btn btn-primary" tabindex="9">Guardar </button>
            </form>

    </div>
    @endif
@endsection
@section('footer')
    <h5 class="text-end">En caso de inconsistencias, favor de reportarlas</h5>
@endsection
