<?php

require_once "mainModel.php";

class requerimientoModelo extends mainModel
{
  /*---------- agregar Requerimiento ----------*/
  protected static function agregar_requerimiento_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("INSERT INTO tipo_requerimientos(tipo_requerimiento, eliminar)
        VALUES (:tipo_requerimiento,:eliminar)");
    $sql->bindParam(":tipo_requerimiento", $datos['tipo_requerimiento']);
    $sql->bindParam(":eliminar", $datos['eliminar']);
    $sql->execute();
    return $sql;
  }
  /*---------- actualizar Requerimiento ----------*/
  protected static function actualizar_requerimiento_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE tipo_requerimientos SET tipo_requerimiento=:tipo_requerimiento WHERE id_tipo_requerimiento=:id_tipo_requerimiento");
    $sql->bindParam(":tipo_requerimiento", $datos['tipo_requerimiento']);
    $sql->bindParam(":id_tipo_requerimiento", $datos['id_tipo_requerimiento']);
    $sql->execute();
    return $sql;
  }
  /*---------- eliminar Requerimiento ----------*/
  protected static function eliminar_requerimiento_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE tipo_requerimientos SET eliminar=:eliminar, fecha_eliminado=:fecha_eliminado WHERE id_tipo_requerimiento=:id_tipo_requerimiento");
    $sql->bindParam(":eliminar", $datos['eliminar']);
    $sql->bindParam(":fecha_eliminado", $datos['fecha_eliminado']);
    $sql->bindParam(":id_tipo_requerimiento", $datos['id_tipo_requerimiento']);
    $sql->execute();
    return $sql;
  }
}
