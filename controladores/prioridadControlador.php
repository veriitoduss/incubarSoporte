<?php

if ($peticionAjax) {
  require_once "../modelos/prioridadModelo.php";
} else {
  require_once "./modelos/prioridadModelo.php";
}
class prioridadControlador extends prioridadModelo
{
  /*--------- agregar prioridades ---------*/
  public function agregar_prioridad_controlador()
  {
    $nombre_prioridad = mainModel::limpiar_cadena($_POST['nombre_prioridad']);
    $id_proyecto = mainModel::limpiar_cadena($_POST['id_proyecto']);
    $eliminar = 0;

    /*=== comprobar campos vacios ===*/
    if ($nombre_prioridad == "" || $id_proyecto == "") {
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
    $check_prioridad = mainModel::ejecutar_consulta_simple("SELECT nombre_prioridad FROM prioridades WHERE nombre_prioridad='$nombre_prioridad'");
    $datos_prioridad_registro =
      [
        "nombre_prioridad" => $nombre_prioridad,
        "id_proyecto" => $id_proyecto,
        "eliminar" => $eliminar,
      ];
    $agregar_prioridad = prioridadModelo::agregar_prioridad_modelo($datos_prioridad_registro);
    if ($agregar_prioridad->rowCount() == 1) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Prioridad agregada",
          "Texto" => "Los datos de la prioridad han sido agregados",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "info",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No se ha podido agregar la prioridad",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*--------- mostrar datos input ---------*/
  public function mostrar_datosproyecto_input_controlador()
  {
    $mostrarDatosProyecto = "";
    $consulta = "SELECT * FROM proyectos WHERE eliminar = 0 ORDER BY nombre_proyecto ASC";
    $conexion = mainModel::conectar();
    $datosProyecto = $conexion->query($consulta);
    $datosProyecto = $datosProyecto->fetchAll();
    $mostrarDatosProyecto .= '
      <select required class="form-control" name="id_proyecto" id="id_proyecto">
        <option></option>';
        foreach ($datosProyecto as $proyecto) {
          $mostrarDatosProyecto .= '
            <option value="' . $proyecto['id_proyecto'] . '">' . $proyecto['nombre_proyecto'] . '</option>';
          }
      $mostrarDatosProyecto .= '
      </select>';
    return $mostrarDatosProyecto;
  }
  /*--------- mostrar datos tabla ---------*/
  public function mostrar_datosprioridades_controlador($pagina, $url)
  {
    $pagina = mainModel::limpiar_cadena($pagina);
    $registros = 100000;
    $url = mainModel::limpiar_cadena($url);
    $url = SERVERURL . $url . "/";
    $mostrarDatosPrioridad = "";
    $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
    $consulta = "SELECT p.id_proyecto,pr.id_prioridad,pr.nombre_prioridad, p.nombre_proyecto FROM prioridades pr, proyectos p WHERE pr.id_proyecto=p.id_proyecto AND pr.eliminar=0 ORDER BY nombre_prioridad ASC";
    $conexion = mainModel::conectar();
    $datosPrioridad = $conexion->query($consulta);
    $datosPrioridad = $datosPrioridad->fetchAll();
    $total = $conexion->query("SELECT FOUND_ROWS()");
    $total = (int) $total->fetchColumn();
    $Npaginas = ceil($total / $registros);

    $mostrarDatosPrioridad .= '
      <div class="panel-body">
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre prioridad</th>
              <th>proyecto</th>
              <th>Modificar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>';
            if ($total >= 1 && $pagina <= $Npaginas) {
              $contador = $inicio + 1;
              foreach ($datosPrioridad as $prioridad) {
                $id_proyecto_admin = $prioridad['id_proyecto'];
                $consultaProyecto = "SELECT * FROM proyectos WHERE id_proyecto!=$id_proyecto_admin";
                $conexionProyecto = mainModel::conectar();
                $datosProyecto = $conexionProyecto->query($consultaProyecto);
                $datosProyecto = $datosProyecto->fetchAll();
              $mostrarDatosPrioridad .= '
                <tr>
                  <td>' . $contador . '</td>
                  <td>' . $prioridad['nombre_prioridad'] . '</td>
                  <td>' . $prioridad['nombre_proyecto'] . '</td>
                  <td style="text-align:center;">
                    <a type="button" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;" data-target="#myModalProyecto' . $prioridad['id_prioridad'] . '"> <i style="padding-right:0" class="fa-solid fa-pen-to-square"></i></a>
                    <div id="myModalProyecto' . $prioridad['id_prioridad'] . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalProyectoLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="myModalProyectoLabel">Modificar Prioridad</h4>
                          </div>
                          <form class="FormularioAjax" action="' . SERVERURL . 'ajax/prioridadAjax.php" id="formularioRequerimiento" method="POST" data-form="update" autocomplete="off">
                            <input type="hidden" name="id_prioridad_up" id="id_prioridad_up" value="' . $prioridad['id_prioridad'] . '">
                            <div class="modal-body">
                              <div class="text-center" style="padding-bottom:20px">
                                <label style="display:block" for="nombre_prioridad_up">Nombre de la prioridad</label>
                                <input type="text" style="text-align:center;width:98%" id="nombre_prioridad_up" name="nombre_prioridad_up" value="' . $prioridad['nombre_prioridad'] . '" class="form-control">
                              </div>
                              <div class="text-center" style="padding-bottom:20px">
                                <label style="display:block" for="id_proyecto_up">Proyecto: </label>
                                <select style="text-align:center;width:98% " class="form-control" name="id_proyecto_up" id="id_proyecto_up">
                              <option value="' . $prioridad['id_proyecto'] . '">' . $prioridad['nombre_proyecto'] . '</option>';
                                  
                                foreach ($datosProyecto as $proyecto) {
                                    $mostrarDatosPrioridad .= '
                                      <option value="' . $proyecto['id_proyecto'] . '">' . $proyecto['nombre_proyecto'] . '</option>';
                                  }
                                $mostrarDatosPrioridad .= '
                                </select>
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
                    <form class="FormularioAjax" action="' . SERVERURL . 'ajax/prioridadAjax.php" method="POST" data-form="delete" autocomplete="off">
                      <input type="hidden" name="id_prioridad_de" id="id_prioridad_de" value="' . $prioridad['id_prioridad'] . '">
                      <button type="submit" style="background:transparent;border:none"><i style="padding-right:0;color:red" class="fa-solid fa-trash-can"></i></button>
                    </form>
                  </td>';
                  $contador++;
                }
            }
            else {
              if ($total >= 1) {
                  $mostrarDatosPrioridad .= '<tr><td colspan="4">
                    <a href="' . $url . '"> haga click para recargar el listado</a>
                    </td></tr>';
              } else {
                $mostrarDatosPrioridad .= '<tr><td colspan="4">
                  No hay registros en el sistema
                  </td></tr>';
              }
              $mostrarDatosPrioridad .= '</tbody></table></div>';
            }
      $mostrarDatosPrioridad .= '</tbody></table></div>';
    return $mostrarDatosPrioridad;
  }
  /*---------- actualizar Prioridad ----------*/
  public function actualizar_prioridad_controlador()
  {
    //recibir el id
    $id_prioridad = mainModel::limpiar_cadena($_POST['id_prioridad_up']);
    $check_prioridad_actualizar = mainModel::ejecutar_consulta_simple("SELECT * FROM prioridades WHERE id_prioridad='$id_prioridad'");
    if ($check_prioridad_actualizar->rowCount() <= 0) {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No hemos encontrado la prioridad",
          "Tipo" => "error"
        ];
      echo json_encode($alerta);
      exit();
    } else {
      $campos = $check_prioridad_actualizar->fetch();
    }
    $nombre_prioridad = mainModel::limpiar_cadena($_POST['nombre_prioridad_up']);
    // $id_proyecto = mainModel::limpiar_cadena($_POST['id_proyecto_up']);
    if (isset($_POST['id_proyecto_up'])) {
      $id_proyecto = mainModel::limpiar_cadena($_POST['id_proyecto_up']);
    } else {
      $id_proyecto = $campos['id_proyecto'];
    }

    // preparacion para envio de datos
    $datos_actualizar_prioridad =
      [
        "nombre_prioridad" => $nombre_prioridad,
        "id_proyecto" => $id_proyecto,
        "id_prioridad" => $id_prioridad
      ];
    if (prioridadModelo::actualizar_prioridad_modelo($datos_actualizar_prioridad)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Datos Actualizados",
          "Texto" => "Prioridad actualizada exitosamente",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No hemos podido actualizar la prioridad, por favor intente nuevamente",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*---------- eliminar prioridades ----------*/
  public function eliminar_prioridad_controlador()
  {
    $eliminar = 1;
    $fecha_eliminado = date("Y-m-d H:i:s");
    //recibir el id
    $id_prioridad = mainModel::limpiar_cadena($_POST['id_prioridad_de']);
    // preparacion para envio de datos
    $datos_eliminar_prioridad =
      [
        "eliminar" => $eliminar,
        "fecha_eliminado" => $fecha_eliminado,
        "id_prioridad" => $id_prioridad
      ];
    if (prioridadModelo::eliminar_prioridad_modelo($datos_eliminar_prioridad)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Texto" => "Prioridad eliminada exitosamente",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No hemos podido eliminar la prioridad, por favor intente nuevamente",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
}
