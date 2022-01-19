<?php
$logo = '/img/logo.png';
$logoUDG = '/img/udg.png';
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MEDIATECA</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">

    <link href="{{ asset('./css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('./css/estilos.css') }}" rel="stylesheet">
<link rel="icon" href="{{asset('img/favicon.ico')}}">


  </head>
  <body >

    <nav class="navbar navbar-outline-light bg-transparent">
      <div class="container-fluid">
      <a class="navbar-brand" href="http://www.cucsh.udg.mx/">
          <img src="{{asset($logo)}}" alt="" width="90" height="40" class="d-inline-block align-text-top">
          <!-- MEDIATECA -->
        </a>

        <div class="justify-content-right">
        <div class="btn-group" role="group" aria-label="Basic example">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#indexRegister" > {{ __('Index Register') }} </button>
  <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#indexLogin" > {{ __('Index Login') }} </button>

</div>

        </div>

      </div>
    </nav>
	<div class="row justify-content-center">
		<div class="col-auto">
			<img src="{{asset("img/imagen-inicio.jpg")}}" > 
		</div> 
	</div>


    <div class="d-flex container-fluid justify-content-center text-center">

        <div class="d-flex p-5 mt-3 justify-content-center text-center">
            <div class="d-flex p-4">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-12">
                            <label class="h1 text-light" >Bienvenido a MEDIATECA</label>
                        </div>
                        <div class="col-xs-12">
                            <p class="text-light h2">¡Comienza Ahora!<br/> Inicia sesión o crea una nueva cuenta.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <ul id="c">
                    <li><p><strong><img width="180px" class="img-fluid" src="./imagenes_videos/04-07-2021_cucsh.jpg"></strong></p><p class="text-light">Ejemplo 1</p></li>
                    <li><p><strong><img width="180px" class="img-fluid" src="./imagenes_videos/27-06-2021_3.png"></strong></p><p class="text-light">Ejemplo 2</p></li>
                    <li><p><strong><img width="180px" class="img-fluid" src="./imagenes_videos/27-06-2021_5.png"></strong></p><p class="text-light">Ejemplo 3</p></li>
                    <li><p><strong><img width="180px" class="img-fluid" src="./imagenes_videos/27-06-2021_6.png"></strong></p><p class="text-light">Ejemplo 4</p></li>
                    <li><p><strong><img width="180px" class="img-fluid" src="./imagenes_videos/27-06-2021_7.png"></strong></p><p class="text-light">Ejemplo 5</p></li>
                    <li><p><strong><img width="180px" class="img-fluid" src="./imagenes_videos/27-06-2021_backdrop.jpg"></strong></p><p class="text-light">Ejemplo 6</p></li>
                    <li><p><strong><img width="180px" class="img-fluid" src="./imagenes_videos/27-06-2021_luna-llena-luna-de-gusano1.jpg"></strong></p><p class="text-light">Ejemplo 7</p></li>
                </ul>
            </div>
        </div>
    </div> -->




  <!-- Modal Registro -->
  <div class="modal fade" id="indexRegister" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="indexRegisterLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="{{ route('register') }}">
            <div class="modal-header">
            <h5 class="modal-title" id="indexRegisterLabel">{{ __('Tittle Register') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf

                <div class="row align-items-center">
                    <div class="input-group form-group col-md-7 offset-md-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input id="name" placeholder="{{ __('Name') }}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="row align-items-center">

                        <input id="rol" placeholder="{{ __('rol') }}" type="hidden" class="form-control @error('rol') is-invalid @enderror" name="rol" value="Estudiante" required autocomplete="rol">

                        @error('rol')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="row align-items-center">
                    <div class="input-group form-group col-md-7 offset-md-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input placeholder="{{ __('E-Mail Address') }}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="row align-items-center">
                    <div class="input-group form-group col-md-7 offset-md-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input placeholder="{{ __('Password') }}" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="row align-items-center">
                    <div class="input-group form-group col-md-7 offset-md-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input placeholder="{{ __('Confirm Password') }}" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
		<button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('BTN Close') }}</button>
            
            </div>
        </div>
    </form>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="indexLogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="indexLoginLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="{{ route('login') }}">
            <div class="modal-header">
            <h5 class="modal-title" id="indexLoginLabel">{{ __('Tittle Login') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf

                <div class="row align-items-center">
                    <div class="input-group form-group col-md-7 offset-md-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>


                <div class="row align-items-center">
                    <div class="input-group form-group col-md-7 offset-md-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group row">
                    <div class="col-md-12 offset-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                            @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
<button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('BTN Close') }}</button>
            
            </div>
        </form>
      </div>
    </div>
  </div>

    <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="http://code.jquery.com/jquery.js"></script>

    <!-- Todos los plugins JavaScript de Bootstrap (también puedes
         incluir archivos JavaScript individuales de los únicos
         plugins que utilices) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="./js/index.js"></script>

  </body>
  <script src="http://code.jquery.com/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</html>
