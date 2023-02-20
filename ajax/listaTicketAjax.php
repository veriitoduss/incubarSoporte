<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['nombre_categoria'])||isset($_POST['nombre_categoria'])) {
  /*--------- instancia al controlador ---------*/
  require_once "../controladores/listaTicketControlador.php";
  $ins_listaTicket = new listaTicketControlador();
  /*--------- agregar una categoria ---------*/
  if (isset($_POST['nombre_categoria'])) {
    // echo $ins_listaTicket->agregar_categoria_controlador();
  }


  if (isset($_POST['id_ticket_excel_ticket'])) {
    echo $ins_listaTicket->descargar_excel_controlador();
  }
} else {
  session_start(['name' => 'IHS']);
  session_unset();
  session_destroy();
  header("Location: " . SERVERURL . "login/");
  exit();
}
