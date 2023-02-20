<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['nombre_agente']) || isset($_POST['id_agente_up']) || isset($_POST['id_agente_de']) ) {
  /*--------- instancia al controlador ---------*/
  require_once "../controladores/agenteControlador.php";
  $ins_cliente = new agenteControlador();
  /*--------- agregar un agente ---------*/
  if (isset($_POST['nombre_agente'])) {
    echo $ins_cliente->agregar_agente_controlador();
  }
  /*--------- editar un agente ---------*/
  if (isset($_POST['id_agente_up'])) {
    echo $ins_cliente->actualizar_agente_controlador();
  }
  /*--------- eliminar un agente ---------*/
  if (isset($_POST['id_agente_de'])) {
    echo $ins_cliente->eliminar_agente_controlador();
  }
  /*--------- eliminar un agente ---------*/
  // if (isset($_POST['contraseña_verificacion'])) {
  //   echo $ins_cliente->verificacion_agente_controlador();
  // }
} else {
  session_start(['name' => 'IHS']);
  session_unset();
  session_destroy();
  header("Location: " . SERVERURL . "login/");
  exit();
}
