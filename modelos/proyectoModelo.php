<?php

require_once "mainModel.php";

class proyectoModelo extends mainModel
{
  /*---------- agregar Proyecto ----------*/
  protected static function agregar_proyecto_modelo($nombre_proyecto,$identificador_proyecto,$eliminar)
  {
    $sql = mainModel::conectar()->prepare("INSERT INTO proyectos(nombre_proyecto,identificador_proyecto, eliminar)
      VALUES (:nombre_proyecto,:identificador_proyecto,:eliminar)");

    $sql->bindParam(":nombre_proyecto", $nombre_proyecto);
    $sql->bindParam(":identificador_proyecto", $identificador_proyecto);
    $sql->bindParam(":eliminar", $eliminar);
    $sql->execute();
    return $sql;
  }
  /*---------- actualizar Proyecto ----------*/
  protected static function actualizar_proyecto_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE proyectos SET nombre_proyecto=:nombre_proyecto, identificador_proyecto=:identificador_proyecto WHERE id_proyecto=:id_proyecto");
    $sql->bindParam(":nombre_proyecto", $datos['nombre_proyecto']);
    $sql->bindParam(":identificador_proyecto", $datos['identificador_proyecto']);
    $sql->bindParam(":id_proyecto", $datos['id_proyecto']);
    $sql->execute();
    return $sql;
  }
  /*---------- eliminar Proyecto ----------*/
  protected static function eliminar_proyecto_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE proyectos SET eliminar=:eliminar, fecha_eliminado=:fecha_eliminado WHERE id_proyecto=:id_proyecto");
    $sql->bindParam(":eliminar", $datos['eliminar']);
    $sql->bindParam(":fecha_eliminado", $datos['fecha_eliminado']);
    $sql->bindParam(":id_proyecto", $datos['id_proyecto']);
    $sql->execute();
    return $sql;
  }
}
