<?php
$peticionAjax=true;
require_once "../config/APP.php";

if (isset($_POST['nombre_apellido_usuario']))
{
  /*--------- instancia al controlador ---------*/
  require_once "../controladores/ticketControlador.php";
  $ins_ticket= new ticketControlador();
  /*--------- agregar un ticket ---------*/
if (isset($_POST['nombre_apellido_usuario'])) {
  echo $ins_ticket->agregar_ticket_controlador();
}

}else {
  session_start(['name'=>'IHS']);
  session_unset();
  session_destroy();
  header("Location: ". SERVERURL."login/");
  exit();
}