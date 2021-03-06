<?php $__env->startSection('content'); ?>
    <?php if(Auth::check() && (Auth::user()->role =='admin' ||  Auth::user()->role =='cta' || Auth::user()->role =='aulas' || Auth::user()->role =='redes' || Auth::user()->role =='auxiliar')): ?>

        <div class="container-fluid">
            <div class="row g-3 align-items-center">
                <div class="col-md-12">
                    <?php if(session('message')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('message')); ?>

                        </div>
                    <?php endif; ?>
                    <h2>Requisiciones </h2>
                                        <p align="right">
			<?php if(Auth::check() && Auth::user()->role == 'admin'): ?>
                        	<!-- <a href="<?php echo e(route('cursos.create')); ?>" class="btn btn-success">
                            		<i class="fa fa-plus"></i> Capturar Requisicion
                        	</a> -->

                          <a href="<?php echo e(route('requisicions.create')); ?>" class="btn btn-success">
                            		<i class="fa fa-plus"></i> Capturar Requisicion
                        	</a>
			<?php endif; ?>
                        <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">
                            <i class="fa fa-arrow-left"></i> Regresar
                        </a>
                    </p>
                </div>
            </div>
            <br>






<div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <table id="example" class="table table-striped table-bordered" cellspacing="2" width="100%">
                  <thead>
                      <tr>
                          <th>Acciones</th>
                          <th>Articulos</th>
                          <th>Número Solicitud</th>
                          <th>Fecha</th>
                          <th>ID Usuario</th>
                          <th>Proyecto</th>
                          <th>Fondo</th>
                          <th>Fecha Recibido</th>
                          <th>Recibido por</th>
                          <th>Id</th>
                      </tr>
                  </thead>
                  <tbody id="dataTable-tbody">



                  </tbody>
              </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>
                    <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">
                        < Regresar</a>


                </p>
            </div>
        </div>
    </div>

        

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.js"></script>

        <script type="text/javascript">
            var data = <?php echo json_encode($requisiciones, 15, 512) ?>;
            console.log(data);

            $(document).ready(function() {
                $('#example').DataTable({
                    "data": data,
                    "pageLength": 100,
                    "order": [
                        [0, "desc"]
                    ],
                    "language": {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    },
                    responsive: true,
                    // dom: 'Bfrtip',
                    dom: '<"col-xs-3"l><"col-xs-5"B><"col-xs-4"f>rtip',
                    buttons: [
                        'copy', 'excel',
                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LETTER',
                        }

                    ]
                })
               loader(false);

               let newTd = document.createElement('td');
               let tBody = document.getElementById('dataTable-tbody');
               newTd.innerHTML = 'FFF';
               tbody.children[0].appendChild(newTd);
            });


            jQuery.extend( jQuery.fn.dataTableExt.oSort, {
            "portugues-pre": function ( data ) {
                var a = 'a';
                    var e = 'e';
                    var i = 'i';
                    var o = 'o';
                    var u = 'u';
                    var c = 'c';
                    var special_letters = {
                        "Á": a, "á": a, "Ã": a, "ã": a, "À": a, "à": a,
                        "É": e, "é": e, "Ê": e, "ê": e,
                        "Í": i, "í": i, "Î": i, "î": i,
                        "Ó": o, "ó": o, "Õ": o, "õ": o, "Ô": o, "ô": o,
                        "Ú": u, "ú": u, "Ü": u, "ü": u,
                        "ç": c, "Ç": c
                    };
                    for (var val in special_letters)
                        data = data.split(val).join(special_letters[val]).toLowerCase();
                    return data;
                },
                "portugues-asc": function ( a, b ) {
                    return ((a < b) ? -1 : ((a > b) ? 1 : 0));
                },
                "portugues-desc": function ( a, b ) {
                    return ((a < b) ? 1 : ((a > b) ? -1 : 0));
                }
            } );
            //"columnDefs": [{ type: 'portugues', targets: "_all" }],

        </script>
    <?php else: ?>
        Acceso No válido
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.loader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/mamp/htdocs/sige/resources/views/requisiciones/index.blade.php ENDPATH**/ ?>