<?php

if ($peticionAjax) {
  require_once "../modelos/clienteModelo.php";
} else {
  require_once "./modelos/clienteModelo.php";
}
class clienteControlador extends clienteModelo
{
    /*--------- agregar clientes ---------*/
    public function agregar_cliente_controlador()
    {
      $nombre = $_POST['nombre_cliente'];
      $nombreCliente = chop($nombre);
      $nombre_cliente = nl2br($nombreCliente);
      $array_datos = explode("<br />", $nombre_cliente);
      $id_proyecto = $_POST['id_proyecto'];
      $IdentificadorProyecto = implode($id_proyecto);
      $eliminar = 0;
      /*=== comprobar estado vacios ===*/
      if ($nombre == "") {
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
      for ($i = 0, $size = count($array_datos); $i < $size; ++$i) {
        $dato_proyecto[$i] = $IdentificadorProyecto;
        $dato_Eliminar[$i] = $eliminar;
      }
      foreach ($array_datos as $clientes) {
        foreach ($dato_proyecto as $proyecto) {
        }
        foreach ($dato_Eliminar as $eliminacion) {
        }
        $agregar_cliente = clienteModelo::agregar_cliente_modelo($clientes, $proyecto, $eliminacion);
      }
      if ($agregar_cliente->rowCount() == 1) {
        $alerta =
          [
            "Alerta" => "recargar",
            "Icon" => "success",
            "Titulo" => "Cliente(s) agregado(s)",
            "Texto" => "Los datos han sido agregados",
            "Tipo" => "success"
          ];
      } else {
        $alerta =
          [
            "Alerta" => "simple",
            "Icon" => "info",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "No se ha podido agregar los datos",
            "Tipo" => "error"
          ];
      }
      echo json_encode($alerta);
    }
    /*--------- mostrar datos input ---------*/
    public function mostrar_datosproyectoCliente_input_controlador()
    {
      $mostrarDatosProyecto = "";
      $consulta = "SELECT * FROM proyectos WHERE eliminar = 0 ORDER BY nombre_proyecto ASC";
      $conexion = mainModel::conectar();
      $datosProyecto = $conexion->query($consulta);
      $datosProyecto = $datosProyecto->fetchAll();
      $mostrarDatosProyecto .= '
        <option></option>';
      foreach ($datosProyecto as $proyecto) {
        $mostrarDatosProyecto .= '
            <option value="' . $proyecto['id_proyecto'] . '">' . $proyecto['nombre_proyecto'] . '</option>';
      }
      return $mostrarDatosProyecto;
    }
    /*--------- mostrar datos tabla ---------*/
    public function mostrar_datosclientes_controlador($pagina, $url)
    {
      $pagina = mainModel::limpiar_cadena($pagina);
      $registros = 100000;
      $url = mainModel::limpiar_cadena($url);
      $url = SERVERURL . $url . "/";
      $mostrarDatosCliente = "";
      $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
      $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
      $consulta = "SELECT c.id_cliente,c.nombre_cliente, p.nombre_proyecto,p.id_proyecto FROM clientes c, proyectos p WHERE c.id_proyecto=p.id_proyecto AND c.eliminar=0 ORDER BY nombre_cliente ASC";
      $conexion = mainModel::conectar();
      $datosCliente = $conexion->query($consulta);
      $datosCliente = $datosCliente->fetchAll();
      $total = $conexion->query("SELECT FOUND_ROWS()");
      $total = (int) $total->fetchColumn();
      $Npaginas = ceil($total / $registros);
      $mostrarDatosCliente .= '
            <div class="panel-body">
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre cliente</th>
                    <th>proyecto</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                  </tr>
                </thead>
                <tbody>';
      if ($total >= 1 && $pagina <= $Npaginas) {
        $contador = $inicio + 1;
        foreach ($datosCliente as $cliente) {
          $id_proyecto_admin=$cliente['id_proyecto'];
          $consultaProyecto = "SELECT * FROM proyectos WHERE id_proyecto!=$id_proyecto_admin";
          $conexionProyecto = mainModel::conectar();
          $datosProyecto = $conexionProyecto->query($consultaProyecto);
          $datosProyecto = $datosProyecto->fetchAll();
          $mostrarDatosCliente .= '
                    <tr>
                    <td>' . $contador . '</td>
                    <td>' . $cliente['nombre_cliente'] . '</td>
                    <td>' . $cliente['nombre_proyecto'] . '</td>
                    <td style="text-align:center;">
                      <a type="button" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;" data-target="#myModalProyecto' . $cliente['id_cliente'] . '"> <i style="padding-right:0" class="fa-solid fa-pen-to-square"></i></a>
                      <div id="myModalProyecto' . $cliente['id_cliente'] . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalProyectoLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalProyectoLabel">Modificar Cliente</h4>
                            </div>
                            <form class="FormularioAjax" action="' . SERVERURL . 'ajax/clienteAjax.php" id="formularioRequerimiento" method="POST" data-form="update" autocomplete="off">
                              <input type="hidden" name="id_cliente_up" id="id_cliente_up" value="' . $cliente['id_cliente'] . '">
                              <div class="modal-body">
                                <div class="text-center" style="padding-bottom:20px">
                                  <label style="display:block;" for="nombre_prioridad_up">Nombre del cliente</label>
                                  <input type="text" style="text-align:center;width: 98%" id="nombre_cliente_up" name="nombre_cliente_up" value="' . $cliente['nombre_cliente'] . '" class="form-control">
                                </div>
                                <div class="text-center" style="padding-bottom:20px">
                                  <label style="display:block" for="id_proyecto_up">Proyecto:</label>
                                  <select required style="width: 98%;text-align:center" class="form-control" name="id_proyecto_up" id="id_proyecto_up">
                              <option value="' . $cliente['id_proyecto'] . '">' . $cliente['nombre_proyecto'] . '</option>';

          foreach ($datosProyecto as $proyecto) {
            $mostrarDatosCliente .= '
                                              <option value="' . $proyecto['id_proyecto'] . '">' . $proyecto['nombre_proyecto'] . '</option>';
          }
          $mostrarDatosCliente .= '
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
                      <form class="FormularioAjax" action="' . SERVERURL . 'ajax/clienteAjax.php" method="POST" data-form="delete" autocomplete="off">
                      <input type="hidden" name="id_cliente_de" id="id_cliente_de" value="' . $cliente['id_cliente'] . '">
                      <button type="submit" style="background:transparent;border:none"><i style="padding-right:0;color:red" class="fa-solid fa-trash-can"></i></button>
                    </form>
                      </td>';
          $contador++;
        }
      } else {
        if ($total >= 1) {
          $mostrarDatosCliente .= '<tr><td colspan="4">
                <a href="' . $url . '"> haga click para recargar el listado</a>
                </td></tr>';
        } else {
          $mostrarDatosCliente .= '<tr><td colspan="4">
                No hay registros en el sistema
                </td></tr>';
        }
        $mostrarDatosCliente .= '</tbody></table></div>';
      }
      $mostrarDatosCliente .= '</tbody></table></div>';
      return $mostrarDatosCliente;
    }
    /*---------- actualizar Cliente ----------*/
    public function actualizar_cliente_controlador()
    {
      //recibir el id
      $id_cliente = mainModel::limpiar_cadena($_POST['id_cliente_up']);
      $check_cliente_actualizar = mainModel::ejecutar_consulta_simple("SELECT * FROM clientes WHERE id_cliente='$id_cliente'");
      if ($check_cliente_actualizar->rowCount() <= 0) {
        $alerta =
          [
            "Alerta" => "simple",
            "Icon" => "error",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "No hemos encontrado el cliente",
            "Tipo" => "error"
          ];
        echo json_encode($alerta);
        exit();
      } else {
        $campos = $check_cliente_actualizar->fetch();
      }
      $nombre_cliente = mainModel::limpiar_cadena($_POST['nombre_cliente_up']);
      // $id_proyecto = mainModel::limpiar_cadena($_POST['id_proyecto_up']);
      if (isset($_POST['id_proyecto_up'])) {
        $id_proyecto = mainModel::limpiar_cadena($_POST['id_proyecto_up']);
      } else {
        $id_proyecto = $campos['id_proyecto'];
      }

      // preparacion para envio de datos
      $datos_actualizar_cliente =
        [
          "nombre_cliente" => $nombre_cliente,
          "id_proyecto" => $id_proyecto,
          "id_cliente" => $id_cliente
        ];
      if (clienteModelo::actualizar_cliente_modelo($datos_actualizar_cliente)) {
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
    /*---------- eliminar Cliente ----------*/
    public function eliminar_cliente_controlador()
    {
      $eliminar = 1;
      $fecha_eliminado = date("Y-m-d H:i:s");
      //recibir el id
      $id_cliente = mainModel::limpiar_cadena($_POST['id_cliente_de']);
      // preparacion para envio de datos
      $datos_eliminar_cliente =
        [
          "eliminar" => $eliminar,
          "fecha_eliminado" => $fecha_eliminado,
          "id_cliente" => $id_cliente
        ];
      if (clienteModelo::eliminar_cliente_modelo($datos_eliminar_cliente)) {
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
