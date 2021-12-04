
@extends('layouts.plantillabase')
@section('titulo','Inicio')
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


<div id="Carousel" class="carousel slide carousel-fade" data-ride="carousel">
  <div class="carousel-inner carousel-zoom shadow-lg">
    <div class="carousel-item active">
      <img src=" https://pbs.twimg.com/profile_images/378800000600827420/af856239aa8bd9ef6c49338b456e3e6c.jpeg" class="d-block w-10" alt="...">
      <div class="container">
        <div class="carousel-caption text-start">
          <h1>Bienvenido a MEDIATECA CUCSH.</h1>
          <p>Preservar la historia de nuestra universidad como nunca antes visto.</p>
        </div>
      </div>
    </div>
      @foreach($materials as $material)
      @if($material->carousel  == 1 && $material->activo ==1)


    <div class="carousel-item">

      <img src="{{asset($material->file_preview)}}" class="d-block w-100" alt="...">

      <div class="container ">

        <div class="carousel-caption text-start">
          <h1>{{$material->titulo}}</h1>
          <p>{{$material->descripcion}}</p>
          <p class="float-index"><a class="text-light  undecorate" href="#" data-bs-toggle="modal" data-bs-target="#modal{{$material->id}}"><i class="fa fa-play-circle fa-2x">&nbsp;Ver video</i> </a></p>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal{{$material->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">{{$material->titulo}}</h5>
        </div>
        <div class="modal-body">
          <video width="450" height="300" id="myVideo" controls>
          <source src="{{asset($material->file)}}" type="video/mp4">
        </video>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="pauseVid()">Cerrar video</button>
        </div>
      </div>
    </div>
  </div>
    @endif
    @endforeach
  </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#Carousel" data-bs-slide="prev">
    <i class="fa fa-arrow-circle-left fa-3x" aria-hidden="true"></i>

    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#Carousel" data-bs-slide="next">
  <i class="fa fa-arrow-circle-right fa-3x" aria-hidden="true"></i>

    <span class="visually-hidden">Siguiente</span>
  </button>
</div>

@csrf


<div class=" row row-cols-1 row-cols-md-5 row-cols-sm-2 g-3 p-3 mb-1 ">

  <div class="col">
  <a href="./conferencias" >
    <div class="card text-center  bg-dark rounded">
      <div class="card-body bg-dark text-light border-light form-control rounded justify-content-center aling-items-center">
      <img src="{{asset($tipo_material.'conferencia1.png')}}" class="img-responsive card-img-top" alt="..." style="max-width: 95px;">
        <h5 class="card-title">Conferencias</h5>
      </div>
    </div>
</a>
  </div>

  <div class="col">
  <a href="./clases_Magistrales" >
  <div class="card text-center  bg-dark rounded">
      <div class="card-body bg-dark text-light border-light form-control rounded justify-content-center aling-items-center">
      <img src="{{asset($tipo_material.'clase_ma1.png')}}" class=" img-responsive card-img-top" alt="..." style="max-width: 95px;">
        <h5 class="card-title">Clases magistrales</h5>
      </div>
    </div>
</a>
  </div>
  <div class="col">
    <a href="./video_Conferencias" >
    <div class="card text-center  bg-dark rounded">
      <div class="card-body bg-dark text-light border-light form-control rounded justify-content-center aling-items-center">
   <img src="{{asset($tipo_material.'video_conferencia1.png')}}" class=" img-responsive card-img-top" alt="..." style="max-width: 95px;">
        <h5 class="card-title">Video conferencias</h5>
      </div>
    </div>
    </a>
  </div>

  <div class="col">
  <a href="./foros" >
  <div class="card text-center  bg-dark rounded">
      <div class="card-body bg-dark text-light border-light form-control rounded justify-content-center aling-items-center">
    <img src="{{asset($tipo_material.'foro1.png')}}" class=" img-responsive card-img-top" alt="..." style="max-width: 95px;">
        <h5 class="card-title">Foros</h5>
      </div>
    </div>
</a>
  </div>
  <div class="col">
  <a href="./transmisiones_En_Vivo" >
    <div class="card text-center  bg-dark rounded">
      <div class="card-body bg-dark text-light border-light form-control rounded justify-content-center aling-items-center">
    <img src="{{asset($tipo_material.'en_vivo1.png')}}" class=" img-responsive card-img-top" alt="..." style="max-width: 95px;">
        <h5 class="card-title">Transmisiones en vivo</h5>
      </div>
    </div>
</a>
  </div>



</div>

<div class="card text-center p-2 rounded-top">
  <div class="card-body bg-dark text-light rounded-top">
    <h1 class="card-title ">Conoce la historia</h1>
  </div>
  <div class="card-footer text-muted bg-secondary d-flex p-2 bd-highlight">
  <a class="btn btn-dark" href="./todos_los_videos" role="button">Ver todos los videos</a>
</div>


<div class="container pt-5" >

  <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 g-4 shadow-lg p-5 mb-5  rounded" >

  @foreach($materials as $material)
@if($material->inicio  == 1 && $material->activo  == 1)
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop{{$material->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">{{$material->titulo}}</h5>
        </div>
        <div class="modal-body">
          <video width="450" height="300" id="myVideo{{$material->id}}" controls>
          <source src="{{asset($material->file)}}" type="video/mp4">
        </video>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="pauseVid{{$material->id}}()">Cerrar video</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Fin Modal -->

  <div class="col ">

    <div class="card  text-white bg-dark mb-3">
    <a data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$material->id}}">
      <img src="{{asset($material->file_preview)}}" class="card-img-top" alt="..." height='200'>
      </a>
      <div class="card-body">

        <h1 class="h3">{{$material->titulo}}</h1>

        <p class="card-text">{{$material->descripcion}}</p>
      </div>
      <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$material->id}}">
        <i class="fa fa-play-circle" aria-hidden="true"></i>&nbsp; Reproducir
      </button>
    </div>
  </div>
  @endif
  @endforeach
</div>




</div>
@foreach($materials as $material)
@if($material->activo  == 1)
<script>


function pauseVid{{$material->id}}() {
 vid = document.getElementById("myVideo{{$material->id}}");
  vid.pause();
}
</script>
@endif
@endforeach

@endsection


