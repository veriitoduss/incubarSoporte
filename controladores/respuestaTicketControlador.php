<?php

if ($peticionAjax) {
  require_once "../modelos/respuestaTicketModelo.php";
} else {
  require_once "./modelos/respuestaTicketModelo.php";
}
class respuestaTicketControlador extends respuestaTicketModelo
{
  /*--------- mostrar estado del ticket seccion ---------*/
  public function mostrar_estado_ticket_controlador($pagina)
  {
    $id_ticket = mainModel::decryption($pagina);
    $id_ticket = mainModel::limpiar_cadena($id_ticket);
    $mostrarEstadoTicket = "";
    $consulta = "SELECT t.id_Ticket,t.id_estado,t.id_categoria,t.id_prioridad,e.estado,c.nombre_categoria,p.nombre_prioridad FROM tickets t,prioridades p, categorias c, estados e WHERE t.id_prioridad= p.id_prioridad AND t.id_categoria= c.id_categoria AND t.id_estado= e.id_estado AND t.id_ticket=$id_ticket";
    $conexion = mainModel::conectar();
    $datosEstadoTicket = $conexion->query($consulta);
    $datosEstadoTicket = $datosEstadoTicket->fetchAll();

    foreach ($datosEstadoTicket as $estadoTickets) {
      $id_estado_ticket = $estadoTickets['id_estado'];
      $id_categoria_ticket = $estadoTickets['id_categoria'];
      $id_prioridad_ticket = $estadoTickets['id_prioridad'];
      $consultaEstado = "SELECT * FROM estados WHERE id_estado!=$id_estado_ticket";
      $conexionEstado = mainModel::conectar();
      $datosEstado = $conexionEstado->query($consultaEstado);
      $datosEstado = $datosEstado->fetchAll();

      $consultaCategoria = "SELECT * FROM categorias WHERE id_categoria!=$id_categoria_ticket";
      $conexionCategoria = mainModel::conectar();
      $datosCategoria = $conexionCategoria->query($consultaCategoria);
      $datosCategoria = $datosCategoria->fetchAll();

      $consultaPrioridad = "SELECT * FROM prioridades WHERE id_prioridad!=$id_prioridad_ticket";
      $conexionPrioridad = mainModel::conectar();
      $datosPrioridad = $conexionPrioridad->query($consultaPrioridad);
      $datosPrioridad = $datosPrioridad->fetchAll();

      $mostrarEstadoTicket .= '
        <div class="panel-heading" style="border:1px solid black;text-align:left!important;">
          <span style="font-size:12px"><i class="fa-solid fa-circle-arrow-right"></i><b> Estado </b>';
      $mostrarEstadoTicket .= '
            <a type="button" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;" data-target="#myModalEstado' . $id_ticket . '"> <i class="fa-solid fa-pen-to-square" style="border:1px solid #DCDDDE;font-size:9px;padding:6px;border-radius:2px;cursor:pointer"></i></a></span>
          <div id="myModalEstado' . $id_ticket . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalEstadoLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalEstadoLabel">Modificar Estado Ticket</h4>
                </div>
                <form class="FormularioAjax" action="' . SERVERURL . 'ajax/respuestaTicketAjax.php" id="formularioRequerimiento" method="POST" data-form="update" autocomplete="off">
                  <input type="hidden" name="id_ticket_up" id="id_ticket_up" value="' . $id_ticket . '">
                    <div class="modal-body">
                      <div class="text-center" style="padding-bottom:20px">
                        <label style="display:block" for="id_estado_up"><b>Estado: </b></label>
                        <select style="width: 98%;text-align:center" class="form-control" name="id_estado_up" id="id_estado_up">
                        <option value="' . $estadoTickets['id_estado'] . '">' . $estadoTickets['estado'] . '</option>';

      foreach ($datosEstado as $estados) {
        $mostrarEstadoTicket .= '
                              <option value="' . $estados['id_estado'] . '">' . $estados['estado'] . '</option>';
      }
      $mostrarEstadoTicket .= '
                        </select>
                      </div>
                      <div class="text-center" style="padding-bottom:20px">
                        <label style="display:block" for="id_categoria_up"><b>Categoría: </b></label>
                        <select style="width: 98%;text-align:center" class="form-control" name="id_categoria_up" id="id_categoria_up">
                        <option value="' . $estadoTickets['id_categoria'] . '">' . $estadoTickets['nombre_categoria'] . '</option>';

      foreach ($datosCategoria as $categoria) {
        $mostrarEstadoTicket .= '
                              <option value="' . $categoria['id_categoria'] . '">' . $categoria['nombre_categoria'] . '</option>';
      }
      $mostrarEstadoTicket .= '
                        </select>
                      </div>
                      <div class="text-center" style="padding-bottom:20px">
                        <label style="display:block" for="id_prioridad_up"><b>Prioridad: </b></label>
                        <select  style="width: 98%;text-align:center" class="form-control" name="id_prioridad_up" id="id_prioridad_up">
                        <option value="' . $estadoTickets['id_prioridad'] . '">' . $estadoTickets['nombre_prioridad'] . '</option>';

      foreach ($datosPrioridad as $prioridad) {
        $mostrarEstadoTicket .= '
                              <option value="' . $prioridad['id_prioridad'] . '">' . $prioridad['nombre_prioridad'] . '</option>';
      }
      $mostrarEstadoTicket .= '
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
          <hr>
          <div style="font-size:10px;">';
      if ($estadoTickets['id_estado'] == 4) {
        $mostrarEstadoTicket .= '
            <span style="margin-left: -10px !important;display:block"><b> Estado: </b><span  class="estadoProceso">' . $estadoTickets['estado'] . '</span></span>';
      } elseif ($estadoTickets['id_estado'] == 5) {
        $mostrarEstadoTicket .= '
            <span  style="margin-left: -10px !important;display:block"><b> Estado: </b><span class="estadoEsperaCliente">' . $estadoTickets['estado'] . '</span></span>';
      } elseif ($estadoTickets['id_estado'] == 6) {
        $mostrarEstadoTicket .= '
            <span style="margin-left: -10px !important;display:block"><b> Estado: </b><span class="estadoEsperaAgente">' . $estadoTickets['estado'] . '</span></span>';
      } else {
        $mostrarEstadoTicket .= '
            <span style="margin-left: -10px !important;display:block"><b> Estado: </b><span class="estadoCerrado">' . $estadoTickets['estado'] . '</span></span>';
      }

      $mostrarEstadoTicket .= '
            <span style="margin-left: -10px !important;display:block;margin-top:10px;margin-bottom:10px"><b> Categoría: </b>' . $estadoTickets['nombre_categoria'] . '</span>';

      if ($estadoTickets['id_prioridad'] == 1) {
        $mostrarEstadoTicket .= '
                  <span style="margin-left: -10px !important;display:block"><b> Prioridad: </b><span  class="pririodadBaja">' . $estadoTickets['nombre_prioridad'] . '</span></span>';
      } elseif ($estadoTickets['id_prioridad'] == 4) {
        $mostrarEstadoTicket .= '
                  <span  style="margin-left: -10px !important;display:block"><b> Prioridad: </b><span class="prioridadMedia">' . $estadoTickets['nombre_prioridad'] . '</span></span>';
      } elseif ($estadoTickets['id_prioridad'] == 5) {
        $mostrarEstadoTicket .= '
                  <span style="margin-left: -10px !important;display:block"><b> Prioridad: </b><span class="pririodadAlta">' . $estadoTickets['nombre_prioridad'] . '</span></span>';
      } else {
        $mostrarEstadoTicket .= '
                  <span style="margin-left: -10px !important;display:block"><b> Prioridad: </b><span class="prioridadO">' . $estadoTickets['nombre_prioridad'] . '</span></span>';
      }
      $mostrarEstadoTicket .= '
          </div>
        </div>';
      return $mostrarEstadoTicket;
    }
    // return listaTicketModelo::datos_ticket_controlador($id);
  }
  /*---------- actualizar Proyecto ----------*/
  public function actualizar_estado_ticket_controlador()
  {
    $id_ticket_up = mainModel::limpiar_cadena($_POST['id_ticket_up']);
    $check_agente_actualizar = mainModel::ejecutar_consulta_simple("SELECT * FROM tickets WHERE id_ticket=$id_ticket_up");
    $campos = $check_agente_actualizar->fetch();

    if (isset($_POST['id_estado_up'])) {
      $id_estado = mainModel::limpiar_cadena($_POST['id_estado_up']);
    } else {
      $id_estado = $campos['id_estado'];
    }

    if (isset($_POST['id_categoria_up'])) {
      $id_categoria = mainModel::limpiar_cadena($_POST['id_categoria_up']);
    } else {
      $id_categoria = $campos['id_categoria'];
    }

    if (isset($_POST['id_prioridad_up'])) {
      $id_prioridad = mainModel::limpiar_cadena($_POST['id_prioridad_up']);
    } else {
      $id_prioridad = $campos['id_prioridad_up'];
    }

    $datos_actualizar_estado_ticket =
      [
        "id_estado" => $id_estado,
        "id_categoria" => $id_categoria,
        "id_prioridad" => $id_prioridad,
        "id_ticket_up" => $id_ticket_up
      ];
    if (respuestaTicketModelo::actualizar_estado_ticket_modelo($datos_actualizar_estado_ticket)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Datos Actualizados",
          "Texto" => "Datos actualizado exitosamente",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No hemos podido actualizar los datos, por favor intente nuevamente",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*--------- mostrar elevedor por del ticket seccion ---------*/
  public function mostrar_elevado_por_ticket_controlador($pagina)
  {
    $id_ticket = mainModel::decryption($pagina);
    $id_ticket = mainModel::limpiar_cadena($id_ticket);
    // echo $id_ticket;
    $mostrarElevadoTicket = "";
    $consulta = "SELECT id_Ticket,nombre_apellido_usuario,correo_usuario FROM tickets WHERE id_ticket=$id_ticket";
    $conexion = mainModel::conectar();
    $datosElevadoTicket = $conexion->query($consulta);
    $datosElevadoTicket = $datosElevadoTicket->fetchAll();

    foreach ($datosElevadoTicket as $elevado) {
      $mostrarElevadoTicket .= '
          <div class="panel-heading" style="border:1px solid black;text-align:left!important;">
          <span style="font-size:12px"><i class="fa-solid fa-user-tie"></i> <b>Elevado por</b>';
      $mostrarElevadoTicket .= '
              <a type="button" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;" data-target="#myModalElevado' . $id_ticket . '"> <i class="fa-solid fa-pen-to-square" style="border:1px solid #DCDDDE;font-size:9px;padding:6px;border-radius:2px;cursor:pointer"></i></a></span>
            <div id="myModalElevado' . $id_ticket . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalElevadoLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalElevadoLabel">Modificar Elevado por</h4>
                </div>
                  <form class="FormularioAjax" action="' . SERVERURL . 'ajax/respuestaTicketAjax.php" id="formularioRequerimiento" method="POST" data-form="update" autocomplete="off">
                    <input type="hidden" name="id_ticket_up_elevado" id="id_ticket_up_elevado" value="' . $id_ticket . '">
                      <div class="modal-body">
                      <div class="text-center" style="padding-bottom:20px">
                      <label style="display:block;margin-bottom:10px" for="nombre_apellido_usuario_up_elevado"><b>Ticket creado por:</b></label>
                      <input type="text" style="text-align:center;width: 98%" id="nombre_apellido_usuario_up_elevado" name="nombre_apellido_usuario_up_elevado" value="' . $elevado['nombre_apellido_usuario'] . '" class="form-control">
                    </div>
                    <div class="text-center" style="padding-bottom:20px">
                    <label style="display:block;margin-bottom:10px" for="correo_usuario_up_elevado"><b>Correo creador:</b></label>
                    <input type="text" style="text-align:center;width: 98%" id="correo_usuario_up_elevado" name="correo_usuario_up_elevado" value="' . $elevado['correo_usuario'] . '" class="form-control">
                  </div>
                      </div>
                      <div class="modal-footer"><button type="button" class="btn btn-default waves-effect" style="border-radius:6px" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="botonModalModificar">Modificar</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
            <hr>
              <div class="row" style="background-color: #D6DBDF;border-radius:3px;margin-top:5px">
              <div class="col-md-2" style="margin-top:11px">
                <i class="fa-solid fa-circle-user" style="color:#A5A7A8;font-size:15px"></i>
              </div>
              <div class="col-md-10">
                <span style="display:block;font-size:10px;margin-top:3px"> ' . $elevado['nombre_apellido_usuario'] . ' </span>
                <span style="display:block;font-size:10px;margin-top:3px;margin-bottom:3px"> ' . $elevado['correo_usuario'] . ' </span>
              </div>
            </div>
            <div style="font-size:10px;">
            </div>
          </div>';
      return $mostrarElevadoTicket;
    }
  }
  /*---------- actualizar Agente asignado ----------*/
  public function actualizar_elevado_controlador()
  {
    //recibir el id
    $id_ticket = mainModel::limpiar_cadena($_POST['id_ticket_up_elevado']);
    $nombre_apellido_usuario = mainModel::limpiar_cadena($_POST['nombre_apellido_usuario_up_elevado']);
    $correo_usuario = mainModel::limpiar_cadena($_POST['correo_usuario_up_elevado']);

    $datos_elevado_ticket_registro =
      [
        "nombre_apellido_usuario" => $nombre_apellido_usuario,
        "id_ticket" => $id_ticket,
        "correo_usuario" => $correo_usuario,
      ];
    if (respuestaTicketModelo::actualizar_elevedo_modelo($datos_elevado_ticket_registro)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Datos Actualizados",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*--------- mostrar agente asignado del ticket seccion ---------*/
  public function mostrar_agente_ticket_controlador($pagina)
  {
    $id_ticket = mainModel::decryption($pagina);
    $id_ticket = mainModel::limpiar_cadena($id_ticket);
    // echo $id_ticket;
    $mostrarElevadoTicket = "";
    $consulta = "SELECT t.id_Ticket,a.nombre_agente,t.id_agente FROM tickets t, agentes a WHERE t.id_agente= a.id_agente AND t.id_ticket=$id_ticket";
    $conexion = mainModel::conectar();
    $datosElevadoTicket = $conexion->query($consulta);
    $datosElevadoTicket = $datosElevadoTicket->fetchAll();

    foreach ($datosElevadoTicket as $agenteTickets) {
      $id_agente_elevado = $agenteTickets['id_agente'];
      $consultaAgentes = "SELECT * FROM agentes WHERE id_agente!=$id_agente_elevado";
      $conexionAgentes = mainModel::conectar();
      $datosAgentes = $conexionAgentes->query($consultaAgentes);
      $datosAgentes = $datosAgentes->fetchAll();
      $mostrarElevadoTicket .= '
            <div class="panel-heading" style="border:1px solid black;text-align:left!important;">
            <span style="font-size:12px"><i class="fa-solid fa-users"></i> <b>Agente Mesa de Ayuda</b>';
      $mostrarElevadoTicket .= '
                <a type="button" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;" data-target="#myModalAgenteMesa' . $id_ticket . '"> <i class="fa-solid fa-pen-to-square" style="border:1px solid #DCDDDE;font-size:9px;padding:6px;border-radius:2px;cursor:pointer"></i></a></span>
              <div id="myModalAgenteMesa' . $id_ticket . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalAgenteMesaLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                  <h4 class="modal-title" id="myModalAgenteMesaLabel">Modificar Agente Mesa de Ayuda</h4>
                </div>
                    <form class="FormularioAjax" action="' . SERVERURL . 'ajax/respuestaTicketAjax.php" id="formularioRequerimiento" method="POST" data-form="update" autocomplete="off">
                      <input type="hidden" name="id_ticket_up_agente_asignado" id="id_ticket_up_agente_asignado" value="' . $id_ticket . '">
                        <div class="modal-body">
                          <div class="text-center" style="padding-bottom:20px">
                            <label style="display:block" for="id_agente_up"><b>Agente asignado: </b></label>
                            <select style="width: 98%;text-align:center;margin-top:4px" class="form-control" name="id_agente_up" id="id_agente_up">
                            <option value="' . $agenteTickets['id_agente'] . '">' . $agenteTickets['nombre_agente'] . '</option>';
      foreach ($datosAgentes as $agentes) {
        $mostrarElevadoTicket .= '
                                  <option value="' . $agentes['id_agente'] . '">' . $agentes['nombre_agente'] . '</option>';
      }
      $mostrarElevadoTicket .= '
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
              <hr>
                <div class="row" style="margin-top:5px;display:flex">
                <div>
                  <i class="fa-solid fa-circle-user" style="color:#A5A7A8;font-size:15px"></i>
                  <span style="font-size:10px;margin-left:5px"> ' . $agenteTickets['nombre_agente'] . ' </span>
                </div>
              </div>
            </div>';
      return $mostrarElevadoTicket;
    }
  }
  /*---------- actualizar Agente asignado ----------*/
  public function actualizar_agente_asignado_controlador()
  {
    //recibir el id
    $id_ticket = mainModel::limpiar_cadena($_POST['id_ticket_up_agente_asignado']);
    $check_agente_asignado_actualizar = mainModel::ejecutar_consulta_simple("SELECT id_agente FROM tickets WHERE id_ticket='$id_ticket'");
    if ($check_agente_asignado_actualizar->rowCount() <= 0) {
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
      $campos = $check_agente_asignado_actualizar->fetch();
    }
    if (isset($_POST['id_agente_up'])) {
      $id_agente = mainModel::limpiar_cadena($_POST['id_agente_up']);
    } else {
      $id_agente = $campos['id_agente'];
    }
    $datos_asignacion_ticket_registro =
      [
        "id_agente" => $id_agente,
        "id_ticket" => $id_ticket,
      ];
    if (respuestaTicketModelo::actualizar_agente_asignado_modelo($datos_asignacion_ticket_registro)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Datos Actualizados",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*--------- mostrar campos del ticket seccion ---------*/
  public function mostrar_campos_ticket_controlador($pagina)
  {
    $id_ticket = mainModel::decryption($pagina);
    $id_ticket = mainModel::limpiar_cadena($id_ticket);
    $mostrarElevadoTicket = "";
    $consulta = "SELECT t.id_cliente,t.id_proyecto,t.id_tipo_identificacion,t.id_tipo_requerimiento,ti.tipo_identificacion,t.numero_identificacion_usuario,t.celular_usuario,tr.tipo_requerimiento,py.nombre_proyecto,cl.nombre_cliente,t.id_ticket FROM tickets t, tipo_identificaciones ti, tipo_requerimientos tr,proyectos py, clientes cl WHERE t.id_tipo_identificacion=ti.id_tipo_identificacion AND t.id_tipo_requerimiento=tr.id_tipo_requerimiento AND t.id_proyecto=py.id_proyecto AND t.id_cliente=cl.id_cliente AND t.id_ticket=$id_ticket";
    $conexion = mainModel::conectar();
    $datoscamposTicket = $conexion->query($consulta);
    $datoscamposTicket = $datoscamposTicket->fetchAll();

    foreach ($datoscamposTicket as $camposTickets) {
      $tipo_identificacion_ticket = $camposTickets['id_tipo_identificacion'];
      $tipo_requerimiento_ticket = $camposTickets['id_tipo_requerimiento'];
      $proyectos_ticket = $camposTickets['id_proyecto'];
      $clientes_ticket = $camposTickets['id_cliente'];

      $consultaTipoIdentificacion = "SELECT * FROM tipo_identificaciones WHERE id_tipo_identificacion!=$tipo_identificacion_ticket";
      $conexionTipoIdentificacion = mainModel::conectar();
      $datosTipoIdentificacion = $conexionTipoIdentificacion->query($consultaTipoIdentificacion);
      $datosTipoIdentificacion = $datosTipoIdentificacion->fetchAll();

      $consultaTipoRequerimiento = "SELECT * FROM tipo_requerimientos WHERE id_tipo_requerimiento!=$tipo_requerimiento_ticket";
      $conexionTipoRequerimiento = mainModel::conectar();
      $datosTipoRequerimiento = $conexionTipoRequerimiento->query($consultaTipoRequerimiento);
      $datosTipoRequerimiento = $datosTipoRequerimiento->fetchAll();

      $consultaProyectos = "SELECT * FROM proyectos WHERE id_proyecto!=$proyectos_ticket";
      $conexionProyectos = mainModel::conectar();
      $datosProyectos = $conexionProyectos->query($consultaProyectos);
      $datosProyectos = $datosProyectos->fetchAll();

      $consultaClientes = "SELECT * FROM clientes WHERE id_cliente!=$clientes_ticket";
      $conexionClientes = mainModel::conectar();
      $datosClientes = $conexionClientes->query($consultaClientes);
      $datosClientes = $datosClientes->fetchAll();

      $mostrarElevadoTicket .= '
              <div class="panel-heading" style="border:1px solid black;text-align:left!important;">
              <span style="font-size:12px"><i class="fa-regular fa-rectangle-list"></i> <b>Campos del Ticket</b>';
      $mostrarElevadoTicket .= '
                  <a type="button" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;" data-target="#myModalProyecto' . $id_ticket . '"> <i class="fa-solid fa-pen-to-square" style="border:1px solid #DCDDDE;font-size:9px;padding:6px;border-radius:2px;cursor:pointer"></i></a></span>
                <div id="myModalProyecto' . $id_ticket . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalProyectoLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title" id="myModalProyectoLabel">Modificar Capos del Ticket</h4>
                  </div>
                      <form class="FormularioAjax" action="' . SERVERURL . 'ajax/respuestaTicketAjax.php" id="formularioRequerimiento" method="POST" data-form="update" autocomplete="off">
                        <input type="hidden" name="id_ticket_campos_ticket" id="id_ticket_campos_ticket" value="' . $id_ticket . '">
                          <div class="modal-body">
                            <div class="text-center" style="padding-bottom:20px">
                              <label style="display:block" for="id_tipo_identificacion"><b>Tipo identificación: </b></label>
                              <select style="width: 98%;text-align:center" class="form-control" name="id_tipo_identificacion" id="id_tipo_identificacion">
                              <option value="' . $camposTickets['id_tipo_identificacion'] . '">' . $camposTickets['tipo_identificacion'] . '</option>';
      foreach ($datosTipoIdentificacion as $identificacion) {
        $mostrarElevadoTicket .= '
                                    <option value="' . $identificacion['id_tipo_identificacion'] . '">' . $identificacion['tipo_identificacion'] . '</option>';
      }
      $mostrarElevadoTicket .= '
                              </select>
                            </div>
                            <div class="text-center" style="padding-bottom:20px">
                            <label style="display:block;margin-bottom:10px" for="numero_identificacion_usuario"><b>Número de identificación:</b></label>
                            <input type="text" style="text-align:center;width: 98%" id="numero_identificacion_usuario" name="numero_identificacion_usuario" value="' . $camposTickets['numero_identificacion_usuario'] . '" class="form-control">
                          </div>
                          <div class="text-center" style="padding-bottom:20px">
                          <label style="display:block;margin-bottom:10px" for="celular_usuario"><b>Número de celular:</b></label>
                          <input type="text" style="text-align:center;width: 98%" id="celular_usuario" name="celular_usuario" value="' . $camposTickets['celular_usuario'] . '" class="form-control">
                        </div>

                            <div class="text-center" style="padding-bottom:20px">
                              <label style="display:block" for="id_agente_up"><b>Tipo requerimiento: </b></label>
                              <select style="width: 98%;text-align:center" class="form-control" name="id_tipo_requerimiento" id="id_tipo_requerimiento">
                              <option value="' . $camposTickets['id_tipo_requerimiento'] . '">' . $camposTickets['tipo_requerimiento'] . '</option>';
      foreach ($datosTipoRequerimiento as $requerimiento) {
        $mostrarElevadoTicket .= '
                                    <option value="' . $requerimiento['id_tipo_requerimiento'] . '">' . $requerimiento['tipo_requerimiento'] . '</option>';
      }
      $mostrarElevadoTicket .= '
                              </select>
                            </div>

                            <div class="text-center" style="padding-bottom:20px">
                            <label style="display:block" for="id_agente_up"><b>Proyecto: </b></label>
                            <select style="width: 98%;text-align:center" class="form-control" name="id_proyecto" id="id_proyecto">
                            <option value="' . $camposTickets['id_proyecto'] . '">' . $camposTickets['nombre_proyecto'] . '</option>';
      foreach ($datosProyectos as $proyecto) {
        $mostrarElevadoTicket .= '
                                  <option value="' . $proyecto['id_proyecto'] . '">' . $proyecto['nombre_proyecto'] . '</option>';
      }
      $mostrarElevadoTicket .= '
                            </select>
                          </div>

                          <div class="text-center" style="padding-bottom:20px">
                          <label style="display:block" for="id_cliente"><b>Cliente: </b></label>
                          <select style="width: 98%;text-align:center" class="form-control" name="id_cliente" id="id_cliente">
                          <option value="' . $camposTickets['id_cliente'] . '">' . $camposTickets['nombre_cliente'] . '</option>';
      foreach ($datosClientes as $cliente) {
        $mostrarElevadoTicket .= '
                                <option value="' . $cliente['id_cliente'] . '">' . $cliente['nombre_cliente'] . '</option>';
      }
      $mostrarElevadoTicket .= '
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
                <hr>
                <div style="font-size:10px;">
                <span style="margin-left: -10px !important;display:block;margin-top:10px"> <b>Tipo identificación: </b>' . $camposTickets['tipo_identificacion'] . '</span>
                <span style="margin-left: -10px !important;display:block;margin-top:10px"> <b>Número de identificación: </b>' . $camposTickets['numero_identificacion_usuario'] . '</span>
                <span style="margin-left: -10px !important;display:block;margin-top:10px"> <b>Celular: </b>' . $camposTickets['celular_usuario'] . '</span>
                <span style="margin-left: -10px !important;display:block;margin-top:10px"> <b>Tipo requerimiento: </b>' . $camposTickets['tipo_requerimiento'] . '</span>
                <span style="margin-left: -10px !important;display:block;margin-top:10px"> <b>Proyecto: </b>' . $camposTickets['nombre_proyecto'] . '</span>
                <span style="margin-left: -10px !important;display:block;margin-top:10px"> <b>Cliente: </b>' . $camposTickets['nombre_cliente'] . '</span>
              </div>
              </div>';
      return $mostrarElevadoTicket;
    }
    // return listaTicketModelo::datos_ticket_controlador($id);
  }
  /*---------- actualizar campos tickets ----------*/
  public function actualizar_campos_ticket_usuario_controlador()
  {
    //recibir el id
    $id_ticket = mainModel::limpiar_cadena($_POST['id_ticket_campos_ticket']);
    $numero_identificacion_usuario = mainModel::limpiar_cadena($_POST['numero_identificacion_usuario']);
    $celular_usuario = mainModel::limpiar_cadena($_POST['celular_usuario']);

    $check_agente_asignado_actualizar = mainModel::ejecutar_consulta_simple("SELECT * FROM tickets WHERE id_ticket=$id_ticket");
    $campos = $check_agente_asignado_actualizar->fetch();
    if (isset($_POST['id_tipo_identificacion'])) {
      $id_tipo_identificacion = mainModel::limpiar_cadena($_POST['id_tipo_identificacion']);
    } else {
      $id_tipo_identificacion = $campos['id_tipo_identificacion'];
    }

    if (isset($_POST['id_tipo_requerimiento'])) {
      $id_tipo_requerimiento = mainModel::limpiar_cadena($_POST['id_tipo_requerimiento']);
    } else {
      $id_tipo_requerimiento = $campos['id_tipo_requerimiento'];
    }

    if (isset($_POST['id_proyecto'])) {
      $id_proyecto = mainModel::limpiar_cadena($_POST['id_proyecto']);
    } else {
      $id_proyecto = $campos['id_proyecto'];
    }

    if (isset($_POST['id_cliente'])) {
      $id_cliente = mainModel::limpiar_cadena($_POST['id_cliente']);
    } else {
      $id_cliente = $campos['id_cliente'];
    }

    $datos_campos_ticket_registro =
      [
        "numero_identificacion_usuario" => $numero_identificacion_usuario,
        "celular_usuario" => $celular_usuario,
        "id_tipo_identificacion" => $id_tipo_identificacion,
        "id_cliente" => $id_cliente,
        "id_tipo_requerimiento" => $id_tipo_requerimiento,
        "id_proyecto" => $id_proyecto,
        "id_ticket" => $id_ticket,
      ];
    if (respuestaTicketModelo::actualizar_campos_ticket_usuario_modelo($datos_campos_ticket_registro)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Datos Actualizados",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*--------- mostrar campos del ticket seccion ---------*/
  public function boton_modal_campos_solo_agente_controlador($pagina)
  {
    $id_ticket = mainModel::decryption($pagina);
    $id_ticket = mainModel::limpiar_cadena($id_ticket);
    // echo $id_ticket;
    $mostrarSoloAgente = "";
    $consultaAgentes = "SELECT * FROM prioridades WHERE eliminar=0";
    $conexionAgentes = mainModel::conectar();
    $datosAgentes = $conexionAgentes->query($consultaAgentes);
    $datosAgentes = $datosAgentes->fetchAll();

    $check_agente_actualizar = mainModel::ejecutar_consulta_simple("SELECT adt.id_adiciones_ticket,adt.id_prioridad, adt.clasificacion_llamada_ticket, adt.modificacion_fecha_ticket, adt.id_ticket, adt.destinatario_adicional,p.nombre_prioridad FROM adiciones_ticket adt, prioridades p WHERE adt.id_ticket=$id_ticket and p.id_prioridad=adt.id_prioridad");
    $agentesDatos = $check_agente_actualizar->fetch();

    $mostrarSoloAgente .= '
    <div class="panel-heading" style="border:1px solid black;text-align:left!important">

      <span style="font-size:12px"><i class="fa-solid fa-rectangle-list"></i> <b>Campos Solo Agente</b>';
    $mostrarSoloAgente .= '
      <a type="button" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;" data-target="#myModalcamposSoloAgente' . $id_ticket . '"> <i class="fa-solid fa-pen-to-square" style="border:1px solid #DCDDDE;font-size:9px;padding:6px;border-radius:2px;cursor:pointer"></i></a></span>
      <div id="myModalcamposSoloAgente' . $id_ticket . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalcamposSoloAgenteLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalcamposSoloAgenteLabel">Campos Solo Agentes</h4>
            </div>
            <form class="FormularioAjax" action="' . SERVERURL . 'ajax/respuestaTicketAjax.php" id="formularioRequerimiento" method="POST" data-form="save" autocomplete="off">
              <input type="hidden" name="id_ticket_campos_solo_agente" id="id_ticket_campos_solo_agente" value="' . $id_ticket . '">
              <div class="modal-body">
                <div style="padding-bottom:20px;text-align:left;margin-top:8px">
                  <label for="id_agente_up"><b>Clasificación Llamada Calidad Servicio </b></label>
                  <div style="margin-top:5px">
                    <input type="radio" name="clasificacionesLlamada" id="clasificacionesLlamada" value="5"></input>
                    <label>5 Excelente</label>
                  </div>
                  <div style="margin-top:4px">
                    <input type="radio" name="clasificacionesLlamada" id="clasificacionesLlamada" value="4"></input>
                    <label>4 Bueno</label>
                  </div>
                  <div style="margin-top:4px">
                    <input type="radio" name="clasificacionesLlamada" id="clasificacionesLlamada" value="3"></input>
                    <label>3 Aceptable</label>
                  </div>
                  <div style="margin-top:4px">
                    <input type="radio" name="clasificacionesLlamada" id="clasificacionesLlamada" value="2"></input>
                    <label>2 Regular</label>
                  </div>
                  <div style="margin-top:4px">
                    <input type="radio" name="clasificacionesLlamada" id="clasificacionesLlamada" value="1"></input>
                    <label>1 Malo</label>
                  </div>
                </div>
                <div class="text-center" style="padding-bottom:20px">
                  <p style="display:block" for="id_prioridad"><b>Prioridades: </b></p>
                  <label style="display:block" for="id_prioridad">Determine la Prioridad del Ticket</label>
                  <select style="width: 98%;text-align:center;margin-top:4px" class="form-control" name="id_prioridad" id="id_prioridad">
                  <option value="0"></option>';

    foreach ($datosAgentes as $agentes) {
      $mostrarSoloAgente .= '
                    <option value="' . $agentes['id_prioridad'] . '">' . $agentes['nombre_prioridad'] . '</option>';
    }
    $mostrarSoloAgente .= '
                  </select>
                </div>
                <div class="text-center" style="padding-bottom:20px">
                  <p style="display:block" for="modificacion_fecha_ticket"><b>Modificar Fecha Ticket: </b></p>
                  <input type="date" name="modificacion_fecha_ticket" id="modificacion_fecha_ticket"></input>
                </div>
                          </div>
                          <div class="modal-footer"><button type="button" class="btn btn-default waves-effect" style="border-radius:6px" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="botonModalModificar">Agregar</button>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
                <hr>';
    $mostrarSoloAgente .= '

                <span style="margin-left: -10px !important;display:block"><b> Llamada Calidad Servicio: </b><span class=""> '.$agentesDatos['clasificacion_llamada_ticket'].'</span></span>
                <span style="margin-left: -10px !important;display:block"><b> Prioridad: </b><span class=""></span>'.$agentesDatos['nombre_prioridad'].'</span>
                <span style="margin-left: -10px !important;display:block"><b> Modificar Fecha Ticket: </b><span class=""></span>'.$agentesDatos['modificacion_fecha_ticket'].'</span>';
    $mostrarSoloAgente .= '

                </div>
                ';
    return $mostrarSoloAgente;
  }
  /*--------- agregar campos solo agentes ---------*/
  public function agregar_campos_solo_agente_controlador()
  {
    $id_ticket = mainModel::limpiar_cadena($_POST['id_ticket_campos_solo_agente']);
    $id_prioridad = mainModel::limpiar_cadena($_POST['id_prioridad']);
    $modificacion_fecha_ticket = ($_POST['modificacion_fecha_ticket']);
    $clasificacion_llamada_ticket = ($_POST['clasificacionesLlamada']);
    // foreach ($datosSoloAgentes as $soloAgenteDatos) {
    //   $prioridadSoloAgente=$soloAgenteDatos['id_prioridad'];
    // }
    // var_dump($prioridadSoloAgente);
    if ($id_prioridad==0) {
      $id_prioridad=NULL;
    }else {
      $id_prioridad=$id_prioridad;
    }
    if ($modificacion_fecha_ticket=="") {
      $modificacion_fecha_ticket=NULL;
    }else {
      $modificacion_fecha_ticket=$modificacion_fecha_ticket;
    }
    // var_dump($modificacion_fecha_ticket);

    $datos_solo_agente =
    [
      "clasificacion_llamada_ticket" => $clasificacion_llamada_ticket,
      "modificacion_fecha_ticket" => $modificacion_fecha_ticket,
      "id_prioridad" => $id_prioridad,
      "id_ticket" => $id_ticket,
    ];
    if (respuestaTicketModelo::actualizar_elevado_modelo($datos_solo_agente)) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Datos Actualizados",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }

  /*--------- mostrar destinatarios adicionalesdel ticket seccion ---------*/
  public function mostrar_destinatarios_adicionales_ticket_controlador($pagina)
  {
    $id_ticket = mainModel::decryption($pagina);
    $id_ticket = mainModel::limpiar_cadena($id_ticket);
    $mostrarElevadoTicket = "";
    $consulta = "SELECT * FROM adiciones_ticket WHERE id_ticket=$id_ticket";
    $conexion = mainModel::conectar();
    $datosDestinatarioAdicional = $conexion->query($consulta);
    $datosDestinatarioAdicional = $datosDestinatarioAdicional->fetchAll();

    foreach ($datosDestinatarioAdicional as $camposDestinatarioAdicional) {
      $mostrarElevadoTicket .= '
                <div class="panel-heading" style="border:1px solid black;text-align:left!important;">
                <span style="font-size:12px"><i class="fa-solid fa-envelope"></i> <b>Destinatarios Adicionales </b></span>
                <a type="button" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;" data-target="#myModalDestinatario' . $id_ticket . '"> <i class="fa-solid fa-pen-to-square" style="border:1px solid #DCDDDE;font-size:9px;padding:6px;border-radius:2px;cursor:pointer"></i></a></span>
                  <div id="myModalDestinatario' . $id_ticket . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalProyectoLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                      <div class="modal-header">
                      <h4 class="modal-title" id="myModalProyectoLabel">Agregar Destinatario</h4>
                    </div>
                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/respuestaTicketAjax.php" id="formularioRequerimiento" method="POST" data-form="save" autocomplete="off">
                          <input type="hidden" name="id_ticket_destinatario_ticket" id="id_ticket_destinatario_ticket" value="' . $id_ticket . '">
                            <div class="modal-body">
                              <div class="text-center" style="padding-bottom:20px">
                              <label style="display:block;margin-bottom:10px" for="destinatario_adicional"><b>Destinatario Adicional:</b></label>
                              <input type="email" style="text-align:center;width: 98%" id="destinatario_adicional" name="destinatario_adicional" value="' . $camposDestinatarioAdicional['destinatario_adicional'] . '" class="form-control">
                            </div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-default waves-effect" style="border-radius:6px" data-dismiss="modal">Cerrar</button>
                              <button type="submit" class="botonModalModificar">Agregar</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div style="font-size:10px;">
                  <span style="margin-left: -10px !important;display:block;margin-top:10px"> <b>Email: </b>' . $camposDestinatarioAdicional['destinatario_adicional'] . '</span>
                </div>
                </div>';
      return $mostrarElevadoTicket;
    }
    // return listaTicketModelo::datos_ticket_controlador($id);
  }
  /*--------- agregar destinatario adiocional del ticket ---------*/
  public function agregar_destinatario_adicional_controlador()
  {
    //recibir el id
    $id_ticket = mainModel::limpiar_cadena($_POST['id_ticket_destinatario_ticket']);
    $destinatario_adicional = mainModel::limpiar_cadena($_POST['destinatario_adicional']);

    $datos_destinatario_Adiocinal_registro =
      [
        "destinatario_adicional" => $destinatario_adicional,
        "id_ticket" => $id_ticket,
      ];
      $hola="hola";
    if (respuestaTicketModelo::agregar_destinatario_adicional_ticket_modelo($datos_destinatario_Adiocinal_registro)) {
      $alerta =
      [
        "Alerta" => "recargar",
        "Icon" => "success",
        "Titulo" => "Destinatario Agregado",
        "Tipo" => "success"
      ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrió un error inesperado",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }






  
  /*---------  ---------*/
  public function alertaEstatica($numero)
  {
    $mostrarElevadoTicket = "";
      $mostrarElevadoTicket .= '
                <span style="font-size:12px"$numero</span>
';      return $mostrarElevadoTicket;
    }



/*************************************************desde aca esta pendiente*************************************************/




  /*--------- mostrar formulario respuesta ticket ---------*/
  public function mostrar_formulario_respuesta_ticket_controlador($pagina,$rol_ihs_view,$correo_usuario_view,$numero_ticket_view,$nombre_apellido_usuario_view)
  {
    $id_ticket = mainModel::decryption($pagina);
    $id_ticket = mainModel::limpiar_cadena($id_ticket);
    $rol_ihs_view=$rol_ihs_view;
    $correo_usuario_view=$correo_usuario_view;
    $numero_ticket_view=$numero_ticket_view;
    $nombre_apellido_usuario_view=$nombre_apellido_usuario_view;

      $mostrarElevadoTicket = "";
      $mostrarElevadoTicket .= '
      <form class="FormularioAjax" action="' . SERVERURL . 'ajax/respuestaTicketAjax.php" id="formularioRequerimiento" method="POST" autocomplete="off">
        <div class="row" style="margin-top: 20px;">
          <div class="col-md-12">
            <div class="formularioTicketContenedorTres">
              <textarea name="respuesta_add" id="respuesta_add" class="wysihtml5 form-control" rows="9" cols="40"></textarea>
              <input type="hidden" id="id_ticket_add_respuesta" name="id_ticket_add_respuesta" value="'.$id_ticket.'">
              <input type="hidden" id="id_agente_respuesta" name="id_agente_respuesta" value="'.$rol_ihs_view.'">
              <input type="hidden" id="correo_usuario" name="correo_usuario" value="'.$correo_usuario_view.'">
              <input type="hidden" id="numero_ticket" name="numero_ticket" value="'.$numero_ticket_view.'">
              <input type="hidden" id="nombre_apellido_usuario" name="nombre_apellido_usuario" value="'.$nombre_apellido_usuario_view.'"> 
              <div class="caja" style="margin:0!important;padding:0!important;margin-top:10px!important;width:100%!important">
                <input style="padding:15px!important;font-size:13px" type="text" id="" placeholder="BCC (lista separada por comar)" name="">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-7">
                <div class="formCkeck">
                  <div class="formFileContainer">
                    <p id="textoAdjuntarArchivo">Adjuntar archivo</p>
                    <input type="file" class="adjuntar" name="archivo_adjunto_proceso" id="archivo_adjunto_proceso">
                  </div>
                  <p class="recomendacionAdjunto">Puede cargar archivos con un tamaño máximo de 5 mb de tipos jpg, jpeg, png, gif, pdf, doc, docx, ppt, pptx, pps, ppsx, odt, xls, xlsx, mp3, m4a, ogg, wav, mp4, m4v, mov, wmv, avi, mpg, ogv, 3gp, 3g2, zip, eml.</p>
                </div>
              </div>
              <div class="col-md-5" style="padding-left:11%;">
                <div class="botonesEnviarTicket" style="padding: 0;margin:0; width:100%">
                  <button name="enviarRespuesta" class="Enviar" type="submit" style="margin:0"><i class="fa-solid fa-reply"></i> Enviar respuesta</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>';
      return $mostrarElevadoTicket;
  }

  public function agregar_respuesta_ticket_controlador()
  {
    $respuesta_add = mainModel::limpiar_cadena($_POST['respuesta_add']);
    $id_ticket_add = $_POST['id_ticket_add'];
    $id_ticket = mainModel::decryption($id_ticket_add);
    $id_ticket = mainModel::limpiar_cadena($id_ticket);
    $fecha_respuesta = (date("Y-m-d H:i:s"));
    $id_agente_respuesta = mainModel::limpiar_cadena($_POST['id_agente_respuesta']);
    $nombre_agente_consulta = mainModel::ejecutar_consulta_simple("SELECT nombre_agente FROM agentes WHERE id_agente=$id_agente_respuesta");
    $correo_usuario = mainModel::limpiar_cadena($_POST['correo_usuario']);
    $numero_ticket = mainModel::limpiar_cadena($_POST['numero_ticket']);
    $nombre_apellido_usuario  = mainModel::limpiar_cadena($_POST['nombre_apellido_usuario']);
    foreach ($nombre_agente_consulta as $agente) {
      $nombre_agente = $agente['nombre_agente'];
    }
    // INICIO guardar archivo en la bd
    $nombre_file = $_FILES['archivo_adjunto_proceso']['name'];
    $nombre_file = str_replace(' ', '', $nombre_file);
    $direccion = "https://www.incubarhuila.co/pruebaTicket/assets/images/archivos/";
    $archivo_adjunto_ticket = $direccion . basename($nombre_file);
    // tipo de archivo que se va a guardar
    $type = strtolower(pathinfo($nombre_file, PATHINFO_EXTENSION));
    // FIN guardar archivo en la bd
    // valor maximo del archivo
    $maxsize = 5242880;
    if ($nombre_file == " " || $nombre_file == "" || $nombre_file == false) {
      $archivo_adjunto_ticket = " ";
    } else {
      // validacion del tipo de archivo que se va a subir
      if ($type == "jpg" || $type == "jpeg" || $type == "png" || $type == "gif" || $type == "pdf" || $type == "doc" || $type == "docx" || $type == "ppt" || $type == "pptx" || $type == "pps" || $type == "ppsx" || $type == "odt" || $type == "xls" || $type == "xlsx" || $type == "mp3" || $type == "m4a" || $type == "ogg" || $type == "wav" || $type == "mp4" || $type == "m4v" || $type == "mov" || $type == "wmv" || $type == "avi" || $type == "mpg" || $type == "ogv" || $type == "3gp" || $type == "3g2" || $type == "zip" || $type == "eml") {
        if (($_FILES['archivo_adjunto_ticket']['size'] >= $maxsize) || ($_FILES["archivo_adjunto_ticket"]["size"] == 0)) {
          $alerta =
            [
              "Alerta" => "simple",
              "Icon" => "error",
              "Titulo" => "Ocurrió un error inesperado",
              "Texto" => "El archivo es mayor a 5m",
              "Tipo" => "error"
            ];
          echo json_encode($alerta);
          exit();
        }
      } else {
        $alerta =
          [
            "Alerta" => "simple",
            "Icon" => "error",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "El tipo de archivo no coincide con el formato solicitado",
            "Tipo" => "error"
          ];
        echo json_encode($alerta);
        exit();
      }
    }
    $datos_agregar_respuesta =
      [
        "fecha_respuesta" => $fecha_respuesta,
        "respuesta_add" => $respuesta_add,
        "archivo_adjunto_proceso" => $archivo_adjunto_ticket,
        "id_ticket" => $id_ticket,
        "id_agente_respuesta" => $id_agente_respuesta,
      ];
    $datos_modificar_respuesta =
      [
        "fecha_respuesta" => $fecha_respuesta,
        "id_ticket" => $id_ticket,
      ];

    $agregar_respuesta = respuestaTicketModelo::agregar_respuesta_ticket_modelo($datos_agregar_respuesta);
    $modificar_fecha = respuestaTicketModelo::modificar_fecha_respuesta_modelo($datos_modificar_respuesta);
    $asunto = '
    [Ticket #' . $numero_ticket . '] Su ticket ha sido Solucionado y Cerrado Exitosamente!';
    // mensaje
    $mensaje = '
    <html>
    <body>
    <p>Estimado(a) ' . $nombre_apellido_usuario . ',</p>
    <br>
    <br>
    <p>Respetuosamente le informamos su ticket <b>#' . $numero_ticket . '</b> ha sido solucionado y cerrado exitosamente.</p>
    <br>
    <p>El detalle de la respuesta es:</p>
    <br>
    <p>" </p>
    <br>
    <p>' . $respuesta_add . '</p>
    <br>
    <p>Agente</p>
    <p>' . $nombre_agente . '</p>
    <p>MESA DE AYUDA</p>
    <p>INCUBARHUILA</p>
    <p>" Fin de la respuesta.</p>
    <br>
    <br>
    <p>Para consultar el estado y detalles adicionales del ticket podrá ingresar al siguiente enlace:   </p>
    <br>
    <a href="' . SERVERURL . 'ticketUsuario/' . mainModel::encryption($id_ticket) . '/">' . SERVERURL . 'ticketUsuario/' . mainModel::encryption($id_ticket) . '/</a>
    <br>
    <br>
    <p>Por favor, en caso de que la notificación por correo electronico no aparezca en la bandeja de entrada, por favor revisar la bandeja de Correo No Deseado o Spam.</p>
    <br>
    <p>Esperamos que esté satisfecho con la atención y soporte de la Mesa de Ayuda de INCUBARHUILA.</p>
    <br>
    <p>Por último, le recordamos que se puede comunicar con la Mesa de Ayuda por medio de las líneas 018000930158 y 3224685815, al correo electrónico mesadeayuda@incubarhuila.co y/o la plataforma https://www.incubarhuila.co/pruebaTicket/, en donde podrán radicar sus requerimientos asociados al servicio de conectividad a internet.</p>
    <br>
    <p>Agradecemos de antemano la atención prestada.</p>
    <p>Atentamente,</p>
    <br>
    <br>
    <br>
    <p><b>INCUBADORA DE EMPRESAS DE INNOVACIÓN Y BASE TECNOLÓGICA DEL HUILA</b></p>
    <p>NIT. 813.009.224-3</p>
    <p>Carrera 4 No. 22-11 Oficina A10 – A11 – Recinto Ferial “La Vorágine”</p>
    <p>Web: www.incubarhuila.co – E-mail: info@incubarhuila.co – Celular: 322 468 58 15</p>
    <p>Neiva – Huila - Colombia</p>
    </body>
    </html>
    ';
    // Para enviar correo HTML, la cabecera Content-type debe definirse
    $header = 'MIME-Version: 1.0' . "\r\n";
    $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    // Cabeceras adicionales
    $header .= 'From: Incubarhuila <mesadeayuda@incubarhuila.co>' . "\r\n";
    $header .= 'Bcc: mesadeayuda@incubarhuila.co' . "\r\n";
    // Enviarlo
    mail($correo_usuario, $asunto, $mensaje, $header);
    if ($agregar_respuesta->rowCount() == 1) {
      $alerta =
        [
          "Alerta" => "recargar",
          "Icon" => "success",
          "Titulo" => "Estado agregado",
          "Texto" => "Los datos han sido agregados",
          "Tipo" => "success"
        ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "info",
          "Titulo" => "Ocurrió un error inesperado",
          "Texto" => "No se han podido agregar los datos",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  }
  /*---------- agregar respuesta ticket ----------*/
  public function agregadr_respuesta_ticket_controlador()
  {
    // $correo_usuario = mainModel::limpiar_cadena($$_POST['correo_usuario']);
    // $nota_ticket = mainModel::limpiar_cadena($_GET['nota_ticket']);
    $nota_ticket = mainModel::limpiar_cadena($_POST['id_ticket_add_respuesta']);
    $uno = $_POST['enviarRespuesta'];
    $dos = $_POST['notaRespuesta'];
    // $uno=$_POST["boton"];
    // var_dump($uno);
    var_dump($uno,$dos);

    // if(isset($_POST['notaRespuesta'])){
    //   echo "el texto: Sera agregado.<br>";
    // }
    // if(isset($_POST['enviarRespuesta'])){
    //   echo "3";
    // }

    // if (isset($_POST['notaRespuesta'])==$dos) {
    //   var_dump("1234");
    // } elseif (isset($_POST['enviarRespuesta'])==$uno) {
    //   var_dump("123415");
    // }
  }
}
