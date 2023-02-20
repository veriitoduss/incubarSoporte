<?php

if ($peticionAjax) {
  require_once "../modelos/agenteModelo.php";
} else {
  require_once "./modelos/agenteModelo.php";
}
class agenteControlador extends agenteModelo
{
  /*--------- agregar agentes ---------*/
  public function agregar_agente_controlador()
  {
    $nombre_agente = $_POST['nombre_agente'];
    $agenteNombre   = preg_replace('/[ <>\'\"]/', '', $nombre_agente);
    $correo_agente = $_POST['correo_agente'];
    $charPass = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $contra = '';
    for ($i = 0; $i < 8; $i++) {
      $contra .= $charPass[mt_rand(0, strlen($charPass) - 1)];
    }
    $usuario_agente = $agenteNombre;
    $contrasena_agente = $contra;
    $id_rol = $_POST['id_rol'];
    $eliminar = 0;

    /*=== comprobar estado vacios ===*/
    if ($nombre_agente == "") {
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
    $check_agente = mainModel::ejecutar_consulta_simple("SELECT agentes FROM nombre_agente WHERE nombre_agente='$nombre_agente'");
    if ($check_agente->rowCount() > 0) {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "info",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "Agente existente",
          "Tipo" => "error"
        ];
      echo json_encode($alerta);
      exit();
    }
    $agregar_agente = agenteModelo::agregar_agente_modelo($nombre_agente, $correo_agente, $usuario_agente, $contrasena_agente, $id_rol, $eliminar);
    if ($agregar_agente->rowCount() == 1) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Agente agregado",
          "Texto" => "Los datos del agente han sido agregados",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "info",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No se ha podido agregar el agente",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*--------- mostrar datos input ---------*/
  public function mostrar_datosRoles_input_controlador()
  {
    $mostrarDatosRoles = "";
    $consulta = "SELECT * FROM roles WHERE eliminar = 0 ORDER BY nombre_rol ASC";
    $conexion = mainModel::conectar();
    $datosRoles = $conexion->query($consulta);
    $datosRoles = $datosRoles->fetchAll();
    $mostrarDatosRoles .= '
      <select required class="form-control" name="id_rol" id="id_rol" require>
        <option></option>';
        foreach ($datosRoles as $roles) {
          $mostrarDatosRoles .= '
            <option value="' . $roles['id_rol'] . '">' . $roles['nombre_rol'] . '
            </option>
          ';
        }
      $mostrarDatosRoles .= '
      </select>';
    return $mostrarDatosRoles;
  }
  /*--------- mostrar datos tabla ---------*/
  public function mostrar_datosAgentes_controlador($pagina, $url)
  {
    $pagina = mainModel::limpiar_cadena($pagina);
    $registros = 100000;
    $url = mainModel::limpiar_cadena($url);
    $url = SERVERURL . $url . "/";
    $mostrarDatosAgentes = "";
    $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
    $consulta = "SELECT a.id_agente,a.nombre_agente, a.correo_agente,a.usuario_agente, r.nombre_rol, r.id_rol FROM agentes a, roles r WHERE a.id_rol=r.id_rol AND a.eliminar=0 ORDER BY nombre_agente ASC";
    $conexion = mainModel::conectar();
    $datosAgentes = $conexion->query($consulta);
    $datosAgentes = $datosAgentes->fetchAll();
    $total = $conexion->query("SELECT FOUND_ROWS()");
    $total = (int) $total->fetchColumn();
    $Npaginas = ceil($total / $registros);



    $mostrarDatosAgentes .= '
      <div class="panel-body">
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre agente</th>
              <th>Email</th>
              <th>Usuario</th>
              <th>Rol</th>
              <th>Modificar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>';
          if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            foreach ($datosAgentes as $agente) {
              $id_rolConsulta=$agente['id_rol'];
              $consultaRol = "SELECT * FROM roles WHERE eliminar = 0 AND id_rol!=$id_rolConsulta";
              $conexionRol = mainModel::conectar();
              $datosRoles = $conexionRol->query($consultaRol);
              $datosRoles = $datosRoles->fetchAll();

              $mostrarDatosAgentes .= '
                <tr>
                <td>' . $contador . '</td>
                <td>' . $agente['nombre_agente'] . '</td>
                <td>' . $agente['correo_agente'] . '</td>
                <td>' . $agente['usuario_agente'] . '</td>
                <td>' . $agente['nombre_rol'] . '</td>
                <td style="text-align:center;">
                  <a type="button" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;" data-target="#myModalProyecto' . $agente['id_agente'] . '"> <i style="padding-right:0" class="fa-solid fa-pen-to-square"></i></a>
                  <div id="myModalProyecto' . $agente['id_agente'] . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalProyectoLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalProyectoLabel">Modificar Agente</h4>
                        </div>
                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/agenteAjax.php" id="formularioRequerimiento" method="POST" data-form="update" autocomplete="off">
                          <input type="hidden" name="id_agente_up" id="id_agente_up" value="' . $agente['id_agente'] . '">
                          <div class="modal-body">
                            <div class="text-center" style="padding-bottom:20px">
                              <label style="display:block" for="nombre_agente_up">Nombre del agente</label>
                              <input type="text" style="text-align:center;width:98%" id="nombre_agente_up" name="nombre_agente_up" value="' . $agente['nombre_agente'] . '" class="form-control">
                            </div>
                            <div class="text-center" style="padding-bottom:20px">
                              <label style="display:block" for="correo_agente_up">Correo del agente</label>
                              <input type="text" style="text-align:center;width:98%" id="correo_agente_up" name="correo_agente_up" value="' . $agente['correo_agente'] . '" class="form-control">
                            </div>
                            <div class="text-center" style="padding-bottom:20px">
                              <label style="display:block" for="usuario_agente_up">Usuario del agente</label>
                              <input type="text" style="text-align:center;width:98%" id="usuario_agente_up" name="usuario_agente_up" value="' . $agente['usuario_agente'] . '" class="form-control">
                            </div>
                            <div class="text-center" style="padding-bottom:20px">
                              <label style="display:block" for="id_rol_up">Rol: </label>
                              <select style="text-align:center;width:98% " class="form-control" name="id_rol_up" id="id_rol_up">
                              <option value="' . $agente['id_rol'] . '">' . $agente['nombre_rol'] . '</option>';
                                foreach ($datosRoles as $roles) {
                                  $mostrarDatosAgentes .= '
                                    <option value="' . $roles['id_rol'] . '">' . $roles['nombre_rol'] . '</option>';
                                }
                              $mostrarDatosAgentes .= '
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
                  <form class="FormularioAjax" action="' . SERVERURL . 'ajax/agenteAjax.php" method="POST" data-form="delete" autocomplete="off">
                    <input type="hidden" name="id_agente_de" id="id_agente_de" value="' . $agente['id_agente'] . '">
                    <button type="submit" style="background:transparent;border:none"><i style="padding-right:0;color:red" class="fa-solid fa-trash-can"></i></button>
                  </form>
                </td>';
              $contador++;
            }
          }
          else
          {
            if ($total >= 1) {
              $mostrarDatosAgentes .= '<tr><td colspan="4">
                <a href="' . $url . '"> haga click para recargar el listado</a>
                </td></tr>';
              } else {
              $mostrarDatosAgentes .= '<tr><td colspan="4">
                No hay registros en el sistema
                </td></tr>';
              }
              $mostrarDatosAgentes .= '</tbody></table></div>';
          }
    $mostrarDatosAgentes .= '</tbody></table></div>';
    return $mostrarDatosAgentes;
  }
  /*---------- actualizar Agente ----------*/
  public function actualizar_agente_controlador()
  {
    //recibir el id
    $id_agente = mainModel::limpiar_cadena($_POST['id_agente_up']);
    $check_agente_actualizar = mainModel::ejecutar_consulta_simple("SELECT * FROM agentes WHERE id_agente='$id_agente'");
    if ($check_agente_actualizar->rowCount() <= 0) {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No hemos encontrado el agente",
          "Tipo" => "error"
        ];
      echo json_encode($alerta);
      exit();
    } else {
      $campos = $check_agente_actualizar->fetch();
    }
    $nombre_agente = mainModel::limpiar_cadena($_POST['nombre_agente_up']);
    // $id_proyecto = mainModel::limpiar_cadena($_POST['id_proyecto_up']);

    if (isset($_POST['id_rol_up'])) {
      $id_rol = mainModel::limpiar_cadena($_POST['id_rol_up']);
    } else {
      $id_rol = $campos['id_rol'];
    }
    $correo_agente = mainModel::limpiar_cadena($_POST['correo_agente_up']);
    $usuario_agente = mainModel::limpiar_cadena($_POST['usuario_agente_up']);
    // preparacion para envio de datos
    $datos_actualizar_agente =
      [
        "nombre_agente" => $nombre_agente,
        "correo_agente" => $correo_agente,
        "usuario_agente" => $usuario_agente,
        "id_rol" => $id_rol,
        "id_agente" => $id_agente
      ];
    if (agenteModelo::actualizar_agente_modelo($datos_actualizar_agente)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Datos Actualizados",
          "Texto" => "Agente actualizado exitosamente",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No hemos podido actualizar el agente, por favor intente nuevamente",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*---------- eliminar Agente ----------*/
  public function eliminar_agente_controlador()
  {
    $eliminar = 1;
    $fecha_eliminado = date("Y-m-d H:i:s");
    //recibir el id
    $id_agente = mainModel::limpiar_cadena($_POST['id_agente_de']);
    // preparacion para envio de datos
    $datos_eliminar_agente =
      [
        "eliminar" => $eliminar,
        "fecha_eliminado" => $fecha_eliminado,
        "id_agente" => $id_agente
      ];
    if (agenteModelo::eliminar_agente_modelo($datos_eliminar_agente)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Texto" => "Agente eliminado exitosamente",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No hemos podido eliminar el agente, por favor intente nuevamente",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
}
