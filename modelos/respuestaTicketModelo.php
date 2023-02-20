<?php

require_once "mainModel.php";

class respuestaTicketModelo extends mainModel
{
  /*---------- actualizar Proyecto ----------*/
  protected static function actualizar_estado_ticket_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE tickets SET id_estado=:id_estado, id_categoria=:id_categoria, id_prioridad=:id_prioridad
    WHERE id_ticket=:id_ticket");
    $sql->bindParam(":id_estado", $datos['id_estado']);
    $sql->bindParam(":id_categoria", $datos['id_categoria']);
    $sql->bindParam(":id_prioridad", $datos['id_prioridad']);
    $sql->bindParam(":id_ticket", $datos['id_ticket_up']);
    $sql->execute();
    return $sql;
  }
  /*---------- actualizar elevado ----------*/
  protected static function actualizar_elevedo_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE tickets SET nombre_apellido_usuario=:nombre_apellido_usuario, correo_usuario=:correo_usuario
    WHERE id_ticket=:id_ticket");
    $sql->bindParam(":nombre_apellido_usuario",  $datos['nombre_apellido_usuario']);
    $sql->bindParam(":correo_usuario",  $datos['correo_usuario']);
    $sql->bindParam(":id_ticket",  $datos['id_ticket']);
    $sql->execute();
    return $sql;
  }
  /*---------- actualizar agente asignado ----------*/
  protected static function actualizar_agente_asignado_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE tickets SET id_agente=:id_agente
    WHERE id_ticket=:id_ticket");
    $sql->bindParam(":id_agente",  $datos['id_agente']);
    $sql->bindParam(":id_ticket",  $datos['id_ticket']);
    $sql->execute();
    return $sql;
  }

  /*---------- actualizar agente asignado ----------*/
  protected static function actualizar_campos_ticket_usuario_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE tickets SET numero_identificacion_usuario=:numero_identificacion_usuario,celular_usuario=:celular_usuario,id_tipo_identificacion=:id_tipo_identificacion,id_cliente=:id_cliente,id_tipo_requerimiento=:id_tipo_requerimiento,id_proyecto=:id_proyecto
  WHERE id_ticket=:id_ticket");
    $sql->bindParam(":numero_identificacion_usuario",  $datos['numero_identificacion_usuario']);
    $sql->bindParam(":celular_usuario",  $datos['celular_usuario']);
    $sql->bindParam(":id_tipo_identificacion",  $datos['id_tipo_identificacion']);
    $sql->bindParam(":id_cliente",  $datos['id_cliente']);
    $sql->bindParam(":id_tipo_requerimiento",  $datos['id_tipo_requerimiento']);
    $sql->bindParam(":id_proyecto",  $datos['id_proyecto']);
    $sql->bindParam(":id_ticket",  $datos['id_ticket']);
    $sql->execute();
    return $sql;
  }
  /*---------- agregar respuesta ----------*/
  protected static function agregar_campos_solo_agente_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("INSERT INTO adiciones_ticket(clasificacion_llamada_ticket, modificacion_fecha_ticket, id_prioridad, id_ticket)
                VALUES (:clasificacion_llamada_ticket,:modificacion_fecha_ticket,:id_prioridad,:id_ticket)");
    $sql->bindParam(":clasificacion_llamada_ticket", $datos['clasificacion_llamada_ticket']);
    $sql->bindParam(":modificacion_fecha_ticket", $datos['modificacion_fecha_ticket']);
    $sql->bindParam(":id_prioridad", $datos['id_prioridad']);
    $sql->bindParam(":id_ticket", $datos['id_ticket']);
    $sql->execute();
    return $sql;
  }
  /*---------- agregar respuesta ----------*/
  protected static function agregar_respuesta_tickets_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("INSERT INTO procesos_tickets(fecha_respuesta, respuesta, id_agente_respuesta, id_ticket)
                    VALUES (:fecha_respuesta,:respuesta,:id_agente_respuesta,:id_ticket)");
    $sql->bindParam(":fecha_respuesta", $datos['fecha_respuesta']);
    $sql->bindParam(":respuesta", $datos['respuesta']);
    $sql->bindParam(":id_agente_respuesta", $datos['id_agente_respuesta']);
    $sql->bindParam(":id_ticket", $datos['id_ticket']);
    $sql->execute();
    return $sql;
  }
  /*---------- agregar respuesta ----------*/
  protected static function agregar_nota_tickets_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("INSERT INTO notas_ticket(descripcion_nota, fecha_nota, id_ticket, id_agente_nota)
                      VALUES (:descripcion_nota,:fecha_nota,:id_ticket,:id_agente_nota)");
    $sql->bindParam(":descripcion_nota", $datos['respuesta']);
    $sql->bindParam(":fecha_nota", $datos['fecha_respuesta']);
    $sql->bindParam(":id_ticket", $datos['id_ticket']);
    $sql->bindParam(":id_agente_respuesta", $datos['id_agente_respuesta']);
    $sql->execute();
    return $sql;
  }
    /*---------- agregar destinatarios adicionales ----------*/
    protected static function agregar_destinatario_adicional_ticket_modelo($datos)
    {
      $sql = mainModel::conectar()->prepare("UPDATE adiciones_ticket SET destinatario_adicional=:destinatario_adicional WHERE id_ticket=:id_ticket");
      $sql->bindParam(":destinatario_adicional",  $datos['destinatario_adicional']);
      $sql->bindParam(":id_ticket",  $datos['id_ticket']);
      $sql->execute();
      return $sql;
    }
  /*---------- actualizar elevado ----------*/
  protected static function actualizar_elevado_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE adiciones_ticket SET clasificacion_llamada_ticket=:clasificacion_llamada_ticket,id_prioridad=:id_prioridad,modificacion_fecha_ticket=:modificacion_fecha_ticket
    WHERE id_ticket=:id_ticket");
    $sql->bindParam(":clasificacion_llamada_ticket",  $datos['clasificacion_llamada_ticket']);
    $sql->bindParam(":id_prioridad",  $datos['id_prioridad']);
    $sql->bindParam(":modificacion_fecha_ticket",  $datos['modificacion_fecha_ticket']);
    $sql->bindParam(":id_ticket",  $datos['id_ticket']);
    $sql->execute();
    return $sql;
  }
    /*---------- agregar respuesta ticket ----------*/
    protected static function agregar_respuesta_ticket_modelo($datos)
    {
      $sql = mainModel::conectar()->prepare("INSERT INTO procesos_tickets(fecha_respuesta,respuesta,archivo_adjunto_proceso,id_ticket,id_agente_respuesta)
            VALUES (:fecha_respuesta,:respuesta,:archivo_adjunto_proceso,:id_ticket,:id_agente_respuesta)");
  
      $sql->bindParam(":fecha_respuesta", $datos['fecha_respuesta']);
      $sql->bindParam(":respuesta", $datos['respuesta_add']);
      $sql->bindParam(":archivo_adjunto_proceso", $datos['archivo_adjunto_proceso']);
      $sql->bindParam(":id_ticket", $datos['id_ticket']);
      $sql->bindParam(":id_agente_respuesta", $datos['id_agente_respuesta']);
      $sql->execute();
      return $sql;
    }
    /*---------- actualizar fecha ticket ----------*/
    protected static function modificar_fecha_respuesta_modelo($datos)
    {
      $sql = mainModel::conectar()->prepare("UPDATE tickets SET fecha_respuesta_ticket=:fecha_respuesta_ticket WHERE id_ticket=:id_ticket");
      $sql->bindParam(":fecha_respuesta_ticket", $datos['fecha_respuesta']);
      $sql->bindParam(":id_ticket", $datos['id_ticket']);
      $sql->execute();
      return $sql;
    }







/*************************************************desde aca esta pendiente*************************************************/


}
