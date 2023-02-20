<?php

if ($peticionAjax) {
  require_once "../modelos/administradorModelo.php";
} else {
  require_once "./modelos/administradorModelo.php";
}
class administradorControlador extends administradorModelo
{
  /*--------- mostrar datos contenedor check ---------*/
  public function mostrar_datosPermisosRol_controlador()
  {
    $mostrarDatosPermisosRoles = "";
    $consulta = "SELECT * FROM permisos";
    $conexion = mainModel::conectar();
    $datosPermisosRoles = $conexion->query($consulta);
    $datosPermisosRoles = $datosPermisosRoles->fetchAll();
    foreach ($datosPermisosRoles as $permisos) {
      $mostrarDatosPermisosRoles .= '
          <div class="col-md-4">
            <div class="container" style="width: 300px;">
              <label class="option_item" title="' . $permisos['permiso'] . '">
                <input type="checkbox" class="checkbox" value="' . $permisos['id_permiso'] . '" name="id_permiso_rol[]" id="id_permiso_rol[]" style="opacity: 0;">
                <div class="option_inner">
                  <div class="tickmark"></div>
                  <div class="name">' . $permisos['descripcion_permiso'] . '</div>
                </div>
              </label>
            </div>
          </div>
        ';
    }
    return $mostrarDatosPermisosRoles;
  }
  /*--------- agregar rol ---------*/
  public function agregar_roles_controlador()
  {
    // $rol_id = mainModel::ejecutar_consulta_simple("SELECT nombre_rol FROM roles");
    // $rol_id = ($rol_id->rowCount()) + 1;
    // $id_rol = $rol_id;

    $correlativoROL = mainModel::ejecutar_consulta_simple("SELECT nombre_rol FROM roles");
    $correlativoROL = ($correlativoROL->rowCount()) + 1;
    $id_rol = $correlativoROL;
    // $id_rol = 98;
    $nombre_rol = mainModel::limpiar_cadena($_POST['nombre_rol_ag']);
    $eliminar = 0;
    $permisos = $_POST['id_permiso_rol'];
    /*=== comprobar estado vacios ===*/
    if ($nombre_rol == "") {
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
    $check_roles = mainModel::ejecutar_consulta_simple("SELECT roles FROM nombre_rol WHERE nombre_rol='$nombre_rol'");
    if ($check_roles->rowCount() > 0) {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "info",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "Categoría existente",
          "Tipo" => "error"
        ];
      echo json_encode($alerta);
      exit();
    }
    // $datos_rol_registro =
    //   [
    //     "id_rol" => $id_rol,
    //     "nombre_rol" => $nombre_rol,
    //     "eliminar" => $eliminar,
    //   ];
    $agregar_rol = administradorModelo::agregar_rol_modelo($id_rol, $nombre_rol, $eliminar);
    for ($i = 0, $size = count($permisos); $i < $size; ++$i) {
      $arreglo_rol_permiso[$i] = $id_rol;
    }
    foreach ($permisos as $permisosRoles) {
      foreach ($arreglo_rol_permiso as $rolesPivote) {
      }
      $permisos_roles = administradorModelo::agregar_permisos_modelo($permisosRoles, $rolesPivote);
    }
    if ($agregar_rol->rowCount() == 1) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Rol agregado",
          "Texto" => "Los datos del rol han sido agregados",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "info",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No se ha podido agregar el rol",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*--------- mostrar datos contenedor verde ---------*/
  public function mostrar_datosRol_controlador()
  {
    $mostrarDatosRoles = "";
    $consulta = "SELECT * FROM roles WHERE eliminar=0";
    $conexion = mainModel::conectar();
    $datosRoles = $conexion->query($consulta);
    $datosRoles = $datosRoles->fetchAll();
    foreach ($datosRoles as $rol) {
      $mostrarDatosRoles .= '
        <div class="col-md-3 listarContenedor" style="padding-top:5px">
            <div class="col-md-9" style="text-align:left;">
              <scan>' . $rol['nombre_rol'] . '</scan>
            </div>
            <div class="col-md-3">
              <form class="FormularioAjax" action="' . SERVERURL . 'ajax/rolesAjax.php" method="POST" data-form="delete" autocomplete="off" >
                <input type="hidden" name="id_pivote_permiso_de" id="id_pivote_permiso_de" value="' . $rol['id_rol'] . '">
                <button type="submit" style="background:transparent;border:none"><i style="color:white" class="fa-solid fa-trash-can"></i></button>
              </form>
            </div>
        </div>
            ';
    }
    return $mostrarDatosRoles;
  }
  /*--------- eliminar rol y permiso ---------*/
  public function eliminar_rol_permiso_controlador()
  {
    $id_rol = mainModel::limpiar_cadena($_POST['id_pivote_permiso_de']);
    $eliminar_permisos_rol = administradorModelo::eliminar_modelo($id_rol);
    $eliminar = 1;
    $fecha_eliminado = date("Y-m-d H:i:s");
    $datos_eliminar_rol =
    [
      "eliminar" => $eliminar,
      "fecha_eliminado" => $fecha_eliminado,
      "id_rol" => $id_rol
    ];
    $eliminar_modificar_rol = administradorModelo::eliminar_rol_modelo($datos_eliminar_rol);
    // var_dump($eliminar_permisos_rol);
    if ($eliminar_modificar_rol->rowCount() == 1) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Rol eliminado",
          "Texto" => "Los datos del rol han sido eliminados",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "info",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No se ha podido eliminar el rol",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
}
