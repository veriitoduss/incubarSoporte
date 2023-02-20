<?php

require_once "mainModel.php";

class administradorModelo extends mainModel
{
  /*---------- agregar rol ----------*/
  protected static function agregar_rol_modelo($id_rol, $nombre_rol, $eliminar)
  {
    $sql = mainModel::conectar()->prepare("INSERT INTO roles(id_rol,nombre_rol,eliminar)
      VALUES (:id_rol,:nombre_rol,:eliminar)");

    $sql->bindParam(":id_rol", $id_rol);
    $sql->bindParam(":nombre_rol", $nombre_rol);
    $sql->bindParam(":eliminar", $eliminar);
    $sql->execute();
    return $sql;
  }
  /*---------- agregar permisos ----------*/
  protected static function agregar_permisos_modelo($permisosRoles, $rolesPivote)
  {
    $sql = mainModel::conectar()->prepare("INSERT INTO pivote_permisos(id_permiso,id_rol)
        VALUES (:id_permiso,:id_rol)");

    $sql->bindParam(":id_permiso", $permisosRoles);
    $sql->bindParam(":id_rol", $rolesPivote);
    $sql->execute();
    return $sql;
  }
  /*---------- eliminar permisos ----------*/
  protected static function eliminar_modelo($id_rol)
  {
    $sql = mainModel::conectar()->prepare("DELETE FROM pivote_permisos WHERE id_rol=:id_rol");
    $sql->bindParam(":id_rol", $id_rol);
    $sql->execute();
    return $sql;
  }
  /*---------- eliminar rol ----------*/
  protected static function eliminar_rol_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("UPDATE roles SET eliminar=:eliminar, fecha_eliminado=:fecha_eliminado WHERE id_rol=:id_rol");
    $sql->bindParam(":eliminar", $datos['eliminar']);
    $sql->bindParam(":fecha_eliminado", $datos['fecha_eliminado']);
    $sql->bindParam(":id_rol", $datos['id_rol']);
    $sql->execute();
    return $sql;
  }
}
