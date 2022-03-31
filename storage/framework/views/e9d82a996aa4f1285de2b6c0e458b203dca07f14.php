<?php $__env->startSection('content'); ?>


    <div class="container">
        <?php if(Auth::check()): ?>
            <?php if(session('message')): ?>
                <div class="alert alert-success">
                    <h2><?php echo e(session('message')); ?></h2>

                </div>
            <?php endif; ?>
            <div class="row">
                <h2>Edición de Préstamo. Folio: <?php echo e($prestamo->id); ?></h2>
                <hr>
                <script type="text/javascript">

                    $(document).ready(function() {
                        $('#js-example-basic-single').select2();

                    });

                </script>

            </div>
            <form action="<?php echo e(route('prestamos.update', $prestamo->id)); ?>" method="post" enctype="multipart/form-data" class="col-12">
                <?php echo method_field('PUT'); ?>
                <div class="row">
                    <div class="col">
                        <?php echo csrf_field(); ?>

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <br>

                        <div class="row g-3 align-items-center">
                            <div class="col-md-8">
                                <label for="id_area">Areas</label>
                                <select class="form-control" class="form-control" id="js-example-basic-single" name="id_area">
                                    <option value="<?php echo e($vsPrestamo->id_area); ?>" selected><?php echo e($vsPrestamo->lugar); ?></option>
                                    <option value="No Aplica" >Cambiar</option>
                                    <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($area->id); ?>"><?php echo e($area->division); ?> - <?php echo e($area->coordinacion); ?> - <?php echo e($area->area); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="prioridad">Estado </label>
                                <select class="form-control" id="estado" name="estado">
                                    <option value="<?php echo e($prestamo->estado); ?>" selected><?php echo e($prestamo->estado); ?></option>
                                    <option disabled >Elegir</option>
                                    <option value="En préstamo" >En préstamo</option>
                                    <option value="Por Entregar">Por Entregar</option>
                                    <option value="Devuelto">Devuelto</option>
                                </select>
                            </div>

                        </div>
                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <label for="solicitante">Solicitante</label>
                                <input type="text" class="form-control" id="solicitante" name="solicitante" value="<?php echo e($prestamo->solicitante); ?>" >
                            </div>
                            <div class="col-md-6">
                                <label for="cargo">Cargo</label>
                                <input type="text" class="form-control" id="cargo" name="cargo" value="<?php echo e($prestamo->cargo); ?>" >
                            </div>


                        </div>
                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo e($prestamo->telefono); ?>" >
                            </div>
                            <div class="col-md-4">
                                <label for="correo">Correo</label>
                                <input type="text" class="form-control" id="correo" name="correo" value="<?php echo e($prestamo->correo); ?>" >
                            </div>

                            <div class="col-md-4">
                                <label for="fecha_inicio">Fecha:</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo e($prestamo->fecha_inicio); ?>" >
                            </div>
                        </div>
                        <br>
                        <div class="row g-3 align-items-center">
                                <hr>
                                <?php $__currentLoopData = $equiposPrestados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equiposPrestado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-2">
                                  
                                    <input type="text" class="form-control" id="equipo_id" name="fecha_inicio" value="<?php echo e($equiposPrestado->id_equipo); ?>" readonly> 
                                </div>
                              <br>
                                <div class="col-md-6">
                                    <label><?php echo e($equiposPrestado->tipo_equipo); ?>. Marca: <?php echo e($equiposPrestado->marca); ?>. Modelo: <?php echo e($equiposPrestado->modelo); ?>. Núm. de Serie <?php echo e($equiposPrestado->numero_serie); ?>. <br><b>IdUdeG:</b> <?php echo e($equiposPrestado->udg_id); ?></label>
                                </div>

                                <div class="col-md-3">
                                    <label>Accesorios: <?php echo e($equiposPrestado->accesorios); ?></label>
                                </div>
                                <div class="col-md-1">
                                    <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                                    <a href="#eliminar<?php echo e($equiposPrestado->id); ?>" role="button" class="btn btn-danger" data-toggle="modal">Quitar</a>

                                    <!-- Modal / Ventana / Overlay en HTML -->
                                    <div id="eliminar<?php echo e($equiposPrestado->id); ?>" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><h5>X</h5></button>

                                                </div>
                                                <div class="modal-body">
                                                    <h5>¿Seguro de quitar este elemento de la lista de préstamos?</h5>
                                                    <h5 class="text-secondary"><small><?php echo e($equiposPrestado->tipo_equipo); ?> Marca: <?php echo e($equiposPrestado->marca); ?>. Modelo: <?php echo e($equiposPrestado->modelo); ?>. Núm. de Serie <?php echo e($equiposPrestado->numero_serie); ?></small></h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                    
                                                    <a href="<?php echo e(route('quitar-equipo-prestado',['equipo_prestado'=>$equiposPrestado->id, 'prestamo_id'=>$prestamo->id])); ?>" type="button" class="btn btn-danger">Quitar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <hr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <label for="observaciones">Observaciones</label>
                                <textarea class="form-control" id="observaciones" name="observaciones"><?php echo e($prestamo->observaciones); ?></textarea>
                            </div>
                        </div>
			<div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <label for="documento">Documento</label>
                                <input type="file" class="form-control" id="documento" name="documento" value="<?php echo e(old('documento')); ?>">
                            </div>
                        </div>



                    </div>
                    <br>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <a href="<?php echo e(route('home')); ?>" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar datos</button>
                        </div>
                    </div>
                </div>
            </form>
            <br>
            <div class="row g-3 align-items-center">

                <br>
                <h5>En caso de inconsistencias, favor de reportarlas.</h5>
                <hr>

            </div>
    </div>

    <?php else: ?>
        El periodo de Registro de Proyectos a terminado
    <?php endif; ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/mamp/htdocs/sige/resources/views/prestamo/edit.blade.php ENDPATH**/ ?>