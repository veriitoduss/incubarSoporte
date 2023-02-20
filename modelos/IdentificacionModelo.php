<?php

require_once "mainModel.php";

class identificacionModelo extends mainModel
{
  /*---------- agregar Tipo Identificacion ----------*/
  protected static function agregar_identificacion_modelo($tipo_identificacion, $eliminar)
  {
    $sql = mainModel::conectar()->prepare("INSERT INTO tipo_identificaciones(tipo_identificacion, eliminar)
          VALUES (:tipo_identificacion,:eliminar)");

    $sql->bindParam(":tipo_identificacion", $tipo_identificacion);
    $sql->bindParam(":eliminar", $eliminar);
    $sql->execute();
    return $sql;
  }
  /*---------- actualizar Tipo Identificacion ----------*/
  protected static function actualizar_identificacion_modelo($tipo_identificacion, $id_tipo_identificacion)
  {
    $sql = mainModel::conectar()->prepare("UPDATE tipo_identificaciones SET tipo_identificacion=:tipo_identificacion WHERE id_tipo_identificacion=:id_tipo_identificacion");
    $sql->bindParam(":tipo_identificacion", $tipo_identificacion);
    $sql->bindParam(":id_tipo_identificacion", $id_tipo_identificacion);
    $sql->execute();
    return $sql;
  }
  /*---------- eliminar Tipo Identificacion ----------*/
  protected static function eliminar_identificacion_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE tipo_identificaciones SET eliminar=:eliminar, fecha_eliminado=:fecha_eliminado WHERE id_tipo_identificacion=:id_tipo_identificacion");
    $sql->bindParam(":eliminar", $datos['eliminar']);
    $sql->bindParam(":fecha_eliminado", $datos['fecha_eliminado']);
    $sql->bindParam(":id_tipo_identificacion", $datos['id_tipo_identificacion']);
    $sql->execute();
    return $sql;
  }
}
