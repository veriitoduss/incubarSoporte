  <?php

  if ($peticionAjax) {
    require_once "../modelos/ticketRespuestaModelo.php";
  } else {
    require_once "./modelos/ticketRespuestaModelo.php";
  }
  class ticketRespuestaControlador extends ticketRespuestaModelo
  {
    /*--------- mostrar estado del ticket seccion ---------*/
    public function mostrar_estado_ticket_controlador($pagina)
    {
      $id_ticket = mainModel::decryption($pagina);
      $id_ticket = mainModel::limpiar_cadena($id_ticket);
      $mostrarEstadoTicket = "";
      $consulta = "SELECT t.id_Ticket,t.id_estado,e.estado,c.nombre_categoria,p.nombre_prioridad FROM tickets t,prioridades p, categorias c, estados e WHERE t.id_prioridad= p.id_prioridad AND t.id_categoria= c.id_categoria AND t.id_estado= e.id_estado AND t.id_ticket=$id_ticket";
      $conexion = mainModel::conectar();
      $datosEstadoTicket = $conexion->query($consulta);
      $datosEstadoTicket = $datosEstadoTicket->fetchAll();

      $consultaEstado = "SELECT * FROM estados WHERE eliminar = 0";
      $conexionEstado = mainModel::conectar();
      $datosEstado = $conexionEstado->query($consultaEstado);
      $datosEstado = $datosEstado->fetchAll();

      $consultaCategoria = "SELECT * FROM categorias WHERE eliminar = 0";
      $conexionCategoria = mainModel::conectar();
      $datosCategoria = $conexionCategoria->query($consultaCategoria);
      $datosCategoria = $datosCategoria->fetchAll();

      foreach ($datosEstadoTicket as $estadoTickets) {
        $mostrarEstadoTicket .= '
          <div class="panel-heading" style="border:1px solid black;text-align:left!important;">
            <span style="font-size:12px"><i class="fa-solid fa-circle-arrow-right"></i><b> Estado </b>';
        $mostrarEstadoTicket .= '
              <a type="button" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;" data-target="#myModalEstado' . $id_ticket . '"></a></span>
            <div id="myModalEstado' . $id_ticket . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalEstadoLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalEstadoLabel">Modificar Estado Ticket</h4>
                  </div>
                  <form class="FormularioAjax" action="' . SERVERURL . 'ajax/clienteAjax.php" id="formularioRequerimiento" method="POST" data-form="update" autocomplete="off">
                    <input type="hidden" name="id_cliente_up" id="id_cliente_up" value="' . $id_ticket . '">
                      <div class="modal-body">
                        <div class="text-center" style="padding-bottom:20px">
                          <label style="display:block" for="id_estado_up"><b>Estado: </b><p style="color:#a7aaaf;margin-top:2px">' . $estadoTickets['estado'] . '</p></label>
                          <select required style="width: 98%;text-align:center" class="form-control" name="id_estado_up" id="id_estado_up">';
        foreach ($datosEstado as $estados) {
          $mostrarEstadoTicket .= '
                                <option value="' . $estados['id_estado'] . '">' . $estados['estado'] . '</option>';
        }
        $mostrarEstadoTicket .= '
                          </select>
                        </div>
                        <div class="text-center" style="padding-bottom:20px">
                          <label style="display:block" for="id_categoria_up"><b>Categoría: </b><p style="color:#a7aaaf;margin-top:2px">' . $estadoTickets['nombre_categoria'] . '</p></label>
                          <select required style="width: 98%;text-align:center" class="form-control" name="id_categoria_up" id="id_categoria_up">';
        foreach ($datosCategoria as $categoria) {
          $mostrarEstadoTicket .= '
                                <option value="' . $categoria['id_categoria'] . '">' . $categoria['nombre_categoria'] . '</option>';
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
        if ($estadoTickets['id_estado'] == 1 || $estadoTickets['id_estado'] == 4) {
          $mostrarEstadoTicket .= '
              <span style="margin-left: -10px !important;display:block"><b> Estado: </b><span style="background-color:red;padding:4px;color:white;border-radius:3px">' . $estadoTickets['estado'] . '</span></span>
              ';
        } elseif ($estadoTickets['id_estado'] == 7) {
          $mostrarEstadoTicket .= '
              <span style="margin-left: -10px !important;display:block;"><b> Estado: </b><span style="background-color:#0ab20b;padding:4px;color:white;border-radius:3px">' . $estadoTickets['estado'] . '</span></span>
              ';
        } else {
          $mostrarEstadoTicket .= '
              <span style="margin-left: -10px !important;display:block"><b> Estado: </b>' . $estadoTickets['estado'] . '</span>
              ';
        }
        $mostrarEstadoTicket .= '
              <span style="margin-left: -10px !important;display:block;margin-top:10px"><b> Categoría: </b>' . $estadoTickets['nombre_categoria'] . '</span>
            </div>
          </div>';
        return $mostrarEstadoTicket;
      }
      // return listaTicketModelo::datos_ticket_controlador($id);
    }
    /*--------- mostrar campos del ticket seccion ---------*/
    public function mostrar_campos_ticket_controlador($pagina)
    {
      $id_ticket = mainModel::decryption($pagina);
      $id_ticket = mainModel::limpiar_cadena($id_ticket);
      $mostrarElevadoTicket = "";
      $consulta = "SELECT ti.tipo_identificacion,t.numero_identificacion_usuario,t.celular_usuario,tr.tipo_requerimiento,py.nombre_proyecto,cl.nombre_cliente,t.id_ticket FROM tickets t, tipo_identificaciones ti, tipo_requerimientos tr,proyectos py, clientes cl WHERE t.id_tipo_identificacion=ti.id_tipo_identificacion AND t.id_tipo_requerimiento=tr.id_tipo_requerimiento AND t.id_proyecto=py.id_proyecto AND t.id_cliente=cl.id_cliente AND t.id_ticket=$id_ticket";
      $conexion = mainModel::conectar();
      $datoscamposTicket = $conexion->query($consulta);
      $datoscamposTicket = $datoscamposTicket->fetchAll();

      $consultaTipoIdentificacion = "SELECT * FROM tipo_identificaciones WHERE eliminar = 0";
      $conexionTipoIdentificacion = mainModel::conectar();
      $datosTipoIdentificacion = $conexionTipoIdentificacion->query($consultaTipoIdentificacion);
      $datosTipoIdentificacion = $datosTipoIdentificacion->fetchAll();

      $consultaTipoRequerimiento = "SELECT * FROM tipo_requerimientos WHERE eliminar = 0";
      $conexionTipoRequerimiento = mainModel::conectar();
      $datosTipoRequerimiento = $conexionTipoRequerimiento->query($consultaTipoRequerimiento);
      $datosTipoRequerimiento = $datosTipoRequerimiento->fetchAll();

      $consultaProyectos = "SELECT * FROM proyectos WHERE eliminar = 0";
      $conexionProyectos = mainModel::conectar();
      $datosProyectos = $conexionProyectos->query($consultaProyectos);
      $datosProyectos = $datosProyectos->fetchAll();

      $consultaClientes = "SELECT * FROM clientes WHERE eliminar = 0";
      $conexionClientes = mainModel::conectar();
      $datosClientes = $conexionClientes->query($consultaClientes);
      $datosClientes = $datosClientes->fetchAll();

      foreach ($datoscamposTicket as $camposTickets) {
        $mostrarElevadoTicket .= '
              <div class="panel-heading" style="border:1px solid black;text-align:left!important;">
              <span style="font-size:12px"><i class="fa-regular fa-rectangle-list"></i> <b>Campos del Ticket</b>';
        $mostrarElevadoTicket .= '
                  <a type="button" class="buttonEditar" data-toggle="modal" style="margin-right: 10px;" data-target="#myModalProyecto' . $id_ticket . '"></a></span>
                <div id="myModalProyecto' . $id_ticket . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalProyectoLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title" id="myModalProyectoLabel">Modificar Capos del Ticket</h4>
                  </div>
                      <form class="FormularioAjax" action="' . SERVERURL . 'ajax/clienteAjax.php" id="formularioRequerimiento" method="POST" data-form="update" autocomplete="off">
                        <input type="hidden" name="id_ticket_up" id="id_ticket_up" value="' . $id_ticket . '">
                          <div class="modal-body">
                            <div class="text-center" style="padding-bottom:20px">
                              <label style="display:block" for="id_agente_up"><b>Tipo identificación: </b><p style="color:#a7aaaf;margin-top:2px">' . $camposTickets['tipo_identificacion'] . '</p></label>
                              <select required style="width: 98%;text-align:center" class="form-control" name="id_agente_up" id="id_agente_up">';
        foreach ($datosTipoIdentificacion as $identificacion) {
          $mostrarElevadoTicket .= '
                                    <option value="' . $identificacion['id_tipo_identificaciones'] . '">' . $identificacion['tipo_identificacion'] . '</option>';
        }
        $mostrarElevadoTicket .= '
                              </select>
                            </div>
                            <div class="text-center" style="padding-bottom:20px">
                            <label style="display:block;margin-bottom:10px" for="nombre_apellido_usuario_up"><b>Número de identificación:</b></label>
                            <input type="text" style="text-align:center;width: 98%" id="nombre_apellido_usuario_up" name="nombre_apellido_usuario_up" value="' . $camposTickets['numero_identificacion_usuario'] . '" class="form-control">
                          </div>
                          <div class="text-center" style="padding-bottom:20px">
                          <label style="display:block;margin-bottom:10px" for="nombre_apellido_usuario_up"><b>Número de celular:</b></label>
                          <input type="text" style="text-align:center;width: 98%" id="nombre_apellido_usuario_up" name="nombre_apellido_usuario_up" value="' . $camposTickets['celular_usuario'] . '" class="form-control">
                        </div>

                            <div class="text-center" style="padding-bottom:20px">
                              <label style="display:block" for="id_agente_up"><b>Tipo requerimiento: </b><p style="color:#a7aaaf;margin-top:2px">' . $camposTickets['tipo_requerimiento'] . '</p></label>
                              <select required style="width: 98%;text-align:center" class="form-control" name="id_agente_up" id="id_agente_up">';
        foreach ($datosTipoRequerimiento as $requerimiento) {
          $mostrarElevadoTicket .= '
                                    <option value="' . $requerimiento['id_tipo_requerimiento'] . '">' . $requerimiento['tipo_requerimiento'] . '</option>';
        }
        $mostrarElevadoTicket .= '
                              </select>
                            </div>

                            <div class="text-center" style="padding-bottom:20px">
                            <label style="display:block" for="id_agente_up"><b>Proyecto: </b><p style="color:#a7aaaf;margin-top:2px">' . $camposTickets['nombre_proyecto'] . '</p></label>
                            <select required style="width: 98%;text-align:center" class="form-control" name="id_agente_up" id="id_agente_up">';
        foreach ($datosProyectos as $proyecto) {
          $mostrarElevadoTicket .= '
                                  <option value="' . $proyecto['id_proyecto'] . '">' . $proyecto['nombre_proyecto'] . '</option>';
        }
        $mostrarElevadoTicket .= '
                            </select>
                          </div>

                          <div class="text-center" style="padding-bottom:20px">
                          <label style="display:block" for="id_agente_up"><b>Cliente: </b><p style="color:#a7aaaf;margin-top:2px">' . $camposTickets['nombre_cliente'] . '</p></label>
                          <select required style="width: 98%;text-align:center" class="form-control" name="id_agente_up" id="id_agente_up">';
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
                <span style="margin-left: -10px !important;display:block"> <b>Tipo identificación: </b>' . $camposTickets['tipo_identificacion'] . '</span>
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
    /*--------- mostrar campos del ticket seccion ---------*/
    public function mostrar_mensaje_creacion_controlador($pagina)
    {
      $id_ticket = mainModel::decryption($pagina);
      $id_ticket = mainModel::limpiar_cadena($id_ticket);
      $mostrarElevadoTicket = "";
      $consulta = "SELECT nombre_apellido_usuario,fecha_creacion_ticket,descripcion FROM tickets WHERE id_ticket=$id_ticket";
      $conexion = mainModel::conectar();
      $datoscamposTicket = $conexion->query($consulta);
      $datoscamposTicket = $datoscamposTicket->fetchAll();

      foreach ($datoscamposTicket as $camposTickets) {
        $mostrarElevadoTicket .= '
          <div class="panel-heading" style="border:1px solid black;text-align:left!important;margin-bottom:10px;">
          <div>
          <i class="fa-solid fa-user" style="font-size:28px;color:#A5A7A8;"></i>
          <span style="font-size:15px;padding-left:10px"><b>' . $camposTickets['nombre_apellido_usuario'] . '</b></span>
          <span style="font-size:8px"><em>reportado ' . $camposTickets['fecha_creacion_ticket'] . '</em></span>
          </div>
          <span style="padding-left: 33px !important;display:block;margin-top:10px">' . $camposTickets['descripcion'] . '</span>
          </div>';
        return $mostrarElevadoTicket;
      }
      // return listaTicketModelo::datos_ticket_controlador($id);
    }
    /*--------- mostrar campos del ticket seccion ---------*/
    public function mostrar_mensaje_respuesta_controlador($pagina)
    {
      $id_ticket = mainModel::decryption($pagina);
      $id_ticket = mainModel::limpiar_cadena($id_ticket);
      $mostrarrespuestas = "";
      $consulta = "SELECT t.id_agente,a.nombre_agente,pt.fecha_respuesta,pt.respuesta FROM agentes a, tickets t, procesos_tickets pt WHERE t.id_ticket=4 and t.id_agente=a.id_agente ORDER BY pt.fecha_respuesta DESC";
      $conexion = mainModel::conectar();
      $datoscamposTicket = $conexion->query($consulta);
      $datoscamposTicket = $datoscamposTicket->fetchAll();

      foreach ($datoscamposTicket as $camposTicketRespuesta) {
        $mostrarrespuestas .= '
          <div class="col-md-12 style="margin-left: 25px">
          <div class="panel panel-primary" style="text-align: center;border:1px solid #DCDDDE;border-radius:4px">
          <div class="panel-heading" style="border:1px solid black;text-align:left!important;margin-bottom:10px">
          <div>
          <i class="fa-solid fa-user" style="font-size:28px;color:#A5A7A8;"></i>
          <span style="font-size:15px;padding-left:10px"><b>' . $camposTicketRespuesta['nombre_agente'] . '</b></span>
          <span style="font-size:8px"><em>respondido ' . $camposTicketRespuesta['fecha_respuesta'] . '</em></span>
          </div>
          <span style="padding-left: 33px !important;display:block;margin-top:10px">' . $camposTicketRespuesta['respuesta'] . '</span>
          <span style="padding-left: 33px !important;display:block;margin-top:10px">' . $camposTicketRespuesta['nombre_agente'] . '</span>
          <span style="padding-left: 33px !important;display:block;margin-top:10px">Agente</span>
            </div>
            </div>
          </div>';
      }
      return $mostrarrespuestas;
      // return listaTicketModelo::datos_ticket_controlador($id);
    }


  }
