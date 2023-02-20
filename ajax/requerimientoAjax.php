<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['tipo_requerimiento']) || isset($_POST['id_tipo_requerimiento_up']) || isset($_POST['id_tipo_requerimiento_de'])) {
  /*--------- instancia al controlador ---------*/
  require_once "../controladores/requerimientoControlador.php";
  $ins_requerimiento = new requerimientoControlador();
  /*--------- agregar un requerimiento ---------*/
  if (isset($_POST['tipo_requerimiento'])) {
    echo $ins_requerimiento->agregar_requerimiento_controlador();
  }
  /*--------- actualizar un requerimiento ---------*/
  if (isset($_POST['id_tipo_requerimiento_up'])) {
    echo $ins_requerimiento->actualizar_requerimiento_controlador();
  }
  /*--------- eliminar un requerimiento ---------*/
  if (isset($_POST['id_tipo_requerimiento_de'])) {
    echo $ins_requerimiento->eliminar_requerimiento_controlador();
  }
} else {
  session_start(['name' => 'IHS']);
  session_unset();
  session_destroy();
  header("Location: " . SERVERURL . "login/");
  exit();
}
