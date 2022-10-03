<?php
class homeModel extends Mysql
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getUsuario($usuario_agente,$contrasena_agente)
  {
    $sql =" SELECT *FROM agentes WHERE usuario_agente='$usuario_agente' AND contrasena_agente='$contrasena_agente'";
    $request=$this->select($sql);
    return $request;
  }
  //   public function LoginAgente($usuario_agente,$contrasena_agente)
  // {
  //   $sql ="SELECT COUNT(*) AS contar FROM agentes WHERE usuario_agente='$usuario_agente' AND contrasena_agente='$contrasena_agente'";
  //   $request=$this->select($sql);
  //   return $request;
  // }
  public function AgenteVista($usuario_agente,$contrasena_agente)
  {
    $sql ="SELECT * FROM agentes WHERE usuario_agente='$usuario_agente' AND contrasena_agente='$contrasena_agente'";
    $request=$this->select($sql);
    return $request;
  }
  // public function setUser(string $nombre_agente,string $correo_agente,string $usuario_agente,string $contrasena_agente,int $id_rol)
  // {
  //   $query_insert ="INSERT INTO agentes(nombre_agente,correo_agente,usuario_agente,contrasena_agente,id_rol) VALUES (?,?,?,?,?)";
  //   $arrData=array ($nombre_agente,$correo_agente,$usuario_agente,$contrasena_agente,$id_rol);
  //   $request_insert=$this->insert($query_insert,$arrData);
  //   return $request_insert;
  // }

  // public function getUser($id_agente)
  // {
  //   $sql ="SELECT * FROM agentes WHERE id_agente=$id_agente";
  //   $request=$this->select($sql);
  //   return $request;
  // }

  // public function updateUser(int $id_agente, string $nombre_agente,string $correo_agente,string $usuario_agente,string $contrasena_agente,int $id_rol)
  // {
  //   $sql ="UPDATE agentes SET nombre_agente=? ,correo_agente=?,usuario_agente=?,contrasena_agente=?,id_rol=? where id_agente=$id_agente";
  //   $arrData= array ($nombre_agente,$correo_agente,$usuario_agente,$contrasena_agente,$id_rol);
  //   $request=$this->update($sql,$arrData);
  //   return $request;
  // }

  // public function getUsers()
  // {
  //   $sql ="SELECT * FROM agentes";
  //   $request=$this->select_all($sql);
  //   return $request;
  // }

  // public function deleteUser($id_agente)
  // {
  //   $sql ="DELETE FROM agentes WHERE id_agente=$id_agente";
  //   $request=$this->delete($sql);
  //   return $request;
  // }
}
?>