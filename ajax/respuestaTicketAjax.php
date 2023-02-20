<?php
$peticionAjax = true;
require_once "../config/APP.php";

// if (isset($_POST['id_ticket_up']) || isset($_POST['id_ticket_up_elevado']) ||isset($_POST['id_ticket_up_campos']) ||isset($_POST['respuesta_add']) || isset($_POST['id_ticket_up_agente_asignado'])) {
if (isset($_POST['id_ticket_up']) || isset($_POST['id_ticket_up_elevado']) || isset($_POST['id_ticket_campos_ticket']) || isset($_POST['id_ticket_up_agente_asignado']) || isset($_POST['id_ticket_campos_solo_agente']) || isset($_POST['id_ticket_add_respuesta']) || isset($_POST['id_ticket_destinatario_ticket']) || isset($_POST['id_ticket_excel_ticket'])) {
  /*--------- instancia al controlador ---------*/
  require_once "../controladores/respuestaTicketControlador.php";
  $ins_respuestaTicket = new respuestaTicketControlador();
  require_once "../controladores/ticketRespuestaControlador.php";
  $ins_ticketRespuesta = new ticketRespuestaControlador();

  /*--------- modificar estado del ticket ---------*/
  if (isset($_POST['id_ticket_up'])) {
    echo $ins_respuestaTicket->actualizar_estado_ticket_controlador();
  }
  /*--------- modificar elevado por del ticket ---------*/
  if (isset($_POST['id_ticket_up_elevado'])) {
    echo $ins_respuestaTicket->actualizar_elevado_controlador();
  }
  /*--------- actualizar el agente asignado ---------*/
  if (isset($_POST['id_ticket_up_agente_asignado'])) {
    echo $ins_respuestaTicket->actualizar_agente_asignado_controlador();
  }
  /*--------- modificar campos del ticket ---------*/
  if (isset($_POST['id_ticket_campos_ticket'])) {
    echo $ins_respuestaTicket->actualizar_campos_ticket_usuario_controlador();
  }
  /*--------- agregar campos solo agente ---------*/
  if (isset($_POST['id_ticket_campos_solo_agente'])) {
    echo $ins_respuestaTicket->agregar_campos_solo_agente_controlador();
  }
  /*--------- agregar destinatario adiocional del ticket ---------*/
  if (isset($_POST['id_ticket_destinatario_ticket'])) {
    echo $ins_respuestaTicket->agregar_destinatario_adicional_controlador();
  }
  
/*************************************************desde aca esta pendiente*************************************************/

  /*--------- agregar respuesta del ticket ---------*/
  if (isset($_POST['id_ticket_add_respuesta'])) {
    echo $ins_respuestaTicket->agregar_respuesta_ticket_controlador();
  }
  /*--------- agregar destinatario adiocional del ticket ---------*/
  // if (isset($_POST['id_ticket_add_respuesta'])) {
  //   echo $ins_respuestaTicket->agregar_respuesta_ticket_controlador();
  // }
} else {
  session_start(['name' => 'IHS']);
  session_unset();
  session_destroy();
  header("Location: " . SERVERURL . "login/");
  exit();
}
