<?php

require_once "mainModel.php";

class estadoModelo extends mainModel
{
  /*---------- agregar Estados ----------*/
  protected static function agregar_estado_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("INSERT INTO estados(estado, eliminar)
        VALUES (:estado,:eliminar)");

    $sql->bindParam(":estado", $datos['estado']);
    $sql->bindParam(":eliminar", $datos['eliminar']);
    $sql->execute();
    return $sql;
  }
  /*---------- actualizar Estado ----------*/
  protected static function actualizar_estado_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE estados SET estado=:estado WHERE id_estado=:id_estado");
    $sql->bindParam(":estado", $datos['estado']);
    $sql->bindParam(":id_estado", $datos['id_estado']);
    $sql->execute();
    return $sql;
  }
  /*---------- eliminar Estado ----------*/
  protected static function eliminar_estado_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE estados SET eliminar=:eliminar, fecha_eliminado=:fecha_eliminado WHERE id_estado=:id_estado");
    $sql->bindParam(":eliminar", $datos['eliminar']);
    $sql->bindParam(":fecha_eliminado", $datos['fecha_eliminado']);
    $sql->bindParam(":id_estado", $datos['id_estado']);
    $sql->execute();
    return $sql;
  }
}
