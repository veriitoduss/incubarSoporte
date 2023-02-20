<?php

require_once "mainModel.php";

class ticketModelo extends mainModel
{
  /*--------- agregar ticket ---------*/
  protected static function agregar_ticket_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("INSERT INTO tickets(id_ticket,numero_ticket,nombre_apellido_usuario,numero_identificacion_usuario,celular_usuario,correo_usuario,asunto,descripcion,archivo_adjunto_ticket,fecha_creacion_ticket,id_tipo_identificacion,id_cliente,id_tipo_requerimiento,id_estado,id_proyecto,id_categoria,id_prioridad,id_agente,eliminar)
    VALUES (:id_ticket,:numero_ticket,:nombre_apellido_usuario,:numero_identificacion_usuario,:celular_usuario,:correo_usuario,:asunto,:descripcion,:archivo_adjunto_ticket,:fecha_creacion_ticket,:id_tipo_identificacion,:id_cliente,:id_tipo_requerimiento,:id_estado,:id_proyecto,:id_categoria,:id_prioridad,:id_agente,:eliminar)");

    $sql->bindParam(":id_ticket", $datos['id_ticket']);
    $sql->bindParam(":numero_ticket", $datos['numero_ticket']);
    $sql->bindParam(":nombre_apellido_usuario", $datos['nombre_apellido_usuario']);
    $sql->bindParam(":numero_identificacion_usuario", $datos['numero_identificacion_usuario']);
    $sql->bindParam(":celular_usuario", $datos['celular_usuario']);
    $sql->bindParam(":correo_usuario", $datos['correo_usuario']);
    $sql->bindParam(":asunto", $datos['asunto']);
    $sql->bindParam(":descripcion", $datos['descripcion']);
    $sql->bindParam(":archivo_adjunto_ticket", $datos['archivo_adjunto_ticket']);
    $sql->bindParam(":fecha_creacion_ticket", $datos['fecha_creacion_ticket']);
    $sql->bindParam(":id_tipo_identificacion", $datos['id_tipo_identificacion']);
    $sql->bindParam(":id_cliente", $datos['id_cliente']);
    $sql->bindParam(":id_tipo_requerimiento", $datos['id_tipo_requerimiento']);
    $sql->bindParam(":id_estado", $datos['id_estado']);
    $sql->bindParam(":id_proyecto", $datos['id_proyecto']);
    $sql->bindParam(":id_categoria", $datos['id_categoria']);
    $sql->bindParam(":id_prioridad", $datos['id_prioridad']);
    $sql->bindParam(":id_agente", $datos['id_agente']);
    $sql->bindParam(":eliminar", $datos['eliminar']);

    $sql->execute();
    return $sql;
  }
  /*--------- agregar ticket ---------*/
  protected static function agregar_adiciones_ticket_modelo($id_ticket)
  {
    $sql = mainModel::conectar()->prepare("INSERT INTO adiciones_ticket(id_ticket)
      VALUES (:id_ticket)");

    $sql->bindParam(":id_ticket", $id_ticket);
    $sql->execute();
    return $sql;
  }
}
