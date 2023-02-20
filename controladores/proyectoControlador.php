<?php

if ($peticionAjax) {
  require_once "../modelos/proyectoModelo.php";
} else {
  require_once "./modelos/proyectoModelo.php";
}
class proyectoControlador extends proyectoModelo
{
  /*---------- agregar proyectos ----------*/
  public function agregar_proyecto_controlador()
  {
    $nombre_proyecto = mainModel::limpiar_cadena($_POST['nombre_proyecto']);
    $identificador_proyecto = mainModel::limpiar_cadena($_POST['identificador_proyecto']);
    $eliminar = 0;

    /*=== comprobar campos vacios ===*/
    if ($nombre_proyecto == "" || $identificador_proyecto == "") {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No se han llenado todos los campos",
          "Tipo" => "error"
        ];
      echo json_encode($alerta);
      exit();
    }
    /*=== validacion existencia ===*/
    $check_proyecto = mainModel::ejecutar_consulta_simple("SELECT nombre_proyecto FROM proyectos WHERE nombre_proyecto='$nombre_proyecto'");
    if ($check_proyecto->rowCount() > 0) {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "info",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "El Proyecto existente",
          "Tipo" => "error"
        ];
      echo json_encode($alerta);
      exit();
    }
    $agregar_requerimiento = proyectoModelo::agregar_proyecto_modelo($nombre_proyecto, $identificador_proyecto, $eliminar);
    if ($agregar_requerimiento->rowCount() == 1) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Proyecto agregado",
          "Texto" => "Los datos del proyecto han sido agregados",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "info",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No se ha podido agregar el proyecto",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*--------- mostrar datos tabla ---------*/
  public function mostrar_datosproyectos_controlador($pagina, $url)
  {
    $pagina = mainModel::limpiar_cadena($pagina);
    $registros = 100000;
    $url = mainModel::limpiar_cadena($url);
    $url = SERVERURL . $url . "/";
    $mostrarDatosProyecto = "";
    $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
    $consulta = "SELECT * FROM proyectos WHERE eliminar = 0 ORDER BY nombre_proyecto ASC";
    $conexion = mainModel::conectar();
    $datosProyecto = $conexion->query($consulta);
    $datosProyecto = $datosProyecto->fetchAll();
    $total = $conexion->query("SELECT FOUND_ROWS()");
    $total = (int) $total->fetchColumn();
    $Npaginas = ceil($total / $registros);
    $mostrarDatosProyecto .= '
      <div class="panel-body">
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre Proyecto</th>
              <th>Identificador</th>
              <th>Modificar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>';
            if ($total >= 1 && $pagina <= $Npaginas) {
              $contador = $inicio + 1;
              foreach ($datosProyecto as $proyecto) {
                $mostrarDatosProyecto .= '
                  <tr>
                    <td>' . $contador . '</td>
                    <td>' . $proyecto['nombre_proyecto'] . '</td>
                    <td>' . $proyecto['identificador_proyecto'] . '</td>
                    <td style="text-align:center;">
                      <a type="button" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;" data-target="#myModalProyecto' . $proyecto['id_proyecto'] . '"> <i style="padding-right:0" class="fa-solid fa-pen-to-square"></i></a>
                      <div id="myModalProyecto' . $proyecto['id_proyecto'] . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalProyectoLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalProyectoLabel">Modificar Proyecto</h4>
                            </div>
                            <form class="FormularioAjax" action="' . SERVERURL . 'ajax/proyectoAjax.php" id="formularioRequerimiento" method="POST" data-form="update" autocomplete="off">
                              <input type="hidden" name="id_proyecto_up" id="id_proyecto_up" value="' . $proyecto['id_proyecto'] . '">
                                <div class="modal-body">
                                  <div class="text-center" style="padding-bottom:20px">
                                    <label style="display:block" for="nombre_proyecto_up">Nombre del proyecto</label>
                                    <input type="text" style="text-align:center" id="nombre_proyecto_up" name="nombre_proyecto_up" value="' . $proyecto['nombre_proyecto'] . '" class="form-control" style="width: 60%;text-align:center;">
                                  </div>
                                  <div class="text-center" style="padding-bottom:20px">
                                    <label style="display:block" for="identificador_proyecto_up">Nombre del proyecto</label>
                                    <input type="text" style="text-align:center" id="identificador_proyecto_up" name="identificador_proyecto_up" value="' . $proyecto['identificador_proyecto'] . '" class="form-control" style="width: 60%;text-align:center;">
                                  </div>
                                </div>
                                <div class="modal-footer"><button type="button" class="btn btn-default waves-effect" style="border-radius:6px" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="botonModalModificar">Modificar</button>
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <form class="FormularioAjax" action="' . SERVERURL . 'ajax/proyectoAjax.php" method="POST" data-form="delete" autocomplete="off">
                        <input type="hidden" name="id_proyecto_de" id="id_proyecto_de" value="' . $proyecto['id_proyecto'] . '">
                        <button type="submit" style="background:transparent;border:none"><i style="padding-right:0;color:red" class="fa-solid fa-trash-can"></i></button>
                      </form>
                    </td>';
                  $contador++;
              }
              }
              else {
                if ($total >= 1) {
                  $mostrarDatosProyecto .= '
                    <tr>
                      <td colspan="4">
                        <a href="' . $url . '"> haga click para recargar el listado</a>
                    </td></tr>';
              }
              else {
                $mostrarDatosProyecto .= '
                  <tr><td colspan="4">
                    No hay registros en el sistema
                  </td></tr>';
              }
              $mostrarDatosProyecto .= '</tbody></table></div>';
            }
    $mostrarDatosProyecto .= '</tbody></table></div>';
    return $mostrarDatosProyecto;
  }
  /*---------- actualizar Proyecto ----------*/
  public function actualizar_proyecto_controlador()
  {
    $nombre_proyecto = mainModel::limpiar_cadena($_POST['nombre_proyecto_up']);
    $identificador_proyecto = mainModel::limpiar_cadena($_POST['identificador_proyecto_up']);
    //recibir el id
    $id_proyecto = mainModel::limpiar_cadena($_POST['id_proyecto_up']);
    // preparacion para envio de datos
    $datos_actualizar_proyecto =
      [
        "nombre_proyecto" => $nombre_proyecto,
        "identificador_proyecto" => $identificador_proyecto,
        "id_proyecto" => $id_proyecto
      ];
    if (proyectoModelo::actualizar_proyecto_modelo($datos_actualizar_proyecto)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Datos Actualizados",
          "Texto" => "Proyecto actualizado exitosamente",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No hemos podido actualizar el proyecto, por favor intente nuevamente",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*---------- eliminar Proyecto ----------*/
  public function eliminar_proyecto_controlador()
  {
    $eliminar = 1;
    $fecha_eliminado = date("Y-m-d H:i:s");
    //recibir el id
    $id_proyecto = mainModel::limpiar_cadena($_POST['id_proyecto_de']);
    // preparacion para envio de datos
    $datos_eliminar_proyecto =
      [
        "eliminar" => $eliminar,
        "fecha_eliminado" => $fecha_eliminado,
        "id_proyecto" => $id_proyecto
      ];
    if (proyectoModelo::eliminar_proyecto_modelo($datos_eliminar_proyecto)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Texto" => "Proyecto eliminado exitosamente",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No hemos podido eliminar el proyecto, por favor intente nuevamente",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
}
