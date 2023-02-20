<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['nombre_rol_ag'])||isset($_POST['id_pivote_permiso_de'])) {
  /*--------- instancia al controlador ---------*/
  require_once "../controladores/administradorControlador.php";
  $ins_roles = new administradorControlador();
  /*--------- agregar un rol ---------*/
  if (isset($_POST['nombre_rol_ag'])) {
    echo $ins_roles->agregar_roles_controlador();
  }
    /*--------- eliminar permisos---------*/
    if (isset($_POST['id_pivote_permiso_de'])) {
      echo $ins_roles->eliminar_rol_permiso_controlador();
    }
} else {
  session_start(['name' => 'IHS']);
  session_unset();
  session_destroy();
  header("Location: " . SERVERURL . "login/");
  exit();
}
