@extends('layouts.plantillabase')
@section('css')
@endsection
@section('contenido')

<?php
$rutaImagen = '/imagenes_videos/';
$rutaVideo = '/videos/';
$tipo_material = '/tipo_material/';
$img = '/img/';
$cont=0;



?>

<br>
<div class="card text-center p-2 rounded-top">
  <div class="card-body bg-dark text-light rounded-top">
    <h1 class="card-title ">{{$titulo}}</h1>
  </div>
  <div class="card-footer text-muted bg-light d-flex p-2 bd-light ">
  <div class="container">
   <form class="d-flex justify-content-center">
    <div class=" align-items-center ">
  <div class="col-auto">
  <label for="search" class="h2">Buscar video <i class="fa fa-search" aria-hidden="true"></i></label>
  </div>
  <div class="col-auto">
  <input id="Buscador" class="bg-dark text-light form-control"  placeholder="Ingresa descripción..." aria-label="Search">
  </div>

</div>

    </form>

</div>
</div>





<div class="container pt-5" >

<ul id="Videos">
  <div class="row row-cols-md-3 row-cols-sm-1 g-4 shadow-lg p-6  rounded" >

  @foreach($categorias as $categoria)
  @if($categoria->inicio  == 1 && $categoria->activo  == 1)
<li >
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop{{$categoria->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">{{$categoria->titulo}}</h5>
        </div>
        <div class="modal-body">
          <video src="{{asset($categoria->file)}}" class="form-control" type="video" width="450" height="300"  id="myVideo{{$categoria->id}}" controls></video>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="pauseVid{{$categoria->id}}()">Cerrar video</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Fin Modal -->
  <div class="col">

    <div class="card  text-white bg-dark mb-3">

      <img src="{{asset($categoria->file_preview)}}" class="card-img-top" alt="..."  height='200'>
      <div class="card-body-vid">
        <h1 class="h3">{{$categoria->titulo}}</h1>
        <p class="card-text">{{$categoria->descripcion}}</p>
      </div>
      <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$categoria->id}}">
        <i class="fa fa-play-circle" aria-hidden="true"></i>&nbsp; Reproducir
      </button>
    </div>
  </div>
</li>
@endif
  @endforeach
</u>
</div>
</div>

@foreach($categorias as $categoria)
<script>


function pauseVid{{$categoria->id}}() {
 vid = document.getElementById("myVideo{{$categoria->id}}");
  vid.pause();
}
</script>

@endforeach

@endsection
