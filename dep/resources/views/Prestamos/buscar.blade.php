@extends('layout.plantilla')
@section('titulo', 'Prestamos')

<?php 
	$arreglo = explode(',',$total);
	$total = $arreglo[0];
	$pagina = $arreglo[1];
?>
@section('content')
    <div class="row justify-content-end">
        <div class="col-auto m-1">
            <h5>Total de elementos encontrados: <b>{{ $total }}</b></h5>
        </div>
    </div>
    <div class="row">
        @foreach ($prestamos as $item)
            <div class="card w-100 m-1">
                <div class="card-body">
                    <h3 class="card-title"><b>Clasificación </b> {{ $item->clasificacion }}
                        @if ($item->status == 'Abierto')
                            <a class="col-sm-12  col-auto btn btn-sm btn-outline-danger "
                                href="{{ route('prestamos.cerrar', [$item->clasificacion, $item->tipo, $item->fecha_prestamo, $item->prestado_A]) }}">Cerrar
                                Prestamo</a>
                        @endif
                    </h3>
                    <p class="text-card">
                        <b>Tipo </b> {{ $item->tipo }}
                        <b>Prestado A</b> {{ $item->prestado_A }}
			<b>Correo </b> {{($item->correo=='')?'No registrado':$item->correo}}
                    </p>
			<p class="text-card">
                        <b>Fecha Prestamo</b> {{ $item->fecha_prestamo }}
                        <b>Fecha Entrega</b> {{ $item->fecha_entrega == null ? 'No entregado' : $item->fecha_entrega }}
                        <b>Status</b> {{ $item->status }}
</p>
                </div>
            </div>
        @endforeach
    </div>
        <div class="row justify-content-center">
            <div class="col-auto ">
                {{$prestamos->links()}}
            </div>

        </div>        
@if ($prestamos->all() == null)
        <div class="row justify-content-end">
            <hr class="border border-dark border-2 w-100"/>
            <h2>No hay coincidencias</h2>
        </div>        @endif

@endsection
