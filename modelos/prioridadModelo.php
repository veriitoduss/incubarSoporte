<?php

require_once "mainModel.php";

class prioridadModelo extends mainModel
{
  /*---------- agregar Prioridades ----------*/
  protected static function agregar_prioridad_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("INSERT INTO prioridades(nombre_prioridad,id_proyecto, eliminar)
        VALUES (:nombre_prioridad,:id_proyecto,:eliminar)");

    $sql->bindParam(":nombre_prioridad", $datos['nombre_prioridad']);
    $sql->bindParam(":id_proyecto", $datos['id_proyecto']);
    $sql->bindParam(":eliminar", $datos['eliminar']);
    $sql->execute();
    return $sql;
  }
  /*---------- actualizar Prioridad ----------*/
  protected static function actualizar_prioridad_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE prioridades SET nombre_prioridad=:nombre_prioridad, id_proyecto=:id_proyecto WHERE id_prioridad=:id_prioridad");
    $sql->bindParam(":nombre_prioridad", $datos['nombre_prioridad']);
    $sql->bindParam(":id_proyecto", $datos['id_proyecto']);
    $sql->bindParam(":id_prioridad", $datos['id_prioridad']);
    $sql->execute();
    return $sql;
  }
  /*---------- eliminar Prioridades ----------*/
  protected static function eliminar_prioridad_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE prioridades SET eliminar=:eliminar, fecha_eliminado=:fecha_eliminado WHERE id_prioridad=:id_prioridad");
    $sql->bindParam(":eliminar", $datos['eliminar']);
    $sql->bindParam(":fecha_eliminado", $datos['fecha_eliminado']);
    $sql->bindParam(":id_prioridad", $datos['id_prioridad']);
    $sql->execute();
    return $sql;
  }
}
