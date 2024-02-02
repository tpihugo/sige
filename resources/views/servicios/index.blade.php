<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Listado de Servicios CTA | CUCSH</title>
    <!-- <link rel="shortcut icon" href="images/favicon.ico"> -->
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- CSS Files -->
    <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</head>

<body>
    <div class="container-fluid">
        <div class="row text-white py-3 text-uppercase" style="background: #072d45;">
            <div class="col-sm-12">
                <h2 class="text-center">Cátalogo de servicios</h2>
            </div>
        </div>
    </div>
    <div class="container mt-2">
        <div class="row align-items-center">

            @foreach ($servicios as $servicio)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card shadow h-100">
                        <div class="card-body text-center h-100">
                            <h5 class="border-bottom py-2 my-2">{{ $servicio->nombre }}</h5>
                            <p>
                                <a onclick="changeInfo({{ $servicio }})" data-bs-toggle="modal"
                                    data-bs-target="#servicios" class="btn btn-sm btn-primary text-white">Ver más</a>
                            </p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="modal fade" id="servicios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="title"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-justify">
                    <p>
                        <b class="py-2 my-2">Descripción </b> <br>
                        <hr> <span id="description"></span>
                    </p>
                    <p>
                        <b class="py-2 my-2">Requerimientos </b> <br>
                        <hr> <span id="requirements"></span>
                    </p>

                    <p>
                        <b class="py-2 my-2">Contacto </b> <br>
                        <hr> <span id="contact"></span>
                    </p>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/servicios.js') }}"></script>
</body>

</html>
