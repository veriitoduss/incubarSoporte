<?php

if ($peticionAjax) {
  require_once "../modelos/creacionTicketUsuarioModelo.php";
} else {
  require_once "./modelos/creacionTicketUsuarioModelo.php";
}
class creacionTicketUsuarioControlador extends creacionTicketUsuarioModelo
{
  /*--------- agregar repuesta usuario ---------*/
  public function agregar_respuesta_usuario_ticket_controlador()
  {
  }
}
