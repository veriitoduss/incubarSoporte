<?php

require_once "mainModel.php";

class ticketRespuestaModelo extends mainModel
{
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
}
