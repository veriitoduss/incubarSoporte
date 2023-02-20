<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['nombre_cliente']) || isset($_POST['id_cliente_up']) || isset($_POST['id_cliente_de'])) {
  /*--------- instancia al controlador ---------*/
  require_once "../controladores/clienteControlador.php";
  $ins_cliente = new clienteControlador();
  /*--------- agregar un cliente ---------*/
  if (isset($_POST['nombre_cliente'])) {
    echo $ins_cliente->agregar_cliente_controlador();
  }
  /*--------- editar un cliente ---------*/
  if (isset($_POST['id_cliente_up'])) {
    echo $ins_cliente->actualizar_cliente_controlador();
  }
  /*--------- eliminar un cliente ---------*/
  if (isset($_POST['id_cliente_de'])) {
    echo $ins_cliente->eliminar_cliente_controlador();
  }
} else {
  session_start(['name' => 'IHS']);
  session_unset();
  session_destroy();
  header("Location: " . SERVERURL . "login/");
  exit();
}
