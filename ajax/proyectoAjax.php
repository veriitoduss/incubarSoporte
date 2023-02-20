<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['nombre_proyecto']) || isset($_POST['id_proyecto_up']) || isset($_POST['id_proyecto_de'])) {
  /*--------- instancia al controlador ---------*/
  require_once "../controladores/proyectoControlador.php";
  $ins_proyecto = new proyectoControlador();
  /*--------- agregar un proyecto ---------*/
  if (isset($_POST['nombre_proyecto']) && isset($_POST['identificador_proyecto'])) {
    echo $ins_proyecto->agregar_proyecto_controlador();
  }
  /*--------- actualizar un proyecto ---------*/
  if (isset($_POST['id_proyecto_up'])) {
    echo $ins_proyecto->actualizar_proyecto_controlador();
  }
  /*--------- eliminar un requerimiento ---------*/
  if (isset($_POST['id_proyecto_de'])) {
    echo $ins_proyecto->eliminar_proyecto_controlador();
  }
} else {
  session_start(['name' => 'IHS']);
  session_unset();
  session_destroy();
  header("Location: " . SERVERURL . "login/");
  exit();
}
