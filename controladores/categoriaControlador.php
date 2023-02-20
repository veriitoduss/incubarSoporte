<?php

if ($peticionAjax) {
  require_once "../modelos/categoriaModelo.php";
} else {
  require_once "./modelos/categoriaModelo.php";
}
class categoriaControlador extends categoriaModelo
{
  /*--------- agregar categoría ---------*/
  public function agregar_categoria_controlador()
  {
    $nombre_categoria = mainModel::limpiar_cadena($_POST['nombre_categoria']);
    $eliminar = 0;

    /*=== comprobar estado vacios ===*/
    if ($nombre_categoria == "") {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No se han llenado todos los campos obligatorios",
          "Tipo" => "error"
        ];
      echo json_encode($alerta);
      exit();
    }
    $agregar_categoria = categoriaModelo::agregar_categoria_modelo($nombre_categoria, $eliminar);
    if ($agregar_categoria->rowCount() == 1) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Categoria agregado",
          "Texto" => "Los datos de la categoría han sido agregados",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "info",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No se ha podido agregar la categoría",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*--------- mostrar datos contenedor verde ---------*/
  public function mostrar_datosCategoria_controlador()
  {
    $mostrarDatosCategoria = "";
    $consulta = "SELECT * FROM categorias WHERE eliminar=0 ORDER BY nombre_categoria ASC";
    $conexion = mainModel::conectar();
    $datosCategoria = $conexion->query($consulta);
    $datosCategoria = $datosCategoria->fetchAll();
    foreach ($datosCategoria as $categoria) {
      $mostrarDatosCategoria .= '
        <div class="col-md-5 listarContenedor" style="margin-left: 25px">
          <scan style="padding:2px;padding-left:10px;">' . $categoria['nombre_categoria'] . '</scan>
          <div style="margin-left:auto;padding-right:20px;display:flex">
            <a type="submit" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;padding-top:2px" data-target="#myModalProyecto' . $categoria['id_categoria'] . '"> <i style="padding-right:0;color:white" class="fa-solid fa-pen-to-square"></i></a>
            <div id="myModalProyecto' . $categoria['id_categoria'] . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalProyectoLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalProyectoLabel">Modificar Categoría</h4>
                  </div>
                  <form class="FormularioAjax" action="' . SERVERURL . 'ajax/categoriaAjax.php" id="formularioRequerimiento" method="POST" data-form="update" autocomplete="off">
                    <input type="hidden" name="id_categoria_up" id="id_categoria_up" value="' . $categoria['id_categoria'] . '">
                    <div class="modal-body">
                      <div class="text-center" style="padding-bottom:20px">
                        <label style="display:block;color:black" for="nombre_categoria_up">Nombre de la categoría</label>
                        <input type="text" style="text-align:center" id="nombre_categoria_up" name="nombre_categoria_up" value="' . $categoria['nombre_categoria'] . '" class="form-control" style="width: 60%;text-align:center;">
                      </div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-default waves-effect" style="border-radius:6px" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="botonModalModificar">Modificar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <form class="FormularioAjax" action="' . SERVERURL . 'ajax/categoriaAjax.php" method="POST" data-form="delete" autocomplete="off">
              <input type="hidden" name="id_categoria_de" id="id_categoria_de" value="' . $categoria['id_categoria'] . '">
              <button type="submit" style="background:transparent;border:none"><i style="padding-right:0;color:white" class="fa-solid fa-trash-can"></i></button>
            </form>
          </div>
        </div>';
    }
    return $mostrarDatosCategoria;
  }
  /*---------- actualizar Categoría ----------*/
  public function actualizar_categoria_controlador()
  {
    $nombre_categoria = mainModel::limpiar_cadena($_POST['nombre_categoria_up']);
    //recibir el id
    $id_categoria = mainModel::limpiar_cadena($_POST['id_categoria_up']);
    // preparacion para envio de datos
    $datos_actualizar_categoria =
      [
        "nombre_categoria" => $nombre_categoria,
        "id_categoria" => $id_categoria
      ];
    if (categoriaModelo::actualizar_categoria_modelo($datos_actualizar_categoria)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Datos Actualizados",
          "Texto" => "Categoría actualizada exitosamente",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No hemos podido actualizar la categoría, por favor intente nuevamente",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*---------- eliminar Categoría ----------*/
  public function eliminar_categoria_controlador()
  {
    $eliminar = 1;
    $fecha_eliminado = date("Y-m-d H:i:s");
    //recibir el id
    $id_categoria = mainModel::limpiar_cadena($_POST['id_categoria_de']);
    // preparacion para envio de datos
    $datos_eliminar_categoria =
      [
        "eliminar" => $eliminar,
        "fecha_eliminado" => $fecha_eliminado,
        "id_categoria" => $id_categoria
      ];
    if (categoriaModelo::eliminar_categoria_modelo($datos_eliminar_categoria)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Texto" => "categoría eliminada exitosamente",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No hemos podido eliminar la categoría, por favor intente nuevamente",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
}
