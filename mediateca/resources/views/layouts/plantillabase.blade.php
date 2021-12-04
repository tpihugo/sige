
<?php $rol = Auth::user()->rol ;


$usuario = Auth::user()->name ;
$logo = '/img/logo.png';
$logoUDG = '/img/udg.png';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('css')
    <!-- Bootstrap and CSS -->

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="datatable\datatables.min.css">
    <link rel="stylesheet" href="datatable\DataTables-1.10.25\css\dataTables.bootstrap5.min.css">
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{!! asset('css/style.css') !!}" >


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>


    @if( $rol == "Administrador")
    <title>MEDIATECA (Administrador)</title>

    @else
    <title>MEDIATECA</title>

    @endif
  </head>
<body>
  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="./home">
          <img src="{{asset($logo)}}" alt="" width="80" height="30" class="d-inline-block align-text-top">
          <!-- MEDIATECA -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            @if( $rol == "Administrador")
            <li class="nav-item"><a class="nav-link" href="{{route('material.index')}}">Administración</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('profile.index')}}">Usuarios</a></li>
            @endif
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorias</a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                <li><a class="dropdown-item" href="./conferencias"><i class="fa fa-play-circle" aria-hidden="true"></i>&nbsp;Conferencias</a></li>
                <li><a class="dropdown-item" href="./clases_Magistrales"><i class="fa fa-play-circle" aria-hidden="true"></i>&nbsp;Clases magistrales</a></li>
                <li><a class="dropdown-item" href="./video_Conferencias"><i class="fa fa-play-circle" aria-hidden="true"></i>&nbsp;Video conferencias</a></li>
                <li><a class="dropdown-item" href="./foros"><i class="fa fa-play-circle" aria-hidden="true"></i>&nbsp;Foros</a></li>
                <li><a class="dropdown-item" href="./transmisiones_En_Vivo"><i class="fa fa-play-circle" aria-hidden="true"></i>&nbsp;Transmisiones en vivo</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="./todos_los_videos">Todos los videos</a></li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="#"></a></li>
          </ul>

        <ul class="navbar-nav nav-r">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ $usuario }}
            </a>
        <ul class="dropdown-menu dropdown-menu-dark " aria-labelledby="navbarDarkDropdownMenuLink">
          <li><a class="dropdown-item" href="./myprofile">Mi cuenta</a></li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Cerrar sesión') }}
              </a>
            </form>
          </li>
        </ul>
      </div>
    </nav>
  </header>
<main>
        @yield('contenido')

<!-- Contenido de los blade -->


    <!-- /Línea -->
    <hr class="featurette-divider">
     <!-- FOOTER -->

</main>

<footer class="container">
    <p class="float-end "><a class="undecorate text-light" href="{{route('home')}}"><i class="bg-dark rounded-circle fa fa-home shadow-lg p-4 fa-2x"></i> </a></p>
    <img src="{{asset($logoUDG)}}" alt="" width="250" height="75" class="">
    <div class="row">
        <div class="col-md-9">
            CENTRO UNIVERSITARIO DE CIENCIAS SOCIALES Y HUMANIDADES<br>
            Sede la Normal. Guanajuato #1045, Col. Alcalde Barranquitas, C.P. 44260. Guadalajara, Jalisco, México. Sede Los Belenes. Av. José Parres Arias #150, San Jose del Bajio, C.P. 45132. Zapopan, Jalisco, México.
        </div>
    </div>

  </footer>
  </body>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/004224eb8d.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js" type="text/javascript"></script>

<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>


$(document).ready(function(){
  $("#Buscador").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#Videos li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
// Fin de buscador
</script>

  @yield('js')
</html>
