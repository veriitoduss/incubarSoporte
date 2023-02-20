<?php

require_once "mainModel.php";

class clienteModelo extends mainModel
{
  /*---------- agregar Clientes ----------*/
  protected static function agregar_cliente_modelo($clientes, $proyecto, $eliminacion)
  {
    $sql = mainModel::conectar()->prepare("INSERT INTO clientes(nombre_cliente,id_proyecto,eliminar)
            VALUES (:clientes,:proyecto,:eliminacion)");
    $sql->bindParam(":clientes", $clientes);
    $sql->bindParam(":proyecto", $proyecto);
    $sql->bindParam(":eliminacion", $eliminacion);
    $sql->execute();
    return $sql;
  }
  /*---------- actualizar Cliente ----------*/
  protected static function actualizar_cliente_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE clientes SET nombre_cliente=:nombre_cliente,id_proyecto=:id_proyecto WHERE id_cliente=:id_cliente");
    $sql->bindParam(":nombre_cliente", $datos['nombre_cliente']);
    $sql->bindParam(":id_proyecto", $datos['id_proyecto']);
    $sql->bindParam(":id_cliente", $datos['id_cliente']);
    $sql->execute();
    return $sql;
  }
  /*---------- eliminar Cliente ----------*/
  protected static function eliminar_cliente_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE clientes SET eliminar=:eliminar, fecha_eliminado=:fecha_eliminado WHERE id_cliente=:id_cliente");
    $sql->bindParam(":eliminar", $datos['eliminar']);
    $sql->bindParam(":fecha_eliminado", $datos['fecha_eliminado']);
    $sql->bindParam(":id_cliente", $datos['id_cliente']);
    $sql->execute();
    return $sql;
  }
}
