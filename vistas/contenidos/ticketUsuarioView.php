<?php
// if ($_SESSION['rol_ihs'] == 0 || $_SESSION['rol_ihs'] == "" || $_SESSION['rol_ihs'] == " ") {
//   echo $lc->forzar_cierre_sesion_controlador();
//   exit();
// }
include "./vistas/inc/menuSoporte.php";
$pagina[1];
require_once "./controladores/listaTicketControlador.php";
$ins_listaTicket = new listaTicketControlador();
$datos_ticket = $ins_listaTicket->datos_ticket_respuesta_controlador($pagina[1]);
$campos_ticket = $datos_ticket->fetch();
require_once "./controladores/ticketRespuestaControlador.php";
$ins_datosTicket = new ticketRespuestaControlador();
?>
<link href="<?php echo SERVERURL; ?>assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="<?php echo SERVERURL; ?>assets/css/diseno.css" rel="stylesheet" type="text/css">
<link href="<?php echo SERVERURL; ?>assets/css/imprimir.css" media="print">

<!-- <h1>hola</h1> -->
<!-- <h1>hola <?php echo $pagina[1]; ?></h1> -->
<div class="cuerpo" style="background-color:white !important">
  <div style="width: 100%">
    <div class="contenedorBotones" style="display: flex">
      <div clas="menuListaTicketBoton">
        <a class="botonListaTicketAmarillo" href="<?php echo SERVERURL; ?>formularioTicket/"><i class="fa-solid fa-plus"></i>Nuevo ticket</a>
      </div>
      <div style="margin-left:auto;padding-right:20px">
      </div>
    </div>

    <div class="row" style="margin-left: 10px;margin-top:15px;">
      <span style="font-size:14px;margin-bottom:20px"><b>[Ticket #<?php echo $campos_ticket['numero_ticket']; ?>] <?php echo $campos_ticket['asunto']; ?></b></span>
      <div class="col-md-9">
        <div class="panel-primary" style="border:none">
          <div class="row">
            <div class="col-md-12">
              <?php
              echo $ins_datosTicket->mostrar_mensaje_respuesta_controlador($pagina[1])
              ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-primary" style="text-align: center;border:1px solid #DCDDDE;border-radius:4px">
                <?php
                echo $ins_datosTicket->mostrar_mensaje_creacion_controlador($pagina[1])
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div style="border:none;margin-right:10px">
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-primary" style="text-align: center;border:1px solid #DCDDDE;border-radius:4px;">
                <?php
                echo $ins_datosTicket->mostrar_estado_ticket_controlador($pagina[1])
                ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-primary" style="text-align: center;border:1px solid #DCDDDE;border-radius:4px">
                <?php
                echo $ins_datosTicket->mostrar_campos_ticket_controlador($pagina[1])
                ?>
              </div>
            </div>
            <!-- <a href="" class="botonImprimir" onclick="window.print()" >imprimir</a> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div style="width: 100%">
  <?php
  include "./vistas/inc/piePagina.php";
  ?>
</div>
