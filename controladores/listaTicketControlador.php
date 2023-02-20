<?php

if ($peticionAjax) {
  require_once "../modelos/listaTicketModelo.php";
} else {
  require_once "./modelos/listaTicketModelo.php";
}
class listaTicketControlador extends listaTicketModelo
{

  public function datos_ticket_respuesta_controlador($id)
  {
    $id = mainModel::decryption($id);
    $id = mainModel::limpiar_cadena($id);
    return listaTicketModelo::datos_ticket_controlador($id);
  }
  /*--------- lista de todos los ticket ---------*/
  public function mostrar_datosListaTicketsTodos_controlador($pagina, $url)
  {
    $pagina = mainModel::limpiar_cadena($pagina);
    $registros = 100000;
    $url = mainModel::limpiar_cadena($url);
    $url = SERVERURL . $url . "/";
    $mostrarDatosListaTicket = "";
    $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
    $consulta = "SELECT t.id_ticket,t.numero_ticket,t.nombre_apellido_usuario,t.asunto,DATE_FORMAT(t.fecha_creacion_ticket,'%d/%m/%Y %H:%i:%s') as fecha_creacion_ticket,DATE_FORMAT(t.fecha_respuesta_ticket,'%d/%m/%Y %H:%i:%s') as fecha_respuesta_ticket,p.nombre_prioridad,c.nombre_categoria,e.estado,t.id_estado FROM tickets t,prioridades p, categorias c, estados e WHERE t.id_prioridad=p.id_prioridad AND t.id_categoria=c.id_categoria AND t.id_estado=e.id_estado ORDER BY numero_ticket ASC";
    $conexion = mainModel::conectar();
    $datosListaTicket = $conexion->query($consulta);
    $datosListaTicket = $datosListaTicket->fetchAll();
    $total = $conexion->query("SELECT FOUND_ROWS()");
    $total = (int) $total->fetchColumn();
    $Npaginas = ceil($total / $registros);
    $mostrarDatosListaTicket .= '';
    $mostrarDatosListaTicket .= '  
          <thead>
              <tr>
              <th></th>
              <th>Id</th>
              <th>Nombre(s)Apellido(s)</th>
              <th>Asunto</th>
              <th>Fecha Creación</th>
              <th>Fecha Cierre</th>
              <th>Prioridad</th>
              <th>Categoria</th>
              <th>Estado</th>
              </tr>
            </thead>
            <tbody>';
    foreach ($datosListaTicket as $ticket) {
      $mostrarDatosListaTicket .= '
              <tr>
              <td></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['numero_ticket'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_apellido_usuario'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['asunto'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['fecha_creacion_ticket'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['fecha_respuesta_ticket'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_prioridad'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_categoria'] . '</a></td>
              <td>';
      if ($ticket['id_estado'] == 4) {
        $mostrarDatosListaTicket .= '
                <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoProceso">' . $ticket['estado'] . '</a>';
      } elseif ($ticket['id_estado'] == 5) {
        $mostrarDatosListaTicket .= '
                  <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoEsperaCliente">' . $ticket['estado'] . '</a>';
      } elseif ($ticket['id_estado'] == 6) {
        $mostrarDatosListaTicket .= '
                  <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoEsperaAgente">' . $ticket['estado'] . '</a>';
      } else {
        $mostrarDatosListaTicket .= '
                  <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoCerrado">' . $ticket['estado'] . '</a>';
      }
      $mostrarDatosListaTicket .= '

              </td>';
    }
    $mostrarDatosListaTicket .= '</tbody>';
    return $mostrarDatosListaTicket;
  }
  /*--------- lista de los ticket cerrados---------*/
  public function mostrar_datosListaTickets_cerrado_controlador($pagina, $url)
  {
    $pagina = mainModel::limpiar_cadena($pagina);
    $registros = 100000;
    $url = mainModel::limpiar_cadena($url);
    $url = SERVERURL . $url . "/";
    $mostrarDatosListaTicket = "";
    $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
    $consulta = "SELECT t.id_ticket,t.numero_ticket,t.nombre_apellido_usuario,t.asunto,DATE_FORMAT(t.fecha_creacion_ticket,'%d/%m/%Y %H:%i:%s') as fecha_creacion_ticket,DATE_FORMAT(t.fecha_respuesta_ticket,'%d/%m/%Y %H:%i:%s') as fecha_respuesta_ticket,p.nombre_prioridad,c.nombre_categoria,e.estado,t.id_estado FROM tickets t,prioridades p, categorias c, estados e WHERE t.id_prioridad=p.id_prioridad AND t.id_categoria=c.id_categoria AND t.id_estado=e.id_estado and t.id_estado=7 ORDER BY numero_ticket ASC";
    $conexion = mainModel::conectar();
    $datosListaTicket = $conexion->query($consulta);
    $datosListaTicket = $datosListaTicket->fetchAll();
    $total = $conexion->query("SELECT FOUND_ROWS()");
    $total = (int) $total->fetchColumn();
    $Npaginas = ceil($total / $registros);
    $mostrarDatosListaTicket .= '';
    $mostrarDatosListaTicket .= '
          <thead>
              <tr>
              <th></th>
              <th>Id</th>
              <th>Nombre(s)Apellido(s)</th>
              <th>Asunto</th>
              <th>Fecha Creación</th>
              <th>Fecha Cierre</th>
              <th>Prioridad</th>
              <th>Categoria</th>
              <th>Estado</th>
              </tr>
            </thead>
            <tbody>';
    foreach ($datosListaTicket as $ticket) {
      $mostrarDatosListaTicket .= '
              <tr>
              <td></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['numero_ticket'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_apellido_usuario'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['asunto'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['fecha_creacion_ticket'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['fecha_respuesta_ticket'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_prioridad'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_categoria'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoCerrado">' . $ticket['estado'] . '</a></td>';
    }
    $mostrarDatosListaTicket .= '</tbody>';
    return $mostrarDatosListaTicket;
  }
  /*--------- lista de los ticket sin asignar---------*/
  public function mostrar_datosSinAsignar_controlador($pagina, $url)
  {
    $pagina = mainModel::limpiar_cadena($pagina);
    $registros = 100000;
    $url = mainModel::limpiar_cadena($url);
    $url = SERVERURL . $url . "/";
    $mostrarDatosListaTicket = "";
    $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
    $consulta = "SELECT t.id_ticket,t.numero_ticket,t.nombre_apellido_usuario,t.asunto,DATE_FORMAT(t.fecha_creacion_ticket,'%d/%m/%Y %H:%i:%s') as fecha_creacion_ticket,DATE_FORMAT(t.fecha_respuesta_ticket,'%d/%m/%Y %H:%i:%s') as fecha_respuesta_ticket,p.nombre_prioridad,c.nombre_categoria,e.estado,t.id_estado FROM tickets t,prioridades p, categorias c, estados e WHERE t.id_prioridad=p.id_prioridad AND t.id_categoria=c.id_categoria AND t.id_estado=e.id_estado AND t.id_agente=2 ORDER BY numero_ticket ASC";
    $conexion = mainModel::conectar();
    $datosListaTicket = $conexion->query($consulta);
    $datosListaTicket = $datosListaTicket->fetchAll();
    $total = $conexion->query("SELECT FOUND_ROWS()");
    $total = (int) $total->fetchColumn();
    $Npaginas = ceil($total / $registros);
    $mostrarDatosListaTicket .= '';
    $mostrarDatosListaTicket .= '  
          <thead>
              <tr>
              <th></th>
              <th>Id</th>
              <th>Nombre(s)Apellido(s)</th>
              <th>Asunto</th>
              <th>Fecha Creación</th>
              <th>Fecha Cierre</th>
              <th>Prioridad</th>
              <th>Categoria</th>
              <th>Estado</th>
              </tr>
            </thead>
            <tbody>';
    foreach ($datosListaTicket as $ticket) {
      $mostrarDatosListaTicket .= '
              <tr>
              <td></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['numero_ticket'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_apellido_usuario'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['asunto'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['fecha_creacion_ticket'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['fecha_respuesta_ticket'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_prioridad'] . '</a></td>
              <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_categoria'] . '</a></td>
              <td>';
      if ($ticket['id_estado'] == 4) {
        $mostrarDatosListaTicket .= '
                <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoProceso">' . $ticket['estado'] . '</a>';
      } elseif ($ticket['id_estado'] == 5) {
        $mostrarDatosListaTicket .= '
                  <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoEsperaCliente">' . $ticket['estado'] . '</a>';
      } elseif ($ticket['id_estado'] == 6) {
        $mostrarDatosListaTicket .= '
                  <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoEsperaAgente">' . $ticket['estado'] . '</a>';
      } else {
        $mostrarDatosListaTicket .= '
                  <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoCerrado">' . $ticket['estado'] . '</a>';
      }
      $mostrarDatosListaTicket .= '

              </td>';
    }
    $mostrarDatosListaTicket .= '</tbody>';
    return $mostrarDatosListaTicket;
  }
  /*--------- lista de los ticket sin asignar---------*/
  public function mostrar_datosEliminados_controlador($pagina, $url)
  {
    $pagina = mainModel::limpiar_cadena($pagina);
    $registros = 100000;
    $url = mainModel::limpiar_cadena($url);
    $url = SERVERURL . $url . "/";
    $mostrarDatosListaTicket = "";
    $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
    $consulta = "SELECT t.id_ticket,t.numero_ticket,t.nombre_apellido_usuario,t.asunto,DATE_FORMAT(t.fecha_creacion_ticket,'%d/%m/%Y %H:%i:%s') as fecha_creacion_ticket,DATE_FORMAT(t.fecha_respuesta_ticket,'%d/%m/%Y %H:%i:%s') as fecha_respuesta_ticket,p.nombre_prioridad,c.nombre_categoria,e.estado,t.id_estado FROM tickets t,prioridades p, categorias c, estados e WHERE t.id_prioridad=p.id_prioridad AND t.id_categoria=c.id_categoria AND t.id_estado=e.id_estado AND t.eliminar=1 ORDER BY numero_ticket ASC";
    $conexion = mainModel::conectar();
    $datosListaTicket = $conexion->query($consulta);
    $datosListaTicket = $datosListaTicket->fetchAll();
    $total = $conexion->query("SELECT FOUND_ROWS()");
    $total = (int) $total->fetchColumn();
    $Npaginas = ceil($total / $registros);
    $mostrarDatosListaTicket .= '';
    $mostrarDatosListaTicket .= '  
            <thead>
                <tr>
                <th></th>
                <th>Id</th>
                <th>Nombre(s)Apellido(s)</th>
                <th>Asunto</th>
                <th>Fecha Creación</th>
                <th>Fecha Cierre</th>
                <th>Prioridad</th>
                <th>Categoria</th>
                <th>Estado</th>
                </tr>
              </thead>
              <tbody>';
    foreach ($datosListaTicket as $ticket) {
      $mostrarDatosListaTicket .= '
                <tr>
                <td></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['numero_ticket'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_apellido_usuario'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['asunto'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['fecha_creacion_ticket'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['fecha_respuesta_ticket'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_prioridad'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_categoria'] . '</a></td>
                <td>';
      if ($ticket['id_estado'] == 4) {
        $mostrarDatosListaTicket .= '
                  <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoProceso">' . $ticket['estado'] . '</a>';
      } elseif ($ticket['id_estado'] == 5) {
        $mostrarDatosListaTicket .= '
                    <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoEsperaCliente">' . $ticket['estado'] . '</a>';
      } elseif ($ticket['id_estado'] == 6) {
        $mostrarDatosListaTicket .= '
                    <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoEsperaAgente">' . $ticket['estado'] . '</a>';
      } else {
        $mostrarDatosListaTicket .= '
                    <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoCerrado">' . $ticket['estado'] . '</a>';
      }
      $mostrarDatosListaTicket .= '
  
                </td>';
    }
    $mostrarDatosListaTicket .= '</tbody>';
    return $mostrarDatosListaTicket;
  }
  /*--------- lista de los ticket por agente ---------*/
  public function mostrar_datosListaPorAgente_controlador($pagina, $url, $agente)
  {
    $pagina = mainModel::limpiar_cadena($pagina);
    $id_agente = $agente;
    $registros = 100000;
    $url = mainModel::limpiar_cadena($url);
    $url = SERVERURL . $url . "/";
    $mostrarDatosListaTicket = "";
    $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
    $consulta = "SELECT t.id_ticket,t.numero_ticket,t.nombre_apellido_usuario,t.asunto,DATE_FORMAT(t.fecha_creacion_ticket,'%d/%m/%Y %H:%i:%s') as fecha_creacion_ticket,DATE_FORMAT(t.fecha_respuesta_ticket,'%d/%m/%Y %H:%i:%s') as fecha_respuesta_ticket,p.nombre_prioridad,c.nombre_categoria,e.estado,t.id_estado FROM tickets t,prioridades p, categorias c, estados e WHERE t.id_prioridad=p.id_prioridad AND t.id_categoria=c.id_categoria AND t.id_estado=e.id_estado AND t.id_agente=$id_agente ORDER BY numero_ticket ASC";
    $conexion = mainModel::conectar();
    $datosListaTicket = $conexion->query($consulta);
    $datosListaTicket = $datosListaTicket->fetchAll();
    $total = $conexion->query("SELECT FOUND_ROWS()");
    $total = (int) $total->fetchColumn();
    $Npaginas = ceil($total / $registros);
    $mostrarDatosListaTicket .= '';
    $mostrarDatosListaTicket .= '  
            <thead>
                <tr>
                <th></th>
                <th>Id</th>
                <th>Nombre(s)Apellido(s)</th>
                <th>Asunto</th>
                <th>Fecha Creación</th>
                <th>Fecha Cierre</th>
                <th>Prioridad</th>
                <th>Categoria</th>
                <th>Estado</th>
                </tr>
              </thead>
              <tbody>';
    foreach ($datosListaTicket as $ticket) {
      $mostrarDatosListaTicket .= '
                <tr>
                <td></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['numero_ticket'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_apellido_usuario'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['asunto'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['fecha_creacion_ticket'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['fecha_respuesta_ticket'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_prioridad'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_categoria'] . '</a></td>
                <td>';
      if ($ticket['id_estado'] == 4) {
        $mostrarDatosListaTicket .= '
                  <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoProceso">' . $ticket['estado'] . '</a>';
      } elseif ($ticket['id_estado'] == 5) {
        $mostrarDatosListaTicket .= '
                    <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoEsperaCliente">' . $ticket['estado'] . '</a>';
      } elseif ($ticket['id_estado'] == 6) {
        $mostrarDatosListaTicket .= '
                    <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoEsperaAgente">' . $ticket['estado'] . '</a>';
      } else {
        $mostrarDatosListaTicket .= '
                    <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoCerrado">' . $ticket['estado'] . '</a>';
      }
      $mostrarDatosListaTicket .= '
  
                </td>';
    }
    $mostrarDatosListaTicket .= '</tbody>';
    return $mostrarDatosListaTicket;
  }
  /*--------- lista de todos los ticket ---------*/
  public function mostrar_datosListaNoResuelto_controlador($pagina, $url)
  {
    $pagina = mainModel::limpiar_cadena($pagina);
    $registros = 100000;
    $url = mainModel::limpiar_cadena($url);
    $url = SERVERURL . $url . "/";
    $mostrarDatosListaTicket = "";
    $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
    $consulta = "SELECT t.id_ticket,t.numero_ticket,t.nombre_apellido_usuario,t.asunto,DATE_FORMAT(t.fecha_creacion_ticket,'%d/%m/%Y %H:%i:%s') as fecha_creacion_ticket,DATE_FORMAT(t.fecha_respuesta_ticket,'%d/%m/%Y %H:%i:%s') as fecha_respuesta_ticket,p.nombre_prioridad,c.nombre_categoria,e.estado,t.id_estado FROM tickets t,prioridades p, categorias c, estados e WHERE t.id_prioridad=p.id_prioridad AND t.id_categoria=c.id_categoria AND t.id_estado=e.id_estado AND t.id_estado!=7 ORDER BY numero_ticket ASC";
    $conexion = mainModel::conectar();
    $datosListaTicket = $conexion->query($consulta);
    $datosListaTicket = $datosListaTicket->fetchAll();
    $total = $conexion->query("SELECT FOUND_ROWS()");
    $total = (int) $total->fetchColumn();
    $Npaginas = ceil($total / $registros);
    $mostrarDatosListaTicket .= '';
    $mostrarDatosListaTicket .= '  
            <thead>
                <tr>
                <th></th>
                <th>Id</th>
                <th>Nombre(s)Apellido(s)</th>
                <th>Asunto</th>
                <th>Fecha Creación</th>
                <th>Fecha Cierre</th>
                <th>Prioridad</th>
                <th>Categoria</th>
                <th>Estado</th>
                </tr>
              </thead>
              <tbody>';
    foreach ($datosListaTicket as $ticket) {
      $mostrarDatosListaTicket .= '
                <tr>
                <td></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['numero_ticket'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_apellido_usuario'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['asunto'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['fecha_creacion_ticket'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['fecha_respuesta_ticket'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_prioridad'] . '</a></td>
                <td><a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" style=text-decoration:none;color:black>' . $ticket['nombre_categoria'] . '</a></td>
                <td>';
      if ($ticket['id_estado'] == 4) {
        $mostrarDatosListaTicket .= '
                  <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoProceso">' . $ticket['estado'] . '</a>';
      } elseif ($ticket['id_estado'] == 5) {
        $mostrarDatosListaTicket .= '
                    <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoEsperaCliente">' . $ticket['estado'] . '</a>';
      } elseif ($ticket['id_estado'] == 6) {
        $mostrarDatosListaTicket .= '
                    <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoEsperaAgente">' . $ticket['estado'] . '</a>';
      } else {
        $mostrarDatosListaTicket .= '
                    <a href="' . SERVERURL . 'respuestaTicket/' . mainModel::encryption($ticket['id_ticket']) . '/" class="estadoCerrado">' . $ticket['estado'] . '</a>';
      }
      $mostrarDatosListaTicket .= '
                </td>';
    }
    $mostrarDatosListaTicket .= '</tbody>';
    return $mostrarDatosListaTicket;
  }



    /*--------- lista de todos los ticket ---------*/
    public function descargar_excel_controlador()
    {
      header('Content-type:application/xls');
      header('Content-Disposition: attachment; filename=lista_ticket.xls');
      $consulta = "SELECT t.id_ticket,t.numero_ticket,t.nombre_apellido_usuario,t.asunto,DATE_FORMAT(t.fecha_creacion_ticket,'%d/%m/%Y %H:%i:%s') as fecha_creacion_ticket,DATE_FORMAT(t.fecha_respuesta_ticket,'%d/%m/%Y %H:%i:%s') as fecha_respuesta_ticket,p.nombre_prioridad,c.nombre_categoria,e.estado,t.id_estado FROM tickets t,prioridades p, categorias c, estados e WHERE t.id_prioridad=p.id_prioridad AND t.id_categoria=c.id_categoria AND t.id_estado=e.id_estado ORDER BY numero_ticket ASC";
    $conexion = mainModel::conectar();
    $datosListaTicket = $conexion->query($consulta);
    $datosListaTicket = $datosListaTicket->fetchAll();
    $mostrarDatosListaTicket= '';
    $mostrarDatosListaTicket .= '
            <thead>
                <tr>
                <th></th>
                <th>Id</th>
                <th>Nombre(s)Apellido(s)</th>
                <th>Asunto</th>
                <th>Fecha Creación</th>
                <th>Fecha Cierre</th>
                <th>Prioridad</th>
                <th>Categoria</th>
                <th>Estado</th>
                </tr>
              </thead>
              <tbody>';
      $mostrarDatosListaTicket .= '
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>';
    $mostrarDatosListaTicket .= '</tbody>';
    return $mostrarDatosListaTicket;
    }
}
