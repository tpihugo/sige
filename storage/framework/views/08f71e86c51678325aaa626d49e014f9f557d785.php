<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">SIGE CTA CUCSH</a>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="<?php echo e(__('Toggle navigation')); ?>"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('AULAS_AREAS#ver')): ?>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Áreas</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo e(route('areas.create')); ?>">Captura Área</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('areas.index')); ?>">Consulta Áreas</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('MOBILIARIO#ver')): ?>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Mobiliario</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('MOBILIARIO#crear')): ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('mobiliarios.create')); ?>">Captura Mobiliario</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="<?php echo e(route('mobiliarios.index')); ?>">Consulta Mobiliarios</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('EQUIPOS#ver')): ?>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Equipos y Préstamos</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo e(route('equipos.create')); ?>">Captura Equipo</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('nuevo-prestamo')); ?>">Crear Préstamo </a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('prestamos.index')); ?>">Consultar Préstamos</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('prestamos-all')); ?>">Historial Préstamos</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ESTADISTICAS#ver')): ?>
                    
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('TICKETS#ver')): ?>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Tickets</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo e(route('tickets.create')); ?>">Capturar Tickets</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('tickets.index')); ?>">Consultar Tickets Abiertos</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('revisionTickets')); ?>">Consultar Tickets Completos</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('CURSOS#ver')): ?>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Cursos</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('CURSOS#crear')): ?>
                            <li><a class="dropdown-item" href="<?php echo e(route('cursos.create')); ?>" >Capturar</a></li>
                        <?php endif; ?>
                            <li><a class="dropdown-item" href="<?php echo e(url('cursos/2022A')); ?>">Todos</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('cursos-laboratorios', '2022A')); ?>">Laboratorios</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('cursos-presenciales', '2022A')); ?>">Presenciales</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('USUARIOS#ver')): ?>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Usuarios</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo e(route('usuarios.index')); ?>">Administrar Usuarios</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('usuarios.index')); ?>">Roles y Permisos</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('LOGS#crear')): ?>
                    
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('PROYECTOS#ver')): ?>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Proyectos</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo e(route('proyectos.create')); ?>">Capturar Proyecto</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('proyectos.index')); ?>">Consultar Proyectos</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('LICENCIAS#ver')): ?>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Licencias</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo e(route('licencias.create')); ?>">Capturar licencia</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('licencias.index')); ?>">Consultar licencia</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('SERVICIOS#ver')): ?>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Servicios</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo e(route('servicios.create')); ?>">Capturar servicio</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('servicios.index')); ?>">Consultar servicios</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('SUBREDES_IP#ver')): ?>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Subredes e IP's</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo e(route('subredes.create')); ?>">Captura Subred</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('ips.create')); ?>">Captura IP</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('subredes.index')); ?>">Consulta Subred</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('ips.index')); ?>">Consulta IP</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('MENU_ADMINISTRADOR#ver')): ?>
                    <!-- ADMIN NAVBAR-MKII -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administrador</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('USUARIOS#ver')): ?>
                                <a class="dropdown-item" href="#"><strong>Usuarios</strong></a>
                                <a class="dropdown-item" href="<?php echo e(route('usuarios.index')); ?>">Administrar Usuarios</a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('LOGS#ver')): ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><strong>Logs</strong></a>
                                <a class="dropdown-item" href="<?php echo e(route('logs.index')); ?>">Consultar Logs</a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ESTADISTICAS#ver')): ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><strong>Estadisticas</strong></a>
                                <a class="dropdown-item" href="<?php echo e(route('estadisticas')); ?>">Generales</a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('TECNICOS#ver')): ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><strong>Técnicos</strong></a>
                                <a class="dropdown-item" href="<?php echo e(route('tecnicos.index')); ?>">Administrar Técnicos</a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('MANTENIMIENTO#ver')): ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><strong>Mantenimiento</strong></a>
                                <a class="dropdown-item" href="<?php echo e(route('mantenimiento.index')); ?>">Consultar Mantenimiento</a>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <?php if(auth()->guard()->guest()): ?>
                    <?php if(Route::currentRouteName() == 'register'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Acceder')); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if(Route::currentRouteName() == 'login'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Registrarse')); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <?php echo e(Auth::user()->name); ?>

                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                            >
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
<?php /**PATH /Applications/mamp/htdocs/sige/resources/views/layouts/navbar.blade.php ENDPATH**/ ?>