<?php
include "Views/Layouts/Soporte/head.php";
include "Views/Layouts/Soporte/header.php"; ?>
<div class="cuerpo">
  <div style="width: 100%">
    <div class="contenedorBotones">
      <a href="<?php base_url(); ?>tickets" style="background-color: #f9bf00 !important;"><i class="fa-solid fa-plus"></i>Nuevo ticket</a>
    </div>
    <form action="<?php base_url(); ?>tickets/AgregarTickets" id="formularioTicket" method="post">
      <div class="formularioTicketContenedorUno">
        <div class="caja">
          <label for="nombre_apellido_usuario">Nombre(s) y Apellidos(s) <span>*</span></label>
          <p for="">Por favor ingrese su nombre(s) y apellido(s).</p>
          <input type="text" id="nombre_apellido_usuario" name="nombre_apellido_usuario" require>
        </div>

        <div class="caja">
          <label for="id_tipo_identificacion">Tipo de Identificación <span>*</span></label>
          <p for="">Por favor seleccionar</p>
          <select name="id_tipo_identificacion" id="id_tipo_identificacion" require>
            <option value="" selected></option>
            <?php
            foreach ($data['identificaciones'] as $identificacion) { ?>
              <option value="<?php echo $identificacion['id_tipo_identificacion']; ?>"><?php echo $identificacion['tipo_identificacion']; ?></option>
            <?php }
            ?>
          </select>
        </div>
        <div class="caja">
          <label for="numero_identificacion_usuario">Numero de identificación <span>*</span></label>
          <p for="">digite numero</p>
          <input type="text" id="numero_identificacion_usuario" name="numero_identificacion_usuario" require>
        </div>
        <div class="caja">
          <label for="celular_usuario">Celular <span>*</span></label>
          <p for="">Por favor ingrese su numero celular (Max 10 dígitos)</p>
          <input type="number" id="celular_usuario" name="celular_usuario" require>
        </div>
        <div class="caja">
          <label for="correo_usuario">Dirección de correo electrónico <span>*</span></label>
          <p for="">Por favor ingrese su correo electrónico.</p>
          <input type="email" name="correo_usuario" id="correo_usuario" require>
        </div>
        <div class="caja">
          <label for="id_tipo_requerimiento">Tipo de Requerimiento <span>*</span></label>
          <p for="">Por favor seleccione el requerimiento a interponer.</p>
          <select name="id_tipo_requerimiento" id="id_tipo_requerimiento" require>
            <option value=""></option>
            <?php
            foreach ($data['requerimientos'] as $requerimiento) { ?>
              <option value="<?php echo $requerimiento['id_tipo_requerimiento']; ?>"><?php echo $requerimiento['tipo_requerimiento']; ?></option>
            <?php }
            ?>
          </select>
        </div>
      </div>
      <div class="formularioTicketContenedorDos">
        <div class="caja">
          <label for="id_proyecto">Seleccione el Proyecto <span>*</span></label>
          <p for="">Por favor seleccionar una opción relacionada con su PQRS.</p>
          <select name="id_proyecto" id="id_proyecto" require>
            <option value=""></option>
            <?php
            foreach ($data['proyectos'] as $proyecto) { ?>
              <option value="<?php echo $proyecto['id_proyecto']; ?>"><?php echo $proyecto['nombre_proyecto']; ?></option>
            <?php }
            ?>
          </select>
        </div>
        <div class="caja">
          <label for="id_cliente">Seleccione el cliente <span>*</span></label>
          <p for="">Por favor seleccionar</p>
          <select name="id_cliente" id="id_cliente" require>
            <option value=""></option>
            <?php
            foreach ($data['clientes'] as $cliente) { ?>
              <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['nombre_cliente']; ?></option>
            <?php }
            ?>
          </select>
        </div>
        <input type="hidden" id="numero_ticket" value="prueba" name="numero_ticket" require>
        <input type="hidden" value="1" name="id_estado" id="id_estado" require>
      </div>
      <div class="formularioTicketContenedorTres">
        <label for="asunto">Asunto <span>*</span></label>
        <p for="">Describa el asunto de la falla, solicitud o petición.</p>
        <input type="text" name="asunto" id="asunto" require>
      </div>
      <div class="formularioTicketContenedorTres">
        <label for="descripcion">Descripcion <span>*</span></label>
        <p for="">Descripción detallada de la falla, solicitud o petición que realiza.</p>
        <textarea name="descripcion" id="descripcion" rows="10" cols="40"></textarea>
      </div>
      <div class="formCkeck">
        <div class="formFileContainer">
          <p id="textoAdjuntarArchivo">Adjuntar archivo</p>
          <input type="file" class="adjuntar" name="archivo_adjunto_ticket" id="archivo_adjunto_ticket">
        </div>
        <p class="recomendacionAdjunto">Puede cargar archivos con un tamaño máximo de 5 mb de tipos jpg, jpeg, png, gif, pdf, doc, docx, ppt, pptx, pps, ppsx, odt, xls, xlsx, mp3, m4a, ogg, wav, mp4, m4v, mov, wmv, avi, mpg, ogv, 3gp, 3g2, zip, eml.</p>
      </div>
      
      <div class="formCkeck">
        <div class="formCkeckContainer">
          <input type="checkbox" name="my-checkbox" id="opt-in">
          <label for="opt-in">Autorizo el <a href="http://www.incubarhuila.co/recursos/politica-de-privacidad/">Tratamiento de Datos Personales.</a></label>
        </div>
      </div>
      <div class="botonesEnviarTicket">
        <button class="Enviar" value="guardar" type="submit">Enviar Ticket</button>
        <!-- <a class="Enviar" type="submit">Enviar Ticket</a> -->
        <input type="button" class="Formulario" onclick="limpiar()" value="restablecer formulario">
      </div>
    </form>
  </div>

</div>
<?php include "Views/Layouts/Soporte/footer.php"; ?>