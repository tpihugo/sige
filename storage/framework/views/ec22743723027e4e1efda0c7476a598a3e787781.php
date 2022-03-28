<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?> </title>

    <!-- Icono -->
    <!-- <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(asset('material')); ?>/img/apple-icon.png"> -->
    <!-- <link rel="icon" type="image/png" href="<?php echo e(asset('material')); ?>/img/favicon.png"> -->
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!-- <link rel="shortcut icon" href="images/favicon.ico"> -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" ></script>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    

    <!-- CSS Files -->
    <link href="<?php echo e(asset('material')); ?>/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> 

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?php echo e(asset('material')); ?>/demo/demo.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo e(asset('js/loader.js')); ?>"></script>
    <script type="text/javascript">
        loader(true);
    </script>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/btnDT.css')); ?> "/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/loader.css')); ?> "/>
    </head>

    <body class="<?php echo e($class ?? ''); ?>">
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                        <?php echo e(config('app.name', 'Laravel')); ?>

                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <?php if(Auth::check() && Auth::user()->role =='admin'): ?>
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Áreas
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?php echo e(route('areas.create')); ?>">Captura Área</a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('areas.index')); ?>">Consulta Áreas</a></li>
                                </ul>

                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Mobiliario
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?php echo e(route('mobiliarios.create')); ?>">Captura Mobiliário</a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('mobiliarios.index')); ?>">Consulta Mobiliários</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Equipos y Préstamos
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?php echo e(route('equipos.create')); ?>">Captura Equipo</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    
                                    <li><a class="dropdown-item" href="<?php echo e(route('prestamos.index')); ?>">Consultar Préstamos</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Tickets
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?php echo e(route('tickets.create')); ?>">Capturar Tickets</a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('tickets.index')); ?>">Consultar Tickets Abiertos</a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('revisionTickets')); ?>">Consultar Tickets Completos</a></li>
                                </ul>

                            </li>
			  <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Cursos
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?php echo e(route('cursos.create')); ?>" >Capturar</a></li>
				<li><a class="dropdown-item" href="<?php echo e(url('cursos/2021B')); ?>">Todos</a></li>
				<li><a class="dropdown-item" href="<?php echo e(route('cursos-laboratorios', '2021B')); ?>">Laboratorios</a></li>
				<li><a class="dropdown-item" href="<?php echo e(route('cursos-presenciales', '2021B')); ?>">Presenciales</a></li>
                            </ul>

                        </li>

			    <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Admin
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?php echo e(route('usuarios.index')); ?>">Administrar Usuarios</a></li>
                               
                            </ul>

                        </li>

                        </ul>
                        <?php endif; ?>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            <?php if(auth()->guard()->guest()): ?>
                                <?php if(Route::has('login')): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Acceder')); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(Route::has('register')): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Registrarse')); ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php else: ?>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <?php echo e(Auth::user()->name); ?>

                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            <?php echo e(__('Salir')); ?>

                                        </a>

                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                            <?php echo csrf_field(); ?>
                                        </form>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>

        <!--   Core JS Files   -->
        <script src="<?php echo e(asset('material')); ?>/js/core/jquery.min.js"></script>
        <script src="<?php echo e(asset('material')); ?>/js/core/popper.min.js"></script>
        <script src="<?php echo e(asset('material')); ?>/js/core/bootstrap-material-design.min.js"></script>
        <script src="<?php echo e(asset('material')); ?>/js/plugins/perfect-scrollbar.jquery.min.js"></script>

        <!-- Plugin for the momentJs  -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/moment.min.js"></script>

        <!--  Plugin for Sweet Alert -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/sweetalert2.js"></script>

        <!-- Forms Validations Plugin -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/jquery.validate.min.js"></script>

        <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/jquery.bootstrap-wizard.js"></script>

        <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/bootstrap-selectpicker.js"></script>

        <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/bootstrap-datetimepicker.min.js"></script>

        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/jquery.dataTables.min.js"></script>

        <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/bootstrap-tagsinput.js"></script>

        <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/jasny-bootstrap.min.js"></script>

        <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/fullcalendar.min.js"></script>

        <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/jquery-jvectormap.js"></script>

        <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/nouislider.min.js"></script>

        <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

        <!-- Library for adding dinamically elements -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/arrive.min.js"></script>

        <!--  Google Maps Plugin    -->
        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE'"></script>

        <!-- Chartist JS -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/chartist.min.js"></script>

        <!--  Notifications Plugin    -->
        <script src="<?php echo e(asset('material')); ?>/js/plugins/bootstrap-notify.js"></script>

        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="<?php echo e(asset('material')); ?>/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>

        <!-- Material Dashboard DEMO methods, don't include it in your project! -->
        <script src="<?php echo e(asset('material')); ?>/demo/demo.js"></script>
        <script src="<?php echo e(asset('material')); ?>/js/settings.js"></script>
        <?php echo $__env->yieldPushContent('js'); ?>
    </body>
</html>
<?php /**PATH /Applications/mamp/htdocs/sige/resources/views/layouts/appdash.blade.php ENDPATH**/ ?>