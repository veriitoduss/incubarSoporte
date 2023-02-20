<div clas="menuListaTicketBoton">
  <a class="botonListaTicketAmarillo" href="<?php echo SERVERURL; ?>formularioTicket/"><i class="fa-solid fa-plus"></i>Nuevo ticket</a>
  <!-- <a class="botonListaTicketVerde"><i class="fa-solid fa-user-gear"></i>Configuracion Agente</a> -->

  <?php
  if ($_SESSION['rol_ihs'] == 0 || $_SESSION['rol_ihs'] == "" || $_SESSION['rol_ihs'] == " ") {
  ?>
    <!-- <a class="botonListaTicketVerde" href=""><i class="fa-solid fa-download"></i>Descargar</a> -->
  <?php
  } else { ?>
    <a type="button" class="botonListaTicketVerde" data-toggle="modal" data-target="#myModalElevado"><i class="fa-solid fa-user-gear"></i>Configuracion Agente</a>
    <div id="myModalElevado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalElevadoLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel" style="color:#01562C">Configuracion Agente</h4>
          </div>
          <div class="modal-body">
            <p class="firma">firma</p>
            <div style="border:1px solid #969899;padding:15px;border-radius:2px">
              <p>Agente</p>
              <p><?php echo $_SESSION['nombre_ihs']; ?></p>
              <p>Mesa de ayuda</p>
              <p>INCUBARHUILA</p>
            </div>
          </div>
          <div class="modal-footer"><button type="button" class="btn btn-default waves-effect" style="border-radius:6px" data-dismiss="modal">Cerrar</button>
            <!-- <button type="submit" class="botonModalModificar">Modificar</button> -->
          </div>
        </div>
      </div>
    </div>
  <?php }
  ?>

  <!-- <a class="botonListaTicketVerde" href=""><i class="fa-solid fa-retweet"></i>Restablecer filtros</a> -->
  <?php
  if ($_SESSION['rol_ihs'] == 1 || $_SESSION['rol_ihs'] == 10) {
  ?>
    <!-- <a class="botonListaTicketVerde" href=""><i class="fa-solid fa-download"></i>Descargar</a> -->
    <a class="botonListaTicketVerde" href="<?php echo SERVERURL; ?>adminIndex/"><i class="fa-solid fa-user-shield"></i>Admin</a>
  <?php
  }
  ?>
</div>
<?php
if ($_SESSION['rol_ihs'] == 0 || $_SESSION['rol_ihs'] == "" || $_SESSION['rol_ihs'] == " ") {
?>
  <!-- <a class="botonListaTicketVerde" href=""><i class="fa-solid fa-download"></i>Descargar</a> -->
<?php
} else { ?>
<div style="margin-left:auto;padding-right:20px">
  <a class="btn-exit-system" id="botonListaTicketAmarillo" href=""><i class="fa-solid fa-right-from-bracket"></i>Cerrar sesion</a>
</div>
<?php }
?>