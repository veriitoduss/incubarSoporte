<?php
include "./vistas/inc/menuSoporte.php";
require_once "./controladores/ticketControlador.php";
$ins_ticket = new ticketControlador();
?>
<div class="cuerpo">
  <div style="width: 100%">
    <div class="contenedorBotones" style="display:flex;">
      <div clas="menuListaTicketBoton">
        <a href="<?php echo SERVERURL; ?>formularioTicket/" class="botonListaTicketAmarillo"><i class="fa-solid fa-plus"></i>Nuevo ticket</a>

        <?php
        if ($_SESSION['rol_ihs'] == 0 || $_SESSION['rol_ihs'] == "" || $_SESSION['rol_ihs'] == " ") {
        ?>
          <!-- <a class="botonListaTicketVerde" href=""><i class="fa-solid fa-download"></i>Descargar</a> -->
        <?php
        } else { ?>
          <a href="<?php echo SERVERURL; ?>listaTicket/" class="botonListaTicketVerde"><i class="fa-solid fa-table-list"></i>Lista ticket</a>
        <?php }
        ?>
      </div>
      <div style="margin-left:auto;padding-right:20px">
        <?php
        if ($_SESSION['rol_ihs'] == 0 || $_SESSION['rol_ihs'] == "" || $_SESSION['rol_ihs'] == " ") {
        ?>
          <!-- <a class="botonListaTicketVerde" href=""><i class="fa-solid fa-download"></i>Descargar</a> -->
        <?php
        } else { ?>
        <a class="btn-exit-system" id="botonListaTicketAmarillo" href=""><i class="fa-solid fa-right-from-bracket"></i>Cerrar sesion</a>
        <?php }
        ?>
      </div>

    </div>
    <?php
    include "./vistas/inc/formulario.php";
    ?>
  </div>

</div>
<div>
  <?php
  include "./vistas/inc/piePagina.php";
  ?>
</div>