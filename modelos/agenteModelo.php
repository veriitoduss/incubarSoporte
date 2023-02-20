<?php

require_once "mainModel.php";

class agenteModelo extends mainModel
{
  /*---------- agregar Agentes ----------*/
  protected static function agregar_agente_modelo($nombre_agente, $correo_agente, $usuario_agente, $contrasena_agente, $id_rol, $eliminar)
  {
    $sql = mainModel::conectar()->prepare("INSERT INTO agentes(nombre_agente,correo_agente,usuario_agente,contrasena_agente,id_rol,eliminar)
              VALUES (:nombre_agente,:correo_agente,:usuario_agente,:contrasena_agente,:id_rol,:eliminar)");
    $sql->bindParam(":nombre_agente", $nombre_agente);
    $sql->bindParam(":correo_agente", $correo_agente);
    $sql->bindParam(":usuario_agente", $usuario_agente);
    $sql->bindParam(":contrasena_agente", $contrasena_agente);
    $sql->bindParam(":id_rol", $id_rol);
    $sql->bindParam(":eliminar", $eliminar);
    $sql->execute();
    return $sql;
  }
  /*---------- actualizar Agentes ----------*/
  protected static function actualizar_agente_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE agentes SET nombre_agente=:nombre_agente,correo_agente=:correo_agente,usuario_agente=:usuario_agente,id_rol=:id_rol WHERE id_agente=:id_agente");
    $sql->bindParam(":nombre_agente", $datos['nombre_agente']);
    $sql->bindParam(":correo_agente", $datos['correo_agente']);
    $sql->bindParam(":usuario_agente", $datos['usuario_agente']);
    $sql->bindParam(":id_rol", $datos['id_rol']);
    $sql->bindParam(":id_agente", $datos['id_agente']);
    $sql->execute();
    return $sql;
  }
  /*---------- eliminar Agentes ----------*/
  protected static function eliminar_agente_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE agentes SET eliminar=:eliminar, fecha_eliminado=:fecha_eliminado WHERE id_agente=:id_agente");
    $sql->bindParam(":eliminar", $datos['eliminar']);
    $sql->bindParam(":fecha_eliminado", $datos['fecha_eliminado']);
    $sql->bindParam(":id_agente", $datos['id_agente']);
    $sql->execute();
    return $sql;
  }
}
