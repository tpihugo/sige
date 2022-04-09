@extends('layouts.app')
@section('content')


    <div class="container">
        @if(Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>

                </div>
            @endif
            <div class="row">
                <h2>Edición de Llaves {{$llaves->id}}</h2>
                <hr>
                <script type="text/javascript">

                    $(document).ready(function() {
                        $('#js-example-basic-single').select2();

                    });
                    var dateControl = document.querySelector('input[type="date"]');
                    dateControl.value = '2017-06-01';
                </script>

            </div>
            <form action="{{route('llaves.update', $llaves->id)}}" method="post" enctype="multipart/form-data" class="col-12">
		@method('PUT')
                <div class="row">
                    <div class="col">
                        {!! csrf_field() !!}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <br>
                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-4">
                                        <label for="area">Área de la Llave</label>
                                        <textarea class="form-control" id="area" name="area">{{$llaves->area}}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="comentarios">Comentario</label>
                                    <textarea class="form-control" id="comentarios" name="comentarios">{{$llaves->comentarios}}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="num_copias">Número de Llaves:</label>
                                    <input type="number" id="num_copias" name="num_copias"
                                    min="1" max="5">{{$llaves->num_copias}}
                                </div>
                            </div>
                        </div>

                        <br>
			<div class="row g-5 align-items-center">
                        	<div class="col-md-12">
                            		<a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
                            		<button type="submit" class="btn btn-success">Guardar datos</button>
                        	</div>
                    	</div>
                    </div>
                    <br>

                </div>
            </form>
            <br>
            <div class="row g-5 align-items-center">

                <br>
                <h5>En caso de inconsistencias, favor de reportarlas.</h5>
                <hr>

            </div>
    </div>
@else
    Acceso No válido
@endif
@endsection
