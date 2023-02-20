<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['estado']) || isset($_POST['id_estado_up']) || isset($_POST['id_estado_de'])) {
  /*--------- instancia al controlador ---------*/
  require_once "../controladores/estadoControlador.php";
  $ins_estado = new estadoControlador();
  /*--------- agregar un estado ---------*/
  if (isset($_POST['estado'])) {
    echo $ins_estado->agregar_estado_controlador();
  }
  /*--------- editar un estado ---------*/
  if (isset($_POST['id_estado_up'])) {
    echo $ins_estado->actualizar_estado_controlador();
  }
  /*--------- eliminar un estado ---------*/
  if (isset($_POST['id_estado_de'])) {
    echo $ins_estado->eliminar_estado_controlador();
  }
} else {
  session_start(['name' => 'IHS']);
  session_unset();
  session_destroy();
  header("Location: " . SERVERURL . "login/");
  exit();
}
