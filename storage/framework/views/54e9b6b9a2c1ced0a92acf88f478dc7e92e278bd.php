<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'cta' || Auth::user()->role == 'auxiliar' || Auth::user()->role == 'redes')): ?>
            <?php if(session('message')): ?>
                <div class="alert alert-success">
                    <h2><?php echo e(session('message')); ?></h2>

                </div>
            <?php endif; ?>
            <div class="row">
                <h2>Captura de Equipos</h2>
                <hr>
                <script type="text/javascript">

                    $(document).ready(function() {
                        $('#js-example-basic-single').select2();

                    });
                    $(document).ready(function() {
                        $('#js-example-basic-single2').select2();

                    });
                </script>

            </div>

            <form action="<?php echo e(route('equipos.store')); ?>" method="post" enctype="multipart/form-data" class="col-12">
                <div class="row">
                    <div class="col">
                        <?php echo csrf_field(); ?>

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    Debe de llenar los campos marcados con un asterisco (*).
                                </ul>
                            </div>
                        <?php endif; ?>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label for="udg_id">Id UdeG</label>
                                <input type="text" class="form-control" id="udg_id" name="udg_id" value="<?php echo e(old('udg_id')); ?>" >
                            </div>
                            <div class="col-md-4">
                                <label for="tipo_equipo">Tipo de Equipo </label>
                                <select class="form-control" id="tipo_equipo" name="tipo_equipo">
                                    <option disabled selected>Elegir</option>
                                    <?php $__currentLoopData = $tipo_equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($tipos->tipo_equipo); ?>"><?php echo e($tipos->tipo_equipo); ?></option>
				    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="id_resguardante">Resguardante</label>
                                <select class="form-control" id="js-example-basic-single" name="id_resguardante">
                                    <option value="No Aplica" selected>No Aplica</option>
                                    <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($empleado->id); ?>"><?php echo e($empleado->nombre); ?> <?php echo e($empleado->codigo); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label for="marca">Marca </label>
                                <input type="text" class="form-control" id="marca" name="marca" value="<?php echo e(old('marca')); ?>" >
                            </div>

                            <div class="col-md-4">
                                <label for="modelo">Modelo </label>
                                <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo e(old('modelo')); ?>" >
                            </div>
                            <div class="col-md-4">
                                <label for="numero_serie">Número de Serie </label>
                                <input type="text" class="form-control" id="numero_serie" name="numero_serie" value="<?php echo e(old('numero_serie')); ?>" >
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label for="mac">MAC separado por ":" ej 18:AB:34:45</label>
                                <input type="text" class="form-control" id="mac" name="mac" value="No aplica/No Especificado" >
                            </div>
                            <div class="col-md-4">
                                <label for="ip_id">IP</label>
                                <select class="form-control" id="ip_id" name="ip_id">
                                    <option value="null" selected>No aplica/No Especificado</option>
                                    <?php $__currentLoopData = $ips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ip->id); ?>" ><?php echo e($ip->ip); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <!--<input type="text" class="form-control" id="ip" name="ip" value="No aplica/No Especificado" >-->
				
                            </div>
                            <div class="col-md-4">
                                <label for="tipo_conexion">Tipo de Conexión</label>
                                <select class="form-control" id="tipo_conexion" name="tipo_conexion">
                                    <option value="No Aplica" selected>No Aplica</option>
                                    <option value="Red Cableada">Red Cableada</option>
                                    <option value="Solo Wifi<">Solo Wifi</option>
                                    <option value="Wifi y Ethernet">Wifi y Ethernet</option>
                                    <option value="Sin conexión">Sin conexión</option>
                                </select>
                            </div>
                        </div>
			<br>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <label for="resguardante">Dependencia Resguardante</label>
                                <select name="resguardante" id="resguardante" class="form-control">
				    <option disable selected>Elegir</option>
                                    <option value="Otra dependencia">Otra dependencia</option>
                                    <option value="CTA">CTA</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="localizado_sici">Inventariable</label>
                                <select name="localizado_sici" id="localizado_sici" class="form-control">
				    <option disable selected>Elegir</option>
                                    <option value="No">No</option>
                                    <option value="Si">Si</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <label for="detalles">Detalles</label>
                                <textarea class="form-control" id="detalles" name="detalles"><?php echo e(old('detalles')); ?></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <label for="area_id">&Aacute;reas</label>
                                <select class="form-control" class="form-control" id="js-example-basic-single2" name="area_id">
                                    <option value="No Aplica" selected>No Aplica</option>
                                    <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($area->id); ?>"><?php echo e($area->sede); ?> - <?php echo e($area->division); ?> - <?php echo e($area->coordinacion); ?> - <?php echo e($area->area); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <br>
			<div class="row align-items-center">
                    		<div class="col-md-6">
                        		<a href="<?php echo e(route('home')); ?>" class="btn btn-danger">Cancelar</a>
                        		<button type="submit" class="btn btn-success">Guardar datos</button>
                    		</div>
                    	</div>
               	 	</div>
                	<br>
                	
            	</div>
            </form>
            <br>
            <div class="row align-items-center">

                <br>
                <h5>En caso de inconsistencias enviar un correo a victor.ramirez@academicos.udg.mx</h5>
                <hr>

            </div>
    </div>

    <?php else: ?>
        El periodo de Registro de Proyectos a terminado
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/mamp/htdocs/sige/resources/views/equipo/create.blade.php ENDPATH**/ ?>