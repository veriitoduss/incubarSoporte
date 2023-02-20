<?php
require_once "./controladores/ticketControlador.php";
$ins_ticket = new ticketControlador();
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
<div class="row" style="margin-top: 10px;">
  <div class="col-md-12">
    <form class="FormularioAjax" enctype="multipart/form-data" action="<?php echo SERVERURL; ?>ajax/ticketAjax.php" id="formularioTicket" method="POST" data-form="save" autocomplete="off">
      <div class="panel-primary">
        <div class="row">
          <div class="col-md-4">
            <div class="caja">
              <label for="nombre_apellido_usuario"><b>Nombre(s) y Apellidos(s) </b><span style="color:red">*</span></label>
              <p style="padding-top:12px!important" for="">Por favor ingrese su nombre(s) y apellido(s).</p>
              <input style="padding:15px!important;font-size:13px" type="text" id="nombre_apellido_usuario" name="nombre_apellido_usuario" require>
            </div>
          </div>
          <div class="col-md-4">
            <div class="caja">
              <label for="id_tipo_identificacion"><b>Tipo de Identificación </b><span style="color:red">*</span></label>
              <p style="padding-top:12px!important" for="">Por favor seleccionar</p>
              <?php
              echo $ins_ticket->mostrar_datosIdentificacion_controlador();
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="caja">
              <label for="numero_identificacion_usuario"><b>Numero de identificación </b><span style="color:red">*</span></label>
              <p style="padding-top:12px!important" for="">Por favor ingrese el número sin puntos o comas.</p>
              <input type="number" style="padding:15px!important;font-size:13px" pattern="[0-9]{1,20}" id="numero_identificacion_usuario" name="numero_identificacion_usuario" require>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="caja">
              <label for="celular_usuario"><b>Celular </b><span style="color:red">*</span></label>
              <p style="padding-top:12px!important" for="">Por favor ingrese su numero celular (Max 10 dígitos).</p>
              <input style="padding:15px!important;font-size:13px" pattern="[0-9]{1,10}" type="number" maxlength="10" id="celular_usuario" name="celular_usuario" require>
            </div>
          </div>
          <div class="col-md-4">
            <div class="caja">
              <label for="correo_usuario"><b>Dirección de correo electrónico </b><span style="color:red">*</span></label>
              <p style="padding-top:12px!important" for="">Por favor ingrese su correo electrónico.</p>
              <input style="padding:15px!important;font-size:13px" type="email" name="correo_usuario" id="correo_usuario" require>
            </div>
          </div>
          <div class="col-md-4">
            <div class="caja">
              <label for="id_tipo_requerimiento"><b>Tipo de Requerimiento </b><span style="color:red">*</span></label>
              <p style="padding-top:12px!important" for="">Por favor seleccione el requerimiento a interponer.</p>
              <?php
              echo $ins_ticket->mostrar_datosRequerimiento_controlador();
              ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="caja">
              <label><b>Seleccione el Proyecto </b><span style="color:red">*</span></label>
              <p style="padding-top:12px!important" for="">Por favor seleccionar una opción relacionada con su PQRS.</p>
              <?php
              echo $ins_ticket->mostrar_datosProyecto_controlador();
              ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="caja">
              <label><b>Seleccione el cliente </b><span style="color:red">*</span></label>
              <p style="padding-top:12px!important" for="">Por favor seleccionar</p>
              <?php
              echo $ins_ticket->mostrar_clientes_controlador();
              ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="formularioTicketContenedorTres">
              <label for="asunto"><br>Asunto <span>*</span></label>
              <p style="padding-top:12px!important" for="">Describa el asunto de la falla, solicitud o petición.</p>
              <input style="padding:15px!important;font-size:13px" type="text" name="asunto" id="asunto" require>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="formularioTicketContenedorTres">
              <label for="descripcion">Descripcion <span>*</span></label>
              <p style="padding-top:12px!important" for="">Descripción detallada de la falla, solicitud o petición que realiza.</p>
              <textarea name="descripcion" id="descripcion" class="wysihtml5 form-control" rows="9" cols="40"></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="formCkeck">
              <div class="formFileContainer">
                <p id="textoAdjuntarArchivo">Adjuntar archivo</p>
                <input type="file" class="adjuntar" name="archivo_adjunto_ticket" id="archivo_adjunto_ticket">
              </div>
              <p class="recomendacionAdjunto">Puede cargar archivos con un tamaño máximo de 5 mb de tipos jpg, jpeg, png, gif, pdf, doc, docx, ppt, pptx, pps, ppsx, odt, xls, xlsx, mp3, m4a, ogg, wav, mp4, m4v, mov, wmv, avi, mpg, ogv, 3gp, 3g2, zip, eml.</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="formCkeck">
              <div class="formCkeckContainer">
                <input type="checkbox" name="envioFormulario">
                <label for="opt-in">Autorizo el <a href="http://www.incubarhuila.co/recursos/politica-de-privacidad/">Tratamiento de Datos Personales.</a></label>
              </div>
            </div>
          </div>
      </div>
      <div class="botonesEnviarTicket">
        <button class="Enviar" value="guardar" type="submit">Enviar Ticket</button>
        <!-- <input type="button" class="Formulario" onclick="limpiar()" value="restablecer formulario"> -->
      </div>
  </div>
  </form>
</div>
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