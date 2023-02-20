<?php
// if ($_SESSION['rol_ihs'] == 0 || $_SESSION['rol_ihs'] == "" || $_SESSION['rol_ihs'] == " ") {
//   echo $lc->forzar_cierre_sesion_controlador();
//   exit();
// }
$pagina[1];
include "./vistas/inc/menuSoporte.php";
require_once "./controladores/listaTicketControlador.php";
$ins_listaTicket = new listaTicketControlador();
require_once "./controladores/respuestaTicketControlador.php";
$ins_datosTicket = new respuestaTicketControlador();
$datos_ticket = $ins_listaTicket->datos_ticket_respuesta_controlador($pagina[1]);
require_once "./controladores/ticketRespuestaControlador.php";
$ins_datosTicketRepuesta = new ticketRespuestaControlador();
$campos_ticket = $datos_ticket->fetch();
?>
<link href="<?php echo SERVERURL; ?>assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="<?php echo SERVERURL; ?>assets/css/diseno.css" rel="stylesheet" type="text/css">
<link href="<?php echo SERVERURL; ?>assets/plugins/summernote/summernote.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
<script>
  (function(i, s, o, g, r, a, m) {
    i["GoogleAnalyticsObject"] = r;
    (i[r] =
      i[r] ||
      function() {
        (i[r].q = i[r].q || []).push(arguments);
      }),
    (i[r].l = 1 * new Date());
    (a = s.createElement(o)), (m = s.getElementsByTagName(o)[0]);
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m);
  })(
    window,
    document,
    "script",
    "../../www.google-analytics.com/analytics.js",
    "ga"
  );
  ga("create", "UA-86308552-1", "auto");
  ga("send", "pageview");
</script>
<!-- <h1>hola <?php echo $pagina[1]; ?></h1> -->
<!-- <h1>hola <?php echo $campos_ticket['nombre_categoria']; ?></h1> -->
<div class="cuerpo" style="background-color:white !important">
  <div style="width: 100%">
    <div class="contenedorBotones" style="display: flex">
      <div clas="menuListaTicketBoton">
        <a class="botonListaTicketAmarillo" href="<?php echo SERVERURL; ?>formularioTicket/"><i class="fa-solid fa-plus"></i>Nuevo ticket</a>
        <a class="botonListaTicketVerde" href="<?php echo SERVERURL; ?>listaTicket/"><i class="fa-solid fa-list"></i>Lista de Ticket</a>
        <!-- <a class="botonListaTicketVerde" href=""><i class="fa-solid fa-arrows-rotate"></i>Refrescar</a> -->

        <!-- <a class="botonListaTicketVerde" href="<?php echo SERVERURL; ?>adminIndex/"><i class="fa-solid fa-trash"></i>Borrar</a> -->
        <!-- <form class="FormularioAjax" style="font-family:inherit!important" action="' . SERVERURL . 'ajax/respuestaTicketAjax.php" method="POST" data-form="delete" autocomplete="off">
          <input type="hidden" name="id_ticket_de" id="id_ticket_de" value="">
          <button type="submit" class="botonListaTicketVerde" style="font-family: inherit!important;"><i class="fa-solid fa-trash-can">hola</i></button>
        </form> -->

        <!-- <a class="botonListaTicketVerde" href="<?php echo SERVERURL; ?>adminIndex/"><i class="fa-regular fa-clone"></i>Clonar</a> -->
        <!-- <a class="botonListaTicketVerde" href="<?php echo SERVERURL; ?>adminIndex/"><i class="fa-regular fa-clipboard"></i>Copy URL</a> -->
      </div>
      <div style="margin-left:auto;padding-right:20px">
      </div>
    </div>

    <div class="row" style="margin-left: 10px;margin-top:15px;">
      <div class="col-md-9">
        <div class="panel-primary" style="border:none">
          <span style="font-size:14px;margin-left:10px"><b>[Ticket #<?php echo $campos_ticket['numero_ticket']; ?>] <?php echo $campos_ticket['asunto']; ?></b></span>
          <div class="row">
            <?php
                echo $ins_datosTicket->mostrar_formulario_respuesta_ticket_controlador($pagina[1],$_SESSION['rol_ihs'],$campos_ticket['correo_usuario'],$campos_ticket['numero_ticket'],$campos_ticket['nombre_apellido_usuario']);
                ?>  
          </div>
          <!-- <div class="alert alert-success"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a -->
                      <!-- href="#" class="alert-link">Alert Link</a>.</div> -->
          <div class="col-md-12">
            <div class="panel-primary" style="border:none">
              <div class="row">
                <?php
                echo $ins_datosTicketRepuesta->mostrar_mensaje_respuesta_controlador($pagina[1])
                ?>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="panel panel-primary" style="text-align: center;border:1px solid #DCDDDE;border-radius:4px">
                    <?php
                    echo $ins_datosTicketRepuesta->mostrar_mensaje_creacion_controlador($pagina[1])
                    ?>
                  </div>
                </div>
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
                echo $ins_datosTicket->mostrar_elevado_por_ticket_controlador($pagina[1])
                ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-primary" style="text-align: center;border:1px solid #DCDDDE;border-radius:4px">
                <?php
                echo $ins_datosTicket->mostrar_agente_ticket_controlador($pagina[1])
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
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-primary" style="text-align: center;border:1px solid #DCDDDE;border-radius:4px">
                <?php
                echo $ins_datosTicket->boton_modal_campos_solo_agente_controlador($pagina[1])
                ?>
                <!-- <span style="font-size:12px"><i class="fa-solid fa-rectangle-list"></i> <b>Campos Solo Agente </b></span><i class="fa-solid fa-pen-to-square" style="border:1px solid #DCDDDE;font-size:9px;padding:6px;border-radius:2px;cursor:pointer"></i> -->
                <!-- <span style="margin-left: -10px !important;display:block"> No agente solo campos</span> -->
                <?php
                // echo $ins_datosTicket->mostrar_campos_solo_agente_controlador($pagina[1])
                ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-primary" style="text-align: center;border:1px solid #DCDDDE;border-radius:4px">
                <?php
                echo $ins_datosTicket->mostrar_destinatarios_adicionales_ticket_controlador($pagina[1])
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <a href="" onclick="window.print()">imprimir</a> -->
</div>
<div style="width: 100%">
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
<script src="<?php echo SERVERURL; ?>assets/js/app.js"></script>

<script type="text/javascript" src="<?php echo SERVERURL; ?>assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="<?php echo SERVERURL; ?>assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script src="<?php echo SERVERURL; ?>assets/plugins/summernote/summernote.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/js/app.js"></script>
<script>
  jQuery(document).ready(function() {
    $(".wysihtml5").wysihtml5();
    $(".summernote").summernote({
      height: 200,
      minHeight: null,
      maxHeight: null,
      focus: true,
    });
  });
</script>