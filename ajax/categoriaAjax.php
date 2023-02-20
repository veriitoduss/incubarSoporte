<?php
$peticionAjax = true;
require_once "../config/APP.php";

if (isset($_POST['nombre_categoria']) || isset($_POST['id_categoria_up']) || isset($_POST['id_categoria_de'])) {
  /*--------- instancia al controlador ---------*/
  require_once "../controladores/categoriaControlador.php";
  $ins_categorias = new categoriaControlador();
  /*--------- agregar una categoria ---------*/
  if (isset($_POST['nombre_categoria'])) {
    echo $ins_categorias->agregar_categoria_controlador();
  }
  /*--------- editar una categoria ---------*/
  if (isset($_POST['id_categoria_up'])) {
    echo $ins_categorias->actualizar_categoria_controlador();
  }
  /*--------- eliminar una categoria ---------*/
  if (isset($_POST['id_categoria_de'])) {
    echo $ins_categorias->eliminar_categoria_controlador();
  }
} else {
  session_start(['name' => 'IHS']);
  session_unset();
  session_destroy();
  header("Location: " . SERVERURL . "login/");
  exit();
}
