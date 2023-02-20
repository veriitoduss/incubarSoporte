<?php

if ($peticionAjax) {
  require_once "../modelos/requerimientoModelo.php";
} else {
  require_once "./modelos/requerimientoModelo.php";
}
class requerimientoControlador extends requerimientoModelo
{

  /*---------- agregar Requerimiento ----------*/
  public function agregar_requerimiento_controlador()
  {
    $tipo_requerimiento = mainModel::limpiar_cadena($_POST['tipo_requerimiento']);
    $eliminar = 0;

    /*=== comprobar campos vacios ===*/
    if ($tipo_requerimiento == "") {
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
    $check_requerimiento = mainModel::ejecutar_consulta_simple("SELECT tipo_requerimiento FROM tipo_requerimientos WHERE tipo_requerimiento='$tipo_requerimiento'");
    if ($check_requerimiento->rowCount() > 0) {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "info",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "Requerimiento existente",
          "Tipo" => "error"
        ];
      echo json_encode($alerta);
      exit();
    }
    $datos_requerimiento_registro =
      [
        "tipo_requerimiento" => $tipo_requerimiento,
        "eliminar" => $eliminar,
      ];
    $agregar_requerimiento = requerimientoModelo::agregar_requerimiento_modelo($datos_requerimiento_registro);
    if ($agregar_requerimiento->rowCount() == 1) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Requerimiento agregado",
          "Texto" => "Los datos del requerimiento han sido agregados",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "info",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No se ha podido agregar el requerimiento",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*---------- mostrar datos contenedor verde ----------*/
  public function mostrar_datosRequerimiento_controlador()
  {
    $mostrarDatosRequerimiento = "";
    $consulta = "SELECT * FROM tipo_requerimientos WHERE eliminar=0 ORDER BY tipo_requerimiento ASC";
    $conexion = mainModel::conectar();
    $datosRequerimiento = $conexion->query($consulta);
    $datosRequerimiento = $datosRequerimiento->fetchAll();
    foreach ($datosRequerimiento as $requerimiento) {
      $mostrarDatosRequerimiento .= '
        <div class="col-md-5 listarContenedor" style="margin-left: 25px; padding-top:3px;padding-bottom:-1px">
          <scan style="padding:2px;padding-left:10px;">' . $requerimiento['tipo_requerimiento'] . '</scan>
          <div style="margin-left:auto;padding-right:20px;display:flex">
            <a type="submit" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;padding-top:2px" data-target="#myModalProyecto' . $requerimiento['id_tipo_requerimiento'] . '"> <i style="padding-right:0;color:white" class="fa-solid fa-pen-to-square"></i></a>
              <div id="myModalProyecto' . $requerimiento['id_tipo_requerimiento'] . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalProyectoLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalProyectoLabel">Modificar Requerimiento</h4>
                    </div>
                    <form class="FormularioAjax" action="' . SERVERURL . 'ajax/requerimientoAjax.php" id="formularioRequerimiento" method="POST" data-form="update" autocomplete="off">
                      <input type="hidden" name="id_tipo_requerimiento_up" id="id_tipo_requerimiento_up" value="' . $requerimiento['id_tipo_requerimiento'] . '">
                      <div class="modal-body">
                        <div class="text-center" style="padding-bottom:20px">
                          <label style="display:block;color:black" for="tipo_requerimiento_up">Nombre del requerimiento</label>
                          <input type="text" style="text-align:center" id="tipo_requerimiento_up" name="tipo_requerimiento_up" value="' . $requerimiento['tipo_requerimiento'] . '" class="form-control" style="width: 60%;text-align:center;">
                        </div>
                      </div>
                      <div class="modal-footer"><button type="button" class="btn btn-default waves-effect" style="border-radius:6px" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="botonModalModificar">Modificar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <form class="FormularioAjax" action="' . SERVERURL . 'ajax/requerimientoAjax.php" method="POST" data-form="delete" autocomplete="off">
                <input type="hidden" name="id_tipo_requerimiento_de" id="id_tipo_requerimiento_de" value="' . $requerimiento['id_tipo_requerimiento'] . '">
                <button type="submit" style="background:transparent;border:none"><i style="padding-right:0;color:white" class="fa-solid fa-trash-can"></i></button>
              </form>
          </div>
        </div>
        ';
    }
    return $mostrarDatosRequerimiento;
  }
  /*---------- actualizar Requerimiento ----------*/
  public function actualizar_requerimiento_controlador()
  {
    $tipo_requerimiento = mainModel::limpiar_cadena($_POST['tipo_requerimiento_up']);
    //recibir el id
    $id_requerimiento = mainModel::limpiar_cadena($_POST['id_tipo_requerimiento_up']);
    // preparacion para envio de datos
    $datos_actualizar_requerimiento =
      [
        "tipo_requerimiento" => $tipo_requerimiento,
        "id_tipo_requerimiento" => $id_requerimiento
      ];
    if (requerimientoModelo::actualizar_requerimiento_modelo($datos_actualizar_requerimiento)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Datos Actualizados",
          "Texto" => "Requerimiento actualizado exitosamente",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No hemos podido actualizar el requerimiento, por favor intente nuevamente",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*---------- eliminar Requerimiento ----------*/
  public function eliminar_requerimiento_controlador()
  {
    $eliminar = 1;
    $fecha_eliminado = date("Y-m-d H:i:s");
    //recibir el id
    $id_requerimiento = mainModel::limpiar_cadena($_POST['id_tipo_requerimiento_de']);
    // preparacion para envio de datos
    $datos_eliminar_requerimiento =
      [
        "eliminar" => $eliminar,
        "fecha_eliminado" => $fecha_eliminado,
        "id_tipo_requerimiento" => $id_requerimiento
      ];
    if (requerimientoModelo::eliminar_requerimiento_modelo($datos_eliminar_requerimiento)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Texto" => "Requerimiento eliminado exitosamente",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No hemos podido eliminar el requerimiento, por favor intente nuevamente",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
}
