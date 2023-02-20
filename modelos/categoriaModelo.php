<?php

require_once "mainModel.php";

class categoriaModelo extends mainModel
{
  /*---------- agregar Categorias ----------*/
  protected static function agregar_categoria_modelo($nombre_categoria,$eliminar)
  {
    $sql = mainModel::conectar()->prepare("INSERT INTO categorias(nombre_categoria, eliminar)
        VALUES (:nombre_categoria,:eliminar)");

    $sql->bindParam(":nombre_categoria", $nombre_categoria);
    $sql->bindParam(":eliminar", $eliminar);
    $sql->execute();
    return $sql;
  }
  /*---------- actualizar Categorias ----------*/
  protected static function actualizar_categoria_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE categorias SET nombre_categoria=:nombre_categoria WHERE id_categoria=:id_categoria");
    $sql->bindParam(":nombre_categoria", $datos['nombre_categoria']);
    $sql->bindParam(":id_categoria", $datos['id_categoria']);
    $sql->execute();
    return $sql;
  }
  /*---------- eliminar Categoria ----------*/
  protected static function eliminar_categoria_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE categorias SET eliminar=:eliminar, fecha_eliminado=:fecha_eliminado WHERE id_categoria=:id_categoria");
    $sql->bindParam(":eliminar", $datos['eliminar']);
    $sql->bindParam(":fecha_eliminado", $datos['fecha_eliminado']);
    $sql->bindParam(":id_categoria", $datos['id_categoria']);
    $sql->execute();
    return $sql;
  }
}
