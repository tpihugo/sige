<!DOCTYPE html>
<?php
 include './loginSecurity.php';
?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>SIGE. BPEJ. Sistema Integral de Gestión</title>
        <link rel="shortcut icon" href="favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Equipo de Desarrollo BPEJ">
        <!--bootstrap-->
        <link rel="stylesheet" href="css/bootstrap.css"><!-- Editado para el menu -->
        <!--jquery-->
        <script src="js/jquery-3.2.1.min.js"></script>
        <!--bootstrap-js-->
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
            <?php
    include 'barraMenu.php';
    $menu = new menu();
    $menu ->barraMenu();
    date_default_timezone_set("America/Mexico_City");

    include 'indexMensaje.php';
    $obj = new mensaje();
    $obj->setFechaCaducidad($menu->caducidadMes(+3));



    ?>
        <div class="container">
          <div class="page-header">
              <h3 style="text-align: center">Mensajes Importantes <small>SIGE</small></h3>
          </div>


        <?php
         if ($_SESSION['privilegios'] == 'Encargado Almacén' || $_SESSION['privilegios'] == 'RH-Almacen')
        {
             $arregloReqPend = $obj->requisicionesPendientes();
                    if (is_array($arregloReqPend))
                    {
             ?>
                        <div class="panel panel-default">
                          <div class="panel-heading"><h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse1"><center>Requisiciones Pendientes
                                            <span class="glyphicon glyphicon-triangle-bottom"></span></center></a>
                                </h4></div>
                                <div id="collapse1" class="panel-collapse collapse">
                          <div class="panel-body">

                            <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>IdWeb</th>
                                    <th>Fecha</th>
                                    <th>Folio</th>
                                    <th>Tipo</th>
                                    <th>Responsable</th>
                                    <th>Solicitante</th>
                                    <th></th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
            <?php

                        for ($i = 0; $i < count($arregloReqPend); $i++)
                        {
                            echo '
                            <tr>
                                <td>'. $arregloReqPend[$i][0] .'</td>
                                <td>'. $arregloReqPend[$i][1] .'</td>
                                <td>'. $arregloReqPend[$i][2] .'</td>
                                <td>'. $arregloReqPend[$i][3] .'</td>
                                <td>'. $arregloReqPend[$i][4] .'</td>
                                <td>'. $arregloReqPend[$i][5] .'</td>
                                <td><a href="requisicionDetalle.php?id='. $arregloReqPend[$i][0] .'" class="btn btn-default" target="_blank" role="button">Ver Detalle</a></td>
                                <td><a href="requisicionModificar.php?id='. $arregloReqPend[$i][0] .'" class="btn btn-default" role="button">Modificar/Autorizar</a></td>'
                        . '</tr>';
                        }

                    ?>
                    </tbody>
                      </table>
                    </div>

                    </div>
               </div>
            </div>
            <br>
            <?php
                    }


                    $arregloCompInc = $obj->comprasIncompletas();
                            if (is_array($arregloCompInc))
                            {

                            ?>
                                <div class="panel panel-default">
                                      <div class="panel-heading"><h4 class="panel-title">
                                                <a data-toggle="collapse" href="#collapse2"><center>Compras Incompletas
                                                        <span class="glyphicon glyphicon-triangle-bottom"></span></center></a>
                                            </h4></div>
                                            <div id="collapse2" class="panel-collapse collapse">
                                      <div class="panel-body">

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th>Folio Compra</th>
                                            <th>Fecha</th>
                                            <th>Tipo</th>
                                            <th>Recibió</th>
                                            <th>Proveedor</th>
                                            <th></th>
                                            <th></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                            <?php
                                for ($i = 0; $i < count($arregloCompInc); $i++)
                                {
                                    echo '
                                    <tr>
                                        <td>'. $arregloCompInc[$i][0] .'</td>
                                        <td>'. $arregloCompInc[$i][1] .'</td>
                                        <td>'. $arregloCompInc[$i][2] .'</td>
                                        <td>'. $arregloCompInc[$i][3] .'</td>
                                        <td>'. $arregloCompInc[$i][4] .'</td>
                                        <td><a href="compraDetalle.php?id='. $arregloCompInc[$i][0] .'&t='. $arregloCompInc[$i][2] .'" class="btn btn-default">Ver Detalle</a></td>
                                        <td><a href="entregaAlta.php?id='. $arregloCompInc[$i][0] .'&t='. $arregloCompInc[$i][2] .'" class="btn btn-default">Agregar Entrega</a></td>'
                                . '</tr>';
                                }

                            ?>
                            </tbody>
                          </table>
                    </div>

                </div>
               </div>
            </div>
            <br>
            <?php
                            }
        }


         if ($_SESSION['privilegios'] == 'Ayudante Almacén' || $_SESSION['privilegios'] == 'RH-Almacen')
        {
                     $arregloReqSurt = $obj->requisicionesSurtir();
                            if (is_array($arregloReqSurt))
                            {
             ?>
                                <div class="panel panel-default">
                                      <div class="panel-heading"><h4 class="panel-title">
                                                <a data-toggle="collapse" href="#collapse3"><center>Requisiciones por Surtir
                                                        <span class="glyphicon glyphicon-triangle-bottom"></span></center></a>
                                            </h4></div>
                                            <div id="collapse3" class="panel-collapse collapse">
                                      <div class="panel-body">

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th>IdWeb</th>
                                            <th>Fecha</th>
                                            <th>Folio</th>
                                            <th>Tipo</th>
                                            <th>Responsable</th>
                                            <th>Solicitante</th>
                                            <th></th>
                                            <th></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                            <?php

                                for ($i = 0; $i < count($arregloReqSurt); $i++)
                                {
                                    echo '
                                    <tr>
                                        <td>'. $arregloReqSurt[$i][0] .'</td>
                                        <td>'. $arregloReqSurt[$i][1] .'</td>
                                        <td>'. $arregloReqSurt[$i][2] .'</td>
                                        <td>'. $arregloReqSurt[$i][3] .'</td>
                                        <td>'. $arregloReqSurt[$i][4] .'</td>
                                        <td>'. $arregloReqSurt[$i][5] .'</td>
                                        <td><a href="requisicionDetalle.php?id='. $arregloReqSurt[$i][0] .'" class="btn btn-default" target="_blank" role="button">Ver Detalle</a></td>
                                        <td><td><a href="requisicionSurtir.php?id='. $arregloReqSurt[$i][0] .'" class="btn btn-default" role="button">Surtir</a></td></td>'
                                . '</tr>';
                                }


                            ?>
                        </tbody>
                      </table>
                </div>

                </div>
               </div>
            </div>
        <br>
        <?php
                            }
        }


         if ($_SESSION['privilegios'] == 'Coordinador')
        {
                     $arregloReqReci = $obj->requisicionesRecibir();
                            if (is_array($arregloReqReci))
                            {
             ?>
            <div class="panel panel-default">
                      <div class="panel-heading"><h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse4"><center>Requisiciones por Recibir
                                        <span class="glyphicon glyphicon-triangle-bottom"></span></center></a>
                            </h4></div>
                            <div id="collapse4" class="panel-collapse collapse">
                      <div class="panel-body">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>IdWeb</th>
                            <th>Fecha</th>
                            <th>Folio</th>
                            <th>Tipo</th>
                            <th>Responsable</th>
                            <th>Solicitante</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php

                                for ($i = 0; $i < count($arregloReqReci); $i++)
                                {
                                    echo '
                                    <tr>
                                        <td>'. $arregloReqReci[$i][0] .'</td>
                                        <td>'. $arregloReqReci[$i][1] .'</td>
                                        <td>'. $arregloReqReci[$i][2] .'</td>
                                        <td>'. $arregloReqReci[$i][3] .'</td>
                                        <td>'. $arregloReqReci[$i][4] .'</td>
                                        <td>'. $arregloReqReci[$i][5] .'</td>
                                        <td><a href="requisicionDetalle.php?id='. $arregloReqReci[$i][0] .'" class="btn btn-default" target="_blank" role="button">Ver Detalle</a></td>'
                                . '</tr>';
                                }


                            ?>
                        </tbody>
                      </table>
                </div>

                </div>
               </div>
            </div>
        <br>
        <?php
                            }
        }


         if ($_SESSION['privilegios'] == 'Recursos Humanos' || $_SESSION['privilegios'] == 'RH-Almacen')
        {
                     $arregloPer = $obj->permisosPendientes();
                            if (is_array($arregloPer))
                            {
             ?>
                            <div class="panel panel-default">
                                      <div class="panel-heading"><h4 class="panel-title">
                                                <a data-toggle="collapse" href="#collapse5"><center>Permisos Pendientes
                                                        <span class="glyphicon glyphicon-triangle-bottom"></span></center></a>
                                            </h4></div>
                                            <div id="collapse5" class="panel-collapse collapse">
                                      <div class="panel-body">

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th>Folio</th>
                                            <th>Empleado</th>
                                            <th>Área</th>
                                            <th>Fecha Solicitud</th>
                                            <th>Fecha Permiso</th>
                                            <th>Motivo</th>
                                            <th>Estatus</th>
                                            <th>Documento</th>
                                            <th>Movimiento</th>
                                          </tr>
                                        </thead>
                                        <tbody>
             <?php

                                for ($i = 0; $i < count($arregloPer); $i++)
                                {
                                    echo '
                                    <tr>
                                        <td>'. $arregloPer[$i][0] .'</td>
                                        <td>'. $arregloPer[$i][1] .'</td>
                                        <td>'. $arregloPer[$i][2] .'</td>
                                        <td>'. $arregloPer[$i][3] .'</td>
                                        <td>'. $arregloPer[$i][4] .'</td>
                                        <td>'. $arregloPer[$i][5] .'</td>
                                        <td>'. $arregloPer[$i][6] .'</td>
                                        <td>'. $arregloPer[$i][7] .'</td>
                                        <td>'. $arregloPer[$i][8] .'</td>'
                                . '</tr>';
                                }


            ?>
                    </tbody>
                      </table>
                </div>

                </div>
               </div>
            </div>
        <br>
            <?php
                            }
        }


         if ($_SESSION['privilegios'] == 'Encargado Almacén' || $_SESSION['privilegios'] == 'Dirección' || $_SESSION['privilegios'] == 'RH-Almacen')
        {
                     $arregloLimp = $obj->limpiezaResurtir();
                            if (is_array($arregloLimp))
                            {
             ?>
            <div class="panel panel-default">
                      <div class="panel-heading"><h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse6"><center>Material de Limpieza por Resurtir
                                        <span class="glyphicon glyphicon-triangle-bottom"></span></center></a>
                            </h4></div>
                            <div id="collapse6" class="panel-collapse collapse">
                      <div class="panel-body">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Existencia</th>
                            <th>Stock Mínimo</th>
                            <th>Años Cad.</th>
                            <th>Nivel de Existencia</th>
                          </tr>
                        </thead>
                        <tbody>
             <?php

                                for ($i = 0; $i < count($arregloLimp); $i++)
                                {
                                    echo '
                                    <tr>
                                        <td>'. $arregloLimp[$i][0] .'</td>
                                        <td>'. $arregloLimp[$i][1] .'</td>
                                        <td>'. $arregloLimp[$i][2] .'</td>
                                        <td>'. $arregloLimp[$i][3] .'</td>
                                        <td>'. $arregloLimp[$i][4] .'</td>
                                        <td>'. $arregloLimp[$i][5] .'</td>'
                                . '</tr>';
                                }


            ?>
                    </tbody>
                      </table>
                </div>

                </div>
               </div>
            </div>
        <br>
            <?php
                            }

            $arregloPap = $obj->papeleríaResurtir();
                            if (is_array($arregloPap))
                            {
             ?>
            <div class="panel panel-default">
                      <div class="panel-heading"><h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse7"><center>Material de Papelería por Resurtir
                                        <span class="glyphicon glyphicon-triangle-bottom"></span></center></a>
                            </h4></div>
                            <div id="collapse7" class="panel-collapse collapse">
                      <div class="panel-body">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Existencia</th>
                            <th>Stock Mínimo</th>
                            <th>Años Cad.</th>
                            <th>Nivel de Existencia</th>
                          </tr>
                        </thead>
                        <tbody>
             <?php

                                for ($i = 0; $i < count($arregloPap); $i++)
                                {
                                    echo '
                                    <tr>
                                        <td>'. $arregloPap[$i][0] .'</td>
                                        <td>'. $arregloPap[$i][1] .'</td>
                                        <td>'. $arregloPap[$i][2] .'</td>
                                        <td>'. $arregloPap[$i][3] .'</td>
                                        <td>'. $arregloPap[$i][4] .'</td>
                                        <td>'. $arregloPap[$i][5] .'</td>'
                                . '</tr>';
                                }


            ?>
                    </tbody>
                      </table>
                </div>

                </div>
               </div>
            </div>
        <br>
            <?php
                            }


         $arregloLimpCad = $obj->calculoMaterialLimpiezaPorCaducar();
                            if (is_array($arregloLimpCad))
                            {
             ?>
            <div class="panel panel-default">
                      <div class="panel-heading"><h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse8"><center>Material de Limpieza Por Caducar
                                        <span class="glyphicon glyphicon-triangle-bottom"></span></center></a>
                            </h4></div>
                            <div id="collapse8" class="panel-collapse collapse">
                      <div class="panel-body">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Existencia en Almacen</th>
                            <th>fechaEntrada </th>
                            <th>Fecha de Caducidad</th>
                            <th>Cantidad Caducada</th>
                            <th>No. Compra</th>
                            <th> No. Entrega</th>
                          </tr>
                        </thead>
                        <tbody>
             <?php

                                for ($i = 0; $i < count($arregloLimpCad); $i++)
                                {
                                    echo '
                                    <tr>
                                        <td>'. $arregloLimpCad[$i][0] .'</td>
                                        <td>'. $arregloLimpCad[$i][1] .'</td>
                                        <td>'. $arregloLimpCad[$i][2] .'</td>
                                        <td>'. $arregloLimpCad[$i][3] .'</td>
                                        <td>'. $arregloLimpCad[$i][4] .'</td>
                                        <td>'. $arregloLimpCad[$i][5] .'</td>
                                        <td>'. $arregloLimpCad[$i][6] .'</td>
                                        <td>'. $arregloLimpCad[$i][7] .'</td>'
                                . '</tr>';
                                }


            ?>
                    </tbody>
                      </table>
                </div>

                </div>
               </div>
            </div>
        <br>
            <?php
                            }


                     $arregloPapCad = $obj->calculoMaterialPapeleriaPorCaducar();
                            if (is_array($arregloPapCad))
                            {
             ?>
            <div class="panel panel-default">
                      <div class="panel-heading"><h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse9"><center>Material de Papelería Por Caducar
                                        <span class="glyphicon glyphicon-triangle-bottom"></span></center></a>
                            </h4></div>
                            <div id="collapse9" class="panel-collapse collapse">
                      <div class="panel-body">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Existencia en Almacen</th>
                            <th>fechaEntrada </th>
                            <th>Fecha de Caducidad</th>
                            <th>Cantidad Caducada</th>
                            <th>No. Compra</th>
                            <th> No. Entrega</th>
                          </tr>
                        </thead>
                        <tbody>
             <?php

                                for ($i = 0; $i < count($arregloPapCad); $i++)
                                {
                                    echo '
                                    <tr>
                                        <td>'. $arregloPapCad[$i][0] .'</td>
                                        <td>'. $arregloPapCad[$i][1] .'</td>
                                        <td>'. $arregloPapCad[$i][2] .'</td>
                                        <td>'. $arregloPapCad[$i][3] .'</td>
                                        <td>'. $arregloPapCad[$i][4] .'</td>
                                        <td>'. $arregloPapCad[$i][5] .'</td>
                                        <td>'. $arregloPapCad[$i][6] .'</td>
                                        <td>'. $arregloPapCad[$i][7] .'</td>'
                                . '</tr>';
                                }


            ?>
                    </tbody>
                      </table>
                </div>

                </div>
               </div>
            </div>
            <?php
                            }
        }


        if ($_SESSION['privilegios'] == 'Administrador' || $_SESSION['privilegios'] == 'Sistemas')
        {
             ?>
        <div class="row">
          <div class="col-xs-12 col-xs-offset-8">
            <a href="ticketAlta.php" class="btn btn-success">Capturar nuevo Ticket</a>
            <a href="ticketConsulta.php" class="btn btn-primary">Consulta de Tickets</a>
            <br>
            <br>
          </div>
        </div>
            <?php
            include 'ticket.php';
            $ticket = new ticket();
            $arregloTicketsAbiertos =$ticket->ticketMensaje();

            ?>
            <div class="panel panel-default">
                      <div class="panel-heading"><h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse10"><center>Tickets Abiertos <?php echo count($arregloTicketsAbiertos); ?>
                                        <span class="glyphicon glyphicon-triangle-bottom"></span></center></a>
                            </h4></div>
                            <div id="collapse10" class="panel-collapse">
                      <div class="panel-body">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                            <th>ID</th>
                            <th>Prioridad</th>
                            <th>Fecha Reporte</th>
                            <th>Reporte</th>
                            <th>Área</th>
                            <th>Piso</th>
                            <th>Edificio</th>
                            <th>IdEquipo </th>
                            <th>Descripción</th>
                            <th>Marca</th>
                            <th>Nún. Serie</th>
                            <th>Ver</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                                for ($i = 0; $i < count($arregloTicketsAbiertos); $i++)
                                     {
                                     echo '
                                           <tr>
                                               <td>'. $arregloTicketsAbiertos[$i][0] .'</td>
                                               <td>'. $arregloTicketsAbiertos[$i][1] .'</td>
                                               <td>'. $arregloTicketsAbiertos[$i][2] .'</td>
                                               <td>'. $arregloTicketsAbiertos[$i][3] .'</td>
                                               <td>'. $arregloTicketsAbiertos[$i][4] .'</td>
                                               <td>'. $arregloTicketsAbiertos[$i][5] .'</td>
                                               <td>'. $arregloTicketsAbiertos[$i][6] .'</td>
                                               <td>'. $arregloTicketsAbiertos[$i][7] .'</td>
                                               <td>'. $arregloTicketsAbiertos[$i][8] .'</td>
                                               <td>'. $arregloTicketsAbiertos[$i][9] .'</td>
                                               <td>'. $arregloTicketsAbiertos[$i][10] .'</td>
                                               <td>'. $arregloTicketsAbiertos[$i][11] .'</td>'
                                             . '</tr>';
                                     }
                         ?>
                    </tbody>
                      </table>
                </div>

                </div>
               </div>
            </div>

            <?php
        }
        ?>

        <br>
        <br>

    </body>
</html>
