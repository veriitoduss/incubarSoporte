<?php

require_once "mainModel.php";

class loginModelo extends mainModel
{
  /*--------- Modelo inciar sesion ---------*/
  protected static function iniciar_sesion_modelo($datos)
  {
    $sql = mainModel::conectar()->prepare("SELECT * FROM agentes WHERE usuario_agente=:usuario_agente AND contrasena_agente=:contrasena_agente");
    $sql->bindParam(":usuario_agente", $datos['usuario_agente']);
    $sql->bindParam(":contrasena_agente", $datos['contrasena_agente']);
    $sql->execute();
    return $sql;
  }
  /*--------- Modelo inciar sesion ---------*/
  protected static function permisos()
  {
    $sql = mainModel::conectar()->prepare("SELECT id_permiso FROM pivote_permisos WHERE id_rol=10");
    $sql->execute();
    return $sql;
  }
}
