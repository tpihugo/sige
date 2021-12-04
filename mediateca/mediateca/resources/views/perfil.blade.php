
@extends('layouts.plantillabase')
@section('css')
@endsection
@section('contenido')
<?php 
$rutaImagen = '/imagenes_videos/'; 
$rutaVideo = '/videos/'; 

$cont=0;
?>


<div id="Carousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
      <div class="container">
        <div class="carousel-caption text-start">
          <h1>Bienvenido a MEDIATECA CUCSH.</h1>
          <p>Preservar la historia de nuestra universidad como nunca antes visto.</p>
        </div>
      </div>
    </div>
      @foreach($materials as $material)
    <div class="carousel-item">
      <img src="{{asset($rutaImagen.$material->file_preview)}}" class="d-block w-100" alt="...">
      <div class="container">
        <div class="carousel-caption text-start">
          <h1>{{$material->titulo}}</h1>
          <p>{{$material->descripcion}}</p>
          <p><a class="btn btn-lg btn-dark" href="#">Ver Video</a></p>
        </div>
      </div>
    </div>    
    @endforeach
  </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#Carousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#Carousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
  </div>





<div class="container">
  <h1>Conoce la historia.</h1>
  </div>
  <div class="container">
<div class="row row-cols-md-4 g-4 shadow-lg p-5 mb-5  rounded" >
  
  @foreach($materials as $material)

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop{{$material->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">{{$material->titulo}}</h5>
        </div>
        <div class="modal-body">
          <video src="{{asset($rutaVideo.$material->file)}}" class="form-control" type="video/mp4" width="450" height="300"  controls></video>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar video</button>      
        </div>
      </div>
    </div>
  </div>

  
  <!-- Fin Modal -->
  <div class="col">
    <div class="card  text-white bg-dark mb-3">
      <img src="{{asset($rutaImagen.$material->file_preview)}}" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{$material->titulo}}</h5>
        <p class="card-text">{{$material->descripcion}}</p>
      </div>
      <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$material->id}}">
        <i class="fa fa-play-circle" aria-hidden="true"></i>&nbsp; Reproducir
      </button>
    </div>
  </div>
  @endforeach
</div>


</div>




@endsection


