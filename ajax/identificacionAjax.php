<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['tipo_identificacion']) || isset($_POST['id_tipo_identificacion_up']) || isset($_POST['id_tipo_identificacion_de'])) {
  /*--------- instancia al controlador ---------*/
  require_once "../controladores/IdentificacionControlador.php";
  $ins_identificacion = new IdentificacionControlador();
  /*--------- agregar un tipo identificacion ---------*/
  if (isset($_POST['tipo_identificacion'])) {
    echo $ins_identificacion->agregar_identificacion_controlador();
  }
  /*--------- editar un tipo identificacion ---------*/
  if (isset($_POST['id_tipo_identificacion_up'])) {
    echo $ins_identificacion->actualizar_identificacion_controlador();
  }
  /*--------- eliminar un tipo identificacion ---------*/
  if (isset($_POST['id_tipo_identificacion_de'])) {
    echo $ins_identificacion->eliminar_identificacion_controlador();
  }
} else {
  session_start(['name' => 'IHS']);
  session_unset();
  session_destroy();
  header("Location: " . SERVERURL . "login/");
  exit();
}
