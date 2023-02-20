<?php

if ($peticionAjax) {
  require_once "../modelos/estadoModelo.php";
} else {
  require_once "./modelos/estadoModelo.php";
}
class estadoControlador extends estadoModelo
{
  /*--------- agregar estado ---------*/
  public function agregar_estado_controlador()
  {
    $estado = mainModel::limpiar_cadena($_POST['estado']);
    $eliminar = 0;
    /*=== comprobar estado vacios ===*/
    if ($estado == "") {
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
    /*=== validacion existencia ===*/
    $check_estado = mainModel::ejecutar_consulta_simple("SELECT estados FROM estado WHERE estado='$estado'");
    if ($check_estado->rowCount() > 0) {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "info",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "Estado existente",
          "Tipo" => "error"
        ];
      echo json_encode($alerta);
      exit();
    }
    $datos_estado_registro =
      [
        "estado" => $estado,
        "eliminar" => $eliminar,
      ];
    $agregar_estado = estadoModelo::agregar_estado_modelo($datos_estado_registro);
    if ($agregar_estado->rowCount() == 1) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Estado agregado",
          "Texto" => "Los datos del estado han sido agregados",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "info",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No se ha podido agregar el estado",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*--------- mostrar datos contenedor verde ---------*/
  public function mostrar_datosEstado_controlador()
  {
    $mostrarDatosEstado = "";
    $consulta = "SELECT * FROM estados WHERE eliminar=0 ORDER BY estado ASC";
    $conexion = mainModel::conectar();
    $datosEstado = $conexion->query($consulta);
    $datosEstado = $datosEstado->fetchAll();
    foreach ($datosEstado as $estado) {
      $mostrarDatosEstado .= '
        <div class="col-md-5 listarContenedor" style="margin-left: 25px">
          <scan style="padding:2px;padding-left:10px;">' . $estado['estado'] . '</scan>
          <div style="margin-left:auto;padding-right:20px;display:flex">
            <a type="submit" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;padding-top:2px" data-target="#myModalProyecto' . $estado['id_estado'] . '"> <i style="padding-right:0;color:white" class="fa-solid fa-pen-to-square"></i></a>
            <div id="myModalProyecto' . $estado['id_estado'] . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalProyectoLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalProyectoLabel">Modificar Estado</h4>
                  </div>
                  <form class="FormularioAjax" action="' . SERVERURL . 'ajax/estadoAjax.php" id="formularioRequerimiento" method="POST" data-form="update" autocomplete="off">
                    <input type="hidden" name="id_estado_up" id="id_estado_up" value="' . $estado['id_estado'] . '">
                    <div class="modal-body">
                      <div class="text-center" style="padding-bottom:20px">
                        <label style="display:block;color:black" for="estado_up">Nombre del estado</label>
                        <input type="text" style="text-align:center" id="estado_up" name="estado_up" value="' . $estado['estado'] . '" class="form-control" style="width: 60%;text-align:center;">
                      </div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-default waves-effect" style="border-radius:6px" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="botonModalModificar">Modificar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <form class="FormularioAjax" action="' . SERVERURL . 'ajax/estadoAjax.php" method="POST" data-form="delete" autocomplete="off">
              <input type="hidden" name="id_estado_de" id="id_estado_de" value="' . $estado['id_estado'] . '">
              <button type="submit" style="background:transparent;border:none"><i style="padding-right:0;color:white" class="fa-solid fa-trash-can"></i></button>
            </form>
          </div>
        </div>';
    }
    return $mostrarDatosEstado;
  }
  /*---------- actualizar Estado ----------*/
  public function actualizar_estado_controlador()
  {
    $estado = mainModel::limpiar_cadena($_POST['estado_up']);
    //recibir el id
    $id_estado = mainModel::limpiar_cadena($_POST['id_estado_up']);
    // preparacion para envio de datos
    $datos_actualizar_estado =
      [
        "estado" => $estado,
        "id_estado" => $id_estado
      ];
    if (estadoModelo::actualizar_estado_modelo($datos_actualizar_estado)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Datos Actualizados",
          "Texto" => "Estado actualizado exitosamente",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No hemos podido actualizar el estado, por favor intente nuevamente",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*---------- eliminar Estado ----------*/
  public function eliminar_estado_controlador()
  {
    $eliminar = 1;
    $fecha_eliminado = date("Y-m-d H:i:s");
    //recibir el id
    $id_estado = mainModel::limpiar_cadena($_POST['id_estado_de']);
    // preparacion para envio de datos
    $datos_eliminar_estado =
      [
        "eliminar" => $eliminar,
        "fecha_eliminado" => $fecha_eliminado,
        "id_estado" => $id_estado
      ];
    if (estadoModelo::eliminar_estado_modelo($datos_eliminar_estado)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Texto" => "Estado eliminado exitosamente",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No hemos podido eliminar el estado, por favor intente nuevamente",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
}
