<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['nombre_cliente_Respuesta'])) {
  /*--------- instancia al controlador ---------*/
  require_once "../controladores/creacionTicketUsuarioControlador.php";
  $ins_respuestaTicketUsuario = new creacionTicketUsuarioControlador();
  /*--------- agregar respuesta usuario del ticket ---------*/
  if (isset($_POST['nombre_cliente_Respuesta'])) {
    echo $ins_ticketRespuestaUsuario->agregar_respuesta_usuario_ticket_controlador();
  }
} else {
  session_start(['name' => 'IHS']);
  session_unset();
  session_destroy();
  header("Location: " . SERVERURL . "login/");
  exit();
}
