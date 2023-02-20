<?php

if ($peticionAjax) {
  require_once "../modelos/IdentificacionModelo.php";
} else {
  require_once "./modelos/IdentificacionModelo.php";
}
class IdentificacionControlador extends IdentificacionModelo
{
  /*--------- agregar identificacion ---------*/
  public function agregar_identificacion_controlador()
  {
    $tipo_identificacion = $_POST['tipo_identificacion'];
    $eliminar = 0;
    /*=== comprobar estado vacios ===*/
    if ($tipo_identificacion == "") {
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
    $agregar_identificacion  = IdentificacionModelo::agregar_identificacion_modelo($tipo_identificacion, $eliminar);
    if ($agregar_identificacion->rowCount() == 1) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Tipo de identificación agregado",
          "Texto" => "Los datos del tipo de identificación han sido agregados",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "info",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No se ha podido agregar el tipo de identificación",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*--------- mostrar datos contenedor verde ---------*/
  public function mostrar_datosIdentificacion_controlador()
  {
    $mostrarDatosIdentificacion = "";
    $consulta = "SELECT * FROM tipo_identificaciones WHERE eliminar = 0 ORDER BY tipo_identificacion ASC";
    $conexion = mainModel::conectar();
    $datosIdentificacion = $conexion->query($consulta);
    $datosIdentificacion = $datosIdentificacion->fetchAll();
    foreach ($datosIdentificacion as $identificacion) {
      $mostrarDatosIdentificacion .= '
        <div class="col-md-5 listarContenedor" style="margin-left: 25px">
          <scan style="padding:2px;padding-left:10px;">' . $identificacion['tipo_identificacion'] . '</scan>
          <div style="margin-left:auto;padding-right:20px;display:flex">
            <a type="submit" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;padding-top:2px" data-target="#myModalProyecto' . $identificacion['id_tipo_identificacion'] . '"> <i style="padding-right:0;color:white" class="fa-solid fa-pen-to-square"></i></a>
            <div id="myModalProyecto' . $identificacion['id_tipo_identificacion'] . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalProyectoLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalProyectoLabel">Modificar Tipo de Identificacion</h4>
                  </div>
                  <form class="FormularioAjax" action="' . SERVERURL . 'ajax/identificacionAjax.php" id="formularioRequerimiento" method="POST" data-form="update" autocomplete="off">
                    <input type="hidden" name="id_tipo_identificacion_up" id="id_tipo_identificacion_up" value="' . $identificacion['id_tipo_identificacion'] . '">
                      <div class="modal-body">
                        <div class="text-center" style="padding-bottom:20px">
                          <label style="display:block;color:black" for="tipo_identificacion_up">Nombre del tipo de documento</label>
                          <input type="text" style="text-align:center" id="tipo_identificacion_up" name="tipo_identificacion_up" value="' . $identificacion['tipo_identificacion'] . '" class="form-control" style="width: 60%;text-align:center;">
                        </div>
                      </div>
                      <div class="modal-footer"><button type="button" class="btn btn-default waves-effect" style="border-radius:6px" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="botonModalModificar">Modificar</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
            <form class="FormularioAjax" action="' . SERVERURL . 'ajax/identificacionAjax.php" method="POST" data-form="delete" autocomplete="off">
              <input type="hidden" name="id_tipo_identificacion_de" id="id_tipo_identificacion_de" value="' . $identificacion['id_tipo_identificacion'] . '">
              <button type="submit" style="background:transparent;border:none"><i style="padding-right:0;color:white" class="fa-solid fa-trash-can"></i></button>
            </form>
          </div>
        </div>
          ';
    }
    return $mostrarDatosIdentificacion;
  }
  /*---------- actualizar identificacion ----------*/
  public function actualizar_identificacion_controlador()
  {
    //recibir el id
    $tipo_identificacion = mainModel::limpiar_cadena($_POST['tipo_identificacion_up']);
    $id_tipo_identificacion = mainModel::limpiar_cadena($_POST['id_tipo_identificacion_up']);

    if (IdentificacionModelo::actualizar_identificacion_modelo($tipo_identificacion, $id_tipo_identificacion)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Datos Actualizados",
          "Texto" => "Cliente actualizado exitosamente",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No hemos podido actualizar el cliente, por favor intente nuevamente",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*---------- eliminar identificacion ----------*/
  public function eliminar_identificacion_controlador()
  {
    $eliminar = 1;
    $fecha_eliminado = date("Y-m-d H:i:s");
    //recibir el id
    $id_tipo_identificacion  = mainModel::limpiar_cadena($_POST['id_tipo_identificacion_de']);
    // preparacion para envio de datos
    $datos_eliminar_identificacion  =
      [
        "eliminar" => $eliminar,
        "fecha_eliminado" => $fecha_eliminado,
        "id_tipo_identificacion" => $id_tipo_identificacion
      ];
    if (IdentificacionModelo::eliminar_identificacion_modelo($datos_eliminar_identificacion)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Texto" => "Cliente eliminado exitosamente",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No hemos podido eliminar el cliente, por favor intente nuevamente",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
}
