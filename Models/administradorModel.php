<?php
class administradorModel extends Mysql
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getRol()
  {
    $sql ="SELECT * FROM roles";
    $request=$this->select_all($sql);
    return $request;
  }
  public function getPermiso()
  {
    $sql ="SELECT * FROM permisos";
    $request=$this->select_all($sql);
    return $request;
  }
  public function setRol(string $nombre_rol)
  {
    $query_insert ="INSERT INTO roles(nombre_rol) VALUES (?)";
    $arrData=array ($nombre_rol);
    $request_insert=$this->insert($query_insert,$arrData);
    return $request_insert;
  }
  // public function setPermiso(string $id_permiso)
  // {
  //   $query_insert ="INSERT INTO roles(nombre_rol) VALUES (?)";
  //   $arrData=array ($nombre_rol);
  //   $request_insert=$this->insert($query_insert,$arrData);
  //   return $request_insert;
  // }
  public function getAgente()
  {
    $sql ="SELECT a.nombre_agente, a.correo_agente, r.nombre_rol FROM agentes a, roles r WHERE a.id_rol=r.id_rol";
    $request=$this->select_all($sql);
    return $request;
  }
  public function setAgente(string $nombre_agente,string $correo_agente, string $usuario_agente,string $contrasena_agente,int $id_rol)
  {
    $query_insert ="INSERT INTO agentes(nombre_agente,correo_agente,usuario_agente,contrasena_agente,id_rol) VALUES (?,?,?,?,?)";
    $arrData=array ($nombre_agente,$correo_agente,$usuario_agente,$contrasena_agente,$id_rol);
    $request_insert=$this->insert($query_insert,$arrData);
    return $request_insert;
  }
  public function setCategoria(string $nombre_categoria)
  {
    $query_insert ="INSERT INTO categorias(nombre_categoria) VALUES (?)";
    $arrData=array ($nombre_categoria);
    $request_insert=$this->insert($query_insert,$arrData);
    return $request_insert;
  }
  public function getCategoria()
  {
    $sql ="SELECT * FROM categorias";
    $request=$this->select_all($sql);
    return $request;
  }

  public function setProyecto(string $nombre_proyecto,string $identificador_proyecto)
  {
    $query_insert ="INSERT INTO proyectos(nombre_proyecto,identificador_proyecto) VALUES (?,?)";
    $arrData=array ($nombre_proyecto,$identificador_proyecto);
    $request_insert=$this->insert($query_insert,$arrData);
    return $request_insert;
  }
  public function getProyectos()
  {
    $sql ="SELECT * FROM proyectos";
    $request=$this->select_all($sql);
    return $request;
  }
  public function getCliente()
  {
    $sql ="SELECT c.nombre_cliente, p.nombre_proyecto FROM clientes c, proyectos p WHERE c.id_proyecto=p.id_proyecto";
    $request=$this->select_all($sql);
    return $request;
  }
  public function getPrioridades()
  {
    $sql ="SELECT pr.nombre_prioridad, p.nombre_proyecto FROM prioridades pr, proyectos p WHERE pr.id_proyecto=p.id_proyecto";
    $request=$this->select_all($sql);
    return $request;
  }
  public function setPrioridad(string $nombre_prioridad,int $id_proyecto)
  {
    $query_insert ="INSERT INTO prioridades(nombre_prioridad,id_proyecto) VALUES (?,?)";
    $arrData=array ($nombre_prioridad,$id_proyecto);
    $request_insert=$this->insert($query_insert,$arrData);
    return $request_insert;
  }
  public function setCliente($valor)
  {
    $query_insert ="INSERT INTO clientes(nombre_cliente,id_proyecto) VALUES ('$valor')";
    $arrData=array ($valor);
    $request_insert=$this->insert($query_insert,$arrData);
    return $request_insert;
  }
}
?>