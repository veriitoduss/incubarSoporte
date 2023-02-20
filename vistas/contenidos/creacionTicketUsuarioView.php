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
<link href="<?php echo SERVERURL; ?>assets/plugins/summernote/summernote.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />


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
          <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/respuestaTicketAjax.php" id="formularioProyecto" method="POST" data-form="save" autocomplete="off">
            <form>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <div class="">
                      <div class="caja">
                        <label for="nombre_cliente_Respuesta"><b>Tu Nombre</b></label>
                        <p style="padding-top:12px!important" for="">Por favor, ingrese su nombre</p>
                        <input style="padding:15px!important;font-size:13px" type="text" id="nombre_cliente_Respuesta" name="nombre_cliente_Respuesta">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="">
                      <div class="caja">
                        <label for="correo_cliente_respuesta"><b>Tu correo electrónico </b></label>
                        <p style="padding-top:12px!important" for="">Por favor, ingrese su dirección de correo electrónico</p>
                        <input style="padding:15px!important;font-size:13px" type="text" id="correo_cliente_respuesta" name="correo_cliente_respuesta">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" style="margin-top: 20px;">
                <div class="col-md-12">
                  <div class="formularioTicketContenedorTres">
                    <textarea name="descripcion" id="descripcion" class="wysihtml5 form-control" rows="9" cols="40"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-9">
                      <div class="formCkeck">
                        <div class="formFileContainer">
                          <p id="textoAdjuntarArchivo">Adjuntar archivo</p>
                          <input type="file" class="adjuntar" name="archivo_adjunto_ticket" id="archivo_adjunto_ticket">
                        </div>
                        <p class="recomendacionAdjunto">Puede cargar archivos con un tamaño máximo de 5 mb de tipos jpg, jpeg, png, gif, pdf, doc, docx, ppt, pptx, pps, ppsx, odt, xls, xlsx, mp3, m4a, ogg, wav, mp4, m4v, mov, wmv, avi, mpg, ogv, 3gp, 3g2, zip, eml.</p>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="botonesEnviarTicket">
                        <button class="Enviar" value="guardar" type="submit">Respuesta</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
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