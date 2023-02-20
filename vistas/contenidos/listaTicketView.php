<?php
// if ($_SESSION['rol_ihs'] == 0 || $_SESSION['rol_ihs'] == "" || $_SESSION['rol_ihs'] == " ") {
//   echo $lc->forzar_cierre_sesion_controlador();
//   exit();
// }
include "./vistas/inc/menuSoporte.php";
require_once "./controladores/listaTicketControlador.php";
$ins_listaTicket = new listaTicketControlador();
$agente = $_SESSION['rol_ihs'];
$permiso = $_SESSION['permisos_ihs'];
?>
<link href="<?php echo SERVERURL; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SERVERURL; ?>assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SERVERURL; ?>assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SERVERURL; ?>assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="<?php echo SERVERURL; ?>assets/css/diseno.css" rel="stylesheet" type="text/css">
<script src="<?php echo SERVERURL; ?>assets/js/jquery-3.6.1.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/js/jquery.min.js"></script>

<!-- <h1>hola <?php echo $agente; ?></h1> -->

<div class="cuerpo">
  <div class="row" style="width:100%">
    <div class="col-md-12" style="padding:0">
      <div class="contenedorBotones" style="display: flex">
        <?php
        include "./vistas/inc/menuListaTicket.php";
        // $filtroTabla = '';
        // if (!empty($_REQUEST['filtroTabla'])) {
          // $filtroTabla = $_REQUEST['filtroTabla'];
        // }
        // $pro = 0;
        // if (!empty($_REQUEST['filtros'])) {
          // $pro = $_REQUEST['filtros'];
        // }
        // echo $pro;
        ?>
      </div>
      <div class="row" style="margin-left: 10px;margin-top:15px">
        <div class="col-md-2">
          <div class="panel-primary" style="border:none">
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-primary" style="text-align: center;border:1px solid #F0F2F4;border-radius:4px">
                  <div class="panel-heading" style="border:1px solid black">
                    <h4 class="panel-title" style="font-size:16px!important"><i class="fa-solid fa-filter"></i> Filtros</h4>
                    <hr>
                    <!-- <select name="filtros" id="filtroTabla">
                        <option value="1">Todos los tickets</option>
                        <option value="2">No Resueltos</option>
                        <option value="3">Mio</option>
                        <option value="4">Eliminados</option>
                      </select> -->
                    <select name="filtros" class="filtroListaTicket" id="filtroTabla" multiple="multiple">
                      <option value="1">Todos los tickets</option>
                      <option value="2">No Resueltos</option>
                      <option value="3">Mio</option>
                      <option value="4">Eliminados</option>
                    </select>
                    <!-- <ul>
                        <li value="1"><a>Todos los tickets</a></li>
                        <li value="1"><a>No Resueltos</a></li>
                        <li value="1"><a>Mio</a></li>
                        <li value="1">Eliminados</li>
                        <li value="1">Sin Asignar</li>
                        <li value="1">Cerrardo</li>
                      </ul> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-primary" style="border:1px solid #F0F2F4;border-radius:4px">
                  <div class="panel-heading">
                    <h4 class="panel-title" style="font-size:16px!important;text-align:center"><i class="fa-solid fa-filter"></i> Filtros guardados</h4>
                    <hr>
                    <span>No se han encontrado filtros!</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-10">
          <div class="panel panel-primary" style="border:none">
            <div class="panel-body">
              <!-- <a href="<?php echo SERVERURL; ?>controladores/excel.php" download="mi_excel"> descargar</a> -->
            <form action="<?php echo SERVERURL; ?>controladores/excel.php" method="POST">
                          <input type="submit" name="export_excel" value="descargar excel">
                        </form>

              <div class="panel-body">
                <?php
                if ($_SESSION['rol_ihs'] == 1 || $_SESSION['rol_ihs'] == 10) { ?>
                  <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <?php
                    // echo $ins_listaTicket->mostrar_datosListaTickets_descargar_controlador($pagina[1], $pagina[0]);
                    ?>
                  <?php } else { ?>
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <?php } ?>
                    <?php
                    echo $ins_listaTicket->mostrar_datosListaTicketsTodos_controlador($pagina[1], $pagina[0]);
                    // echo $ins_listaTicket->mostrar_datosListaNoResuelto_controlador($pagina[1], $pagina[0]);
                    // echo $ins_listaTicket->mostrar_datosListaPorAgente_controlador($pagina[1], $pagina[0],$agente);
                    // echo $ins_listaTicket->mostrar_datosEliminados_controlador($pagina[1], $pagina[0]);
                    // echo $ins_listaTicket->mostrar_datosSinAsignar_controlador($pagina[1], $pagina[0]);
                    // echo $ins_listaTicket->mostrar_datosListaTickets_cerrado_controlador($pagina[1], $pagina[0]);
                    ?>
                    </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <?php
  include "./vistas/inc/piePagina.php";
  ?>
</div>
<script src="<?php echo SERVERURL; ?>assets/js/jquery.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/js/modernizr.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/js/detect.js"></script>
<script src="<?php echo SERVERURL; ?>assets/js/fastclick.js"></script>
<script src="<?php echo SERVERURL; ?>assets/js/jquery.slimscroll.js"></script>
<script src="<?php echo SERVERURL; ?>assets/js/jquery.blockUI.js"></script>
<script src="<?php echo SERVERURL; ?>assets/js/waves.js"></script>
<script src="<?php echo SERVERURL; ?>assets/js/wow.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo SERVERURL; ?>assets/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/plugins/datatablesTicket/jquery.dataTables.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/plugins/datatablesTicket/dataTables.bootstrap.js"></script>
<script src="<?php echo SERVERURL; ?>assets/plugins/datatablesTicket/dataTables.responsive.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/plugins/datatablesTicket/responsive.bootstrap.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/pages/dashborad.js"></script>
<script src="<?php echo SERVERURL; ?>assets/js/app.js"></script>
<script src="<?php echo SERVERURL; ?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/plugins/datatables/jszip.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/plugins/datatables/pdfmake.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/plugins/datatables/vfs_fonts.js"></script>
<script src="<?php echo SERVERURL; ?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/plugins/datatables/buttons.print.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/plugins/datatables/dataTables.scroller.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/pages/datatables.init.js"></script>
<script src="<?php echo SERVERURL; ?>assets/js/main.js"></script>