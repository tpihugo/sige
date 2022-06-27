<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="row align-items-center">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('BUSQUEDAR#buscar')): ?>
                    <div class="col-md-12">
                        <div class="card card-chart">
                            <div class="card-header card-header-success">B&uacute;squeda General.</div>
                            <div class="card-body">
                                <?php if(session('status')): ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo e(session('status')); ?>

                                    </div>
                                <?php endif; ?>

                                <?php if(session('message')): ?>
                                    <div class="alert alert-success">
                                        <?php echo e(session('message')); ?>

                                    </div>
                                <?php endif; ?>

                                <form action="<?php echo e(route('busqueda')); ?>" method="POST" enctype="multipart/form-data" class="col-12">
                                    <?php echo csrf_field(); ?>


                                    <?php if($errors->any()): ?>
                                        <div class="alert alert-danger">
                                            <ul>Debe de escribir un criterio de búsqueda</ul>
                                        </div>
                                    <?php endif; ?>

                                    <br>
                                    <div class="row align-items-center">
                                        <div class="col-md-3 offset-md-1 text-end">
                                            <h3 class="card-title"><span class="text-success"><i class="fa fa-search"></span></i> Búsqueda</h3>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" id="busqueda" name="busqueda" />
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-success">Buscar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-md-12 ">
                    <div class="card card-chart">
                        <div class="card-header card-header-success">Sistema Integral de Gesti&oacute;n</div>
                        <div class="row m-1">

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('EQUIPOS#ver')): ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card card-stats ">
                                        <div class="card-header card-header-warning card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">devices</i>
                                            </div>
                                            <h3 class="card-title">Equipos <br></h3>
                                            <a href="<?php echo e(route('equipos.create')); ?>" class="btn btn-outline-success">Capturar Equipo</a>
                                            <a href="<?php echo e(route('prestamos.index')); ?>" class="btn btn-outline-danger">Consultar Préstamos</a>
                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="material-icons text-dark">important_devices</i>
                                                <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                                                <a href="<?php echo e(route('nuevo-prestamo')); ?>">Crear Préstamo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Apartado de Tickets  -->
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('TICKETS#ver')): ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card card-stats">
                                        <div class="card-header card-header-danger card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">info_outline</i>
                                            </div>
                                            <h3 class="card-title">Tickets</h3>
                                            <a class="btn btn-outline-success" href="<?php echo e(route('tickets.create')); ?>">Capturar Tickets</a>
                                            <a href="<?php echo e(route('tickets.index')); ?>" class="btn btn-outline-danger">Consultar Tickets</a>
                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="material-icons">local_offer</i> La Normal: <?php echo e($ticketsNormal); ?>

                                                <i class="material-icons">local_offer</i> Belenes: <?php echo e($ticketsBelenes); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Apartado de LLaves   -->
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('LLAVES#ver')): ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card card-stats">
                                        <div class="card-header card-header-info card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">room_preferences</i>
                                            </div>
                                            <h3 class="card-title">Llaves</h3>
                                            <a class="btn btn-outline-success" href="<?php echo e(route('llaves.create')); ?>">Capturar Llave</a>
                                            <a href="<?php echo e(route('llaves.index')); ?>" class="btn btn-outline-danger">Consultar Llaves</a>
                                            <a href="<?php echo e(route('agregarllaves')); ?>" class="btn btn-outline-info">Elegir Llaves</a>
                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="material-icons">door_back</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Apartado de Inventario   -->
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('INVENTARIOS#ver')): ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card card-stats">
                                        <div class="card-header card-header-success card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">fact_check</i>
                                            </div>
                                            <h3 class="card-title">Inventario</h3>
                                            <a class="btn btn-outline-success" href="<?php echo e(route('revision-inventario')); ?>" >Revisión Express</a>
                                            <a class="btn btn-outline-danger" href="<?php echo e(route('panel-inventario')); ?>" >Panel de Revisión</a>
                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="material-icons">inventory</i><a href="<?php echo e(route('inventario-cta')); ?>" >Inventario General</a>
                                                <i class="material-icons">location_searching</i><a href="<?php echo e(route('inventario-localizado')); ?>" >Inventario Localizado</a>
                                                <!-- <i class="material-icons">inventory</i><a href="<?php echo e(route('inventario-express-detalle2')); ?>" >Nuevo Inventario express2</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Apartado de Aulas y áreas   -->
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('AULAS_AREAS#ver')): ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card card-stats">
                                        <div class="card-header card-header-secondary card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">fact_check</i>
                                            </div>
                                            <h3 class="card-title">Aulas y &Aacute;reas</h3>
                                            <a class="btn btn-outline-success" href="<?php echo e(route('areas.index')); ?>" >Listado &Aacute;reas</a>
                                            <a class="btn btn-outline-danger" href="<?php echo e(route('area-ticket','Belenes')); ?>" >Detalle Aulas</a>
                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="material-icons">inventory</i><a href="<?php echo e(route('inventario-cta')); ?>" >Inventario General</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Apartado de Cursos   -->
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('CURSOS#ver')): ?>
                                <div class="col-lg-4 col-md-6 col-sm-12 ">
                                    <div class="card card-stats ">
                                        <div class="card-header card-header-info card-header-icon">
                                            <div class="card-icon">
                                            <i class="material-icons">school</i>
                                            </div>
                                            <h3 class="card-title">Cursos</h3>
                                            <a class="btn btn-outline-success" href="<?php echo e(route('cursos-presenciales', '2022A')); ?>">Presenciales</a>
                                            <a class="btn btn-outline-danger" href="<?php echo e(route('cursos-laboratorios', '2022A')); ?>">Laboratorios</a>
                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('CURSOS#crear')): ?>
                                                    <i class="material-icons">spellcheck</i>
                                                      <a href="<?php echo e(route('cursos.create')); ?>" >Capturar</a>
                                                <?php endif; ?>
                                                <i class="material-icons">update</i><a  href="<?php echo e(url('cursos/2022A')); ?>">Todos</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Apartado de Usuarios   -->
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('USUARIOS#crear')): ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card card-stats">
                                        <div class="card-header card-header-success card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">people</i>
                                            </div>
                                            <h3 class="card-title">Usuarios</h3>
                                            <a class="btn btn-outline-danger" href="<?php echo e(route('usuarios.index')); ?>">Administrar Usuarios</a>
                                            <a class="btn btn-outline-success" href="<?php echo e(route('roles.index')); ?>">Adm Roles</a>
                                            <a class="btn btn-outline-success" href="<?php echo e(route('permisos.index')); ?>">Adm Permisos</a>
                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <div class="stats">
                                                    <i class="material-icons">info</i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Apartado de Mobiliario -->
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('MOBILIARIO#ver')): ?>
                                <div class="col-lg-4 col-md-6 col-sm-12 ">
                                    <div class="card card-stats ">
                                        <div class="card-header card-header-danger card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">chair</i>
                                            </div>
                                            <h3 class="card-title">Mobiliario</h3>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('MOBILIARIO#crear')): ?>
                                                <a class="btn btn-outline-success" href="<?php echo e(route('mobiliarios.create')); ?>">Captura Mobiliario</a>
                                            <?php endif; ?>
                                            <a href="<?php echo e(route('mobiliarios.index')); ?>" class="btn btn-outline-danger">Consulta Mobiliarios</a>
                                        </div>
                                            <div class="card-footer ">
                                            <div class="stats">
                                                <i class="material-icons">info</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Apartado de Proyectos -->
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('PROYECTOS#ver')): ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card card-stats">
                                        <div class="card-header card-header-warning card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">build</i>
                                            </div>
                                            <h3 class="card-title">Proyectos</h3>
                                            <a class="btn btn-outline-success" href="<?php echo e(route('proyectos.create')); ?>">Capturar Proyecto</a>
                                            <a href="<?php echo e(route('proyectos.index')); ?>" class="btn btn-outline-danger">Consulta Proyectos</a>
                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="material-icons">info</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Apartado de Licencias -->
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('LICENCIAS#ver')): ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card card-stats">
                                        <div class="card-header card-header-secundary card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">info_outline</i>
                                            </div>
                                            <h3 class="card-title">Licencias</h3>
                                            <a class="btn btn-outline-success" href="<?php echo e(route('licencias.create')); ?>">Capturar licencia</a>
                                            <a href="<?php echo e(route('licencias.index')); ?>" class="btn btn-outline-danger">Consultar licencia</a>
                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="material-icons">info</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Apartado de Redes e IPs -->
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('SUBREDES_IP#ver')): ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card card-stats">
                                        <div class="card-header card-header-primary card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">network_ping</i>
                                            </div>
                                            <h3 class="card-title">Subredes e IP´s</h3>
                                            <a class="btn btn-outline-success" href="<?php echo e(route('subredes.index')); ?>">Consultar Subredes</a>
                                            <a class="btn btn-outline-danger" href="<?php echo e(route('ips.index')); ?>">Consultar IP's</a>
                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="material-icons">info</i><a href="<?php echo e(route('subredes.create')); ?>" >Capturar Subred</a>
                                                <i class="material-icons">info</i><a href="<?php echo e(route('ips.create')); ?>">Capturar Ip</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Apartado de Estadisticas -->
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ESTADISTICAS#ver')): ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card card-stats">
                                        <div class="card-header card-header-success card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">dashboard</i>
                                            </div>
                                            <h3 class="card-title">Estadisticas</h3>
                                            <a class="btn btn-outline-success" href="<?php echo e(route('estadisticas')); ?>">Consultar Estadisticas</a>
                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="material-icons">info</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Apartado de Logs -->
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('LOGS#ver')): ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card card-stats">
                                        <div class="card-header card-header-primary card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">info_outline</i>
                                            </div>
                                            <h3 class="card-title">Logs</h3>
                                            <a class="btn btn-outline-danger" href="<?php echo e(route('logs.index')); ?>">Consultar Logs</a>
                                            <a class="btn btn-outline-success" href="<?php echo e(route('estadisticas')); ?>">Consultar Estadisticas</a>

                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="material-icons">info</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Apartado de Mantenimiento   -->
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('MANTENIMIENTO#ver')): ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card card-stats">
                                        <div class="card-header card-header-success card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">handyman</i>
                                            </div>
                                            <h3 class="card-title">Mantenimiento</h3>
                                            <a class="btn btn-outline-success" href="<?php echo e(route('mantenimiento.index')); ?>">Consultar Mantenimientos</a>
                                            <a class="btn btn-outline-danger" href="<?php echo e(route('mantenimiento.create')); ?>">Capturar Mantenimientos</a>
                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="material-icons">devices</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Apartado de Requisiciones -->
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('REQUISICIONES#ver')): ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-header card-header-secundary card-header-icon">
                                            <div class="card-icon">
                                                <i class="material-icons">info_outline</i>
                                            </div>
                                            <h3 class="card-title">Requisiciones</h3>
                                            <a class="btn btn-outline-success" href="#">Capturar Requisición</a>
                                            <a href="#" class="btn btn-outline-danger">Consultar Requisición</a>
                                        </div>
                                        <div class="card-footer">
                                            <div class="stats">
                                                <i class="material-icons">info</i>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cNormal_PERSONAL#ver')): ?>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header card-header-secundary card-header-icon">
                                                <div class="card-icon">
                                                    <i class="material-icons">group</i>
                                                </div>
                                                <h3 class="card-title">Personal</h3>
                                                <a class="btn btn-outline-success" href="<?php echo e(route('personal.create')); ?>">Capturar Personal</a>
                                                <a href="<?php echo e(route('personal.index')); ?>" class="btn btn-outline-danger">Consultar Personal</a>
                                            </div>
                                            <div class="card-footer">
                                                <div class="stats">
                                                    <i class="material-icons">group</i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card card-stats">
                                    <div class="card-header card-header-success card-header-icon">
                                        <div class="card-icon">
                                            <i class="material-icons">info_outline</i>
                                        </div>
                                        <h3 class="card-title">Exit</h3>
                                        <a class="btn btn-outline-danger" href="<?php echo e(route('logout')); ?>"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"
                                        >
                                        <?php echo e(__('Salir')); ?>

                                        </a>
                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                            <?php echo csrf_field(); ?>
                                        </form>
                                        <div class="card-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/mamp/htdocs/sige/resources/views/home.blade.php ENDPATH**/ ?>