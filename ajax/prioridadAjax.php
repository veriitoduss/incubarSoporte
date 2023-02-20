<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['nombre_prioridad']) || isset($_POST['id_prioridad_up']) || isset($_POST['id_prioridad_de'])) {
  /*--------- instancia al controlador ---------*/
  require_once "../controladores/prioridadControlador.php";
  $ins_prioridad = new prioridadControlador();
  /*--------- agregar un prioridad ---------*/
  if (isset($_POST['nombre_prioridad']) && isset($_POST['id_proyecto'])) {
    echo $ins_prioridad->agregar_prioridad_controlador();
  }
  /*--------- editar un prioridad ---------*/
  if (isset($_POST['id_prioridad_up'])) {
    echo $ins_prioridad->actualizar_prioridad_controlador();
  }
  /*--------- eliminar un prioridad ---------*/
  if (isset($_POST['id_prioridad_de'])) {
    echo $ins_prioridad->eliminar_prioridad_controlador();
  }
} else {
  session_start(['name' => 'IHS']);
  session_unset();
  session_destroy();
  header("Location: " . SERVERURL . "login/");
  exit();
}
