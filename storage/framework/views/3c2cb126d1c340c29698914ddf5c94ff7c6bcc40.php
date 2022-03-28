<?php $__env->startSection('content'); ?>
    <script type="text/javascript">

        $(document).ready(function() {
            $('#js-example-basic-single').select2();

        });
        //var dateControl = document.querySelector('input[type="date"]');
        //dateControl.value = '2017-06-01';
    </script>
    <div class="container">
        <?php if(Auth::check() && (Auth::user()->role =='admin' ||  Auth::user()->role =='cta' || Auth::user()->role =='aulas' || Auth::user()->role =='redes' || Auth::user()->role =='auxiliar')): ?>
            <?php if(session('message')): ?>
                <div class="alert alert-success">
                    <h2><?php echo e(session('message')); ?></h2>

                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-auto ml-3">
                    <h2>Captura de Curso</h2>
                </div>
                <hr>
            </div>

            <div class="row">
                <div class="col-12">
                    <form action="<?php echo e(route('cursos.store')); ?>" method="post" enctype="multipart/form-data">
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
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="tipo">Tipo </label>
                                    <select class="form-control" id="tipo" name="tipo">
                                        <option disabled>Seleccione un tipo</option>
                                        <option value="Aula">Aula</option>
                                        <option value="Laboratorio" selected>Laboratorio</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="dia">Día </label>
                                    <select class="form-control" id="dia" name="dia">
                                        <option disabled>Elegir</option>
                                        <option value="Lunes" selected>Lunes</option>
                                        <option value="Martes">Martes</option>
                                        <option value="Miércoles">Miércoles</option>
                                        <option value="Jueves">Jueves</option>
                                        <option value="Viernes">Viernes</option>
                                        <option value="Sábado">Sábado</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="ciclo">Ciclo </label>
                                    <select class="form-control" id="ciclo" name="ciclo">
                                        <option disabled>Elegir</option>
                                        <option value="2021A" selected>2021A</option>
                                        <option value="2022A" selected>2022A</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <label class="font-weight-bold" for="id_area">Aula</label>
                                    <select class="form-control" id="js-example-basic-single"
                                        name="id_area">
                                        <option value="Elegir" selected>Elegir</option>
                                        <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($area->id); ?>"><?php echo e($area->sede); ?> -
                                                <?php echo e($area->division); ?> -
                                                <?php echo e($area->coordinacion); ?> - <?php echo e($area->area); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                </div>
                                <div class="col-md-3">
                                    <label class="font-weight-bold" for="horario">Horario </label>
                                    <input type="text" class="form-control" id="horario" name="horario"
                                        value="<?php echo e(old('horario')); ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="font-weight-bold" for="crn">Crn </label>
                                    <input type="text" class="form-control" id="crn" name="crn"
                                        value="<?php echo e(old('crn')); ?>">
                                </div>
                            </div>
                            <br>
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="curso">Curso </label>
                                    <input type="text" class="form-control" id="curso" name="curso"
                                        value="<?php echo e(old('curso')); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="codigo">Código </label>
                                    <input type="text" class="form-control" id="codigo" name="codigo"
                                        value="<?php echo e(old('codigo')); ?>" max="20">
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="profesor">Profesor </label>
                                    <input type="text" class="form-control" id="profesor" name="profesor"
                                        value="<?php echo e(old('profesor')); ?>">
                                </div>
                            </div>
                            <br>
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="cupo">Cupo </label>
                                    <input type="number" class="form-control" id="cupo" name="cupo"
                                        value="<?php echo e(old('cupo')); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="alumnos">Alumnos </label>
                                    <input type="number" class="form-control" id="alumnos" name="alumnos"
                                        value="<?php echo e(old('alumnos')); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="font-weight-bold" for="pe">Pe </label>
                                    <input type="text" class="form-control" id="pe" name="pe" value="<?php echo e(old('pe')); ?>"
                                        max="20">
                                </div>
                            </div>
                            <br>
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <label class="font-weight-bold" for="departamento">Departamento </label>
                                    <input type="text" class="form-control" id="departamento" name="departamento"
                                        value="<?php echo e(old('departamento')); ?>">
                                </div>
                            </div>
                            <br>
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <label class="font-weight-bold" for="observaciones">Observaciones </label>
                                    <input type="text" class="form-control" id="observaciones" name="observaciones"
                                        value="<?php echo e(old('observaciones')); ?>">
                                </div>
                            </div>
                            <br>
                        </div>
                        <br>
                        <div class="row align-items-center m-0">
                            <div class="col-md-6">
                                <a href="<?php echo e(route('home')); ?>" class="btn btn-danger">Cancelar</a>
                                <button type="submit" class="btn btn-success">Guardar datos <i
                                        class="ml-1 fas fa-save"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <div class="row align-items-center">
                <br>
                <div class="col-12 ml-3">
                    <h5>En caso de inconsistencias, favor de reportarlas.</h5>
                </div>
                <hr>
            </div>
    </div>

<?php else: ?>
    El periodo de Registro de Proyectos a terminado
    <?php endif; ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/mamp/htdocs/sige/resources/views/cursos/create.blade.php ENDPATH**/ ?>