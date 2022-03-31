<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php if(Auth::check()): ?>
            <div class="row">
 <div class="col-md-12">
        <div class="card card-chart">
            <div class="card-header card-header-success">
            Inventario Express
            </div>
            <div class="card-body">

                <?php if(session('message')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('message')); ?>

                    </div>
                <?php endif; ?>
                <hr>
                <h3><span class="text-success"><i class="fa fa-search"></span></i> Revisión Inventario</h3>

                <form action="<?php echo e(route('equipo-encontrado')); ?>" method="post" enctype="multipart/form-data" class="col-md-12">
                    <?php echo csrf_field(); ?>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                Debe de llenar todos los campos
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="row g-3 align-items-end">
                        <div class="col-md-8 col-xs-12">
                            <label for="id">IDUdeG, Serial o Núm. SIGE</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo e(old('id')); ?>">
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <button type="submit" class="btn btn-success">Siguiente ></button>
                        </div>

                    </div>
                    <br>




                </form>
		 </div>
            <div class="card-footer">
         
            </div>

                <br>
                    <div class="row g-3 align-items-end">
                        <div class="col-md-8 col-xs-12">
                           
                        </div>
                    </div>
            </div>
        
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.appdash', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/mamp/htdocs/sige/resources/views/equipo/revision-inventario.blade.php ENDPATH**/ ?>