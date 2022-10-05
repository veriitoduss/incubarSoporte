<?php
class administradorModel extends Mysql
{
  public function __construct()
  {
    parent::__construct();
  }

  // ROLES
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

  // CLIENTES
  public function getCliente()
  {
    $sql ="SELECT c.id_cliente,c.nombre_cliente, p.nombre_proyecto FROM clientes c, proyectos p WHERE c.id_proyecto=p.id_proyecto AND c.eliminar=0";
    $request=$this->select_all($sql);
    return $request;
  }
  public function setClientes($clientes,$proyecto,$eliminacion,$fechaEliminacion)
  {
    $query_insert ="INSERT INTO clientes(nombre_cliente,id_proyecto,eliminar,fecha_eliminado) VALUES (?,?,?,?)";
    $arrData=array ($clientes,$proyecto,$eliminacion,$fechaEliminacion);
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
  public function updateEliminarCliente($eliminar,$fecha_eliminado,$id_cliente)
  {
    $sql ="UPDATE clientes SET eliminar=? ,fecha_eliminado=? where id_cliente=$id_cliente";
    $arrData= array ($eliminar,$fecha_eliminado);
    $request=$this->update($sql,$arrData);
    return $request;
  }
  public function updateModificarCliente($nombre_cliente, $id_proyecto,$id_cliente)
  {
    $sql ="UPDATE clientes SET nombre_cliente=?,id_proyecto=? where id_cliente=$id_cliente";
    $arrData= array ($nombre_cliente,$id_proyecto);
    $request=$this->update($sql,$arrData);
    return $request;
  }

  // AGENTES
  public function getAgente()
  {
    $sql ="SELECT a.id_agente,a.nombre_agente, a.correo_agente,a.usuario_agente, r.nombre_rol FROM agentes a, roles r WHERE a.id_rol=r.id_rol AND a.eliminar=0";
    $request=$this->select_all($sql);
    return $request;
  }
  public function setAgente(string $nombre_agente,string $correo_agente, string $usuario_agente,string $contrasena_agente,int $id_rol,$eliminar,$fecha_eliminado)
  {
    $query_insert ="INSERT INTO agentes(nombre_agente,correo_agente,usuario_agente,contrasena_agente,id_rol,eliminar,fecha_eliminado) VALUES (?,?,?,?,?,?,?)";
    $arrData=array ($nombre_agente,$correo_agente,$usuario_agente,$contrasena_agente,$id_rol,$eliminar,$fecha_eliminado);
    $request_insert=$this->insert($query_insert,$arrData);
    return $request_insert;
  }
  public function updateEliminarAgente($eliminar,$fecha_eliminado,$id_agente)
  {
    $sql ="UPDATE agentes SET eliminar=? ,fecha_eliminado=? where id_agente=$id_agente";
    $arrData= array ($eliminar,$fecha_eliminado);
    $request=$this->update($sql,$arrData);
    return $request;
  }
  public function updateModificarAgente($nombre_agente,$correo_agente,$id_rol,$id_agente)
  {
    $sql ="UPDATE agentes SET nombre_agente=?,correo_agente=?,id_rol=? where id_agente=$id_agente";
    $arrData= array ($nombre_agente,$correo_agente,$id_rol);
    $request=$this->update($sql,$arrData);
    return $request;
  }

  // PRIORIDADES
  public function getPrioridades()
  {
    $sql ="SELECT p.id_proyecto,pr.id_prioridad,pr.nombre_prioridad, p.nombre_proyecto FROM prioridades pr, proyectos p WHERE pr.id_proyecto=p.id_proyecto AND pr.eliminar=0";
    $request=$this->select_all($sql);
    return $request;
  }
  public function setPrioridad(string $nombre_prioridad,int $id_proyecto, int $eliminar,$fecha_eliminado)
  {
    $query_insert ="INSERT INTO prioridades(nombre_prioridad,id_proyecto,eliminar,fecha_eliminado) VALUES (?,?,?,?)";
    $arrData=array ($nombre_prioridad,$id_proyecto,$eliminar,$fecha_eliminado);
    $request_insert=$this->insert($query_insert,$arrData,$eliminar,$fecha_eliminado);
    return $request_insert;
  }
    public function updateEliminarPrioridad($eliminar,$fecha_eliminado,$id_prioridad)
  {
    $sql ="UPDATE prioridades SET eliminar=? ,fecha_eliminado=? where id_prioridad=$id_prioridad";
    $arrData= array ($eliminar,$fecha_eliminado);
    $request=$this->update($sql,$arrData);
    return $request;
  }
  public function updateModificarPrioridad($nombre_prioridad,$id_proyecto,$id_prioridad)
  {
    $sql ="UPDATE prioridades SET nombre_prioridad=? ,id_proyecto=? where id_prioridad=$id_prioridad";
    $arrData= array ($nombre_prioridad,$id_proyecto);
    $request=$this->update($sql,$arrData);
    return $request;
  }

  // REQUERIMIENTOS
  public function setRequerimiento($tipo_requerimiento, $eliminar, $fecha_eliminado)
  {
    $query_insert ="INSERT INTO tipo_requerimientos(tipo_requerimiento,eliminar,fecha_eliminado) VALUES (?,?,?)";
    $arrData=array ($tipo_requerimiento,$eliminar,$fecha_eliminado);
    $request_insert=$this->insert($query_insert,$arrData);
    return $request_insert;
  }
  public function getRequerimineto()
  {
    $sql ="SELECT * FROM tipo_requerimientos WHERE eliminar=0";
    $request=$this->select_all($sql);
    return $request;
  }
  public function updateEliminarTipoRequerimiento($eliminar,$fecha_eliminado,$id_tipo_requerimiento)
  {
    $sql ="UPDATE tipo_requerimientos SET eliminar=? ,fecha_eliminado=? where id_tipo_requerimiento=$id_tipo_requerimiento";
    $arrData= array ($eliminar,$fecha_eliminado);
    $request=$this->update($sql,$arrData);
    return $request;
  }
  public function updateModificartTipoRequerimiento($tipo_requerimiento, $id_tipo_requerimiento)
  {
    $sql ="UPDATE tipo_requerimientos SET tipo_requerimiento=? where id_tipo_requerimiento=$id_tipo_requerimiento";
    $arrData= array ($tipo_requerimiento);
    $request=$this->update($sql,$arrData);
    return $request;
  }

  // IDENTIFICACIONES
  public function setTipoIdentificacion($tipo_identificacion, $eliminar, $fecha_eliminado)
  {
    $query_insert ="INSERT INTO tipo_identificaciones(tipo_identificacion,eliminar,fecha_eliminado) VALUES (?,?,?)";
    $arrData=array ($tipo_identificacion,$eliminar,$fecha_eliminado);
    $request_insert=$this->insert($query_insert,$arrData);
    return $request_insert;
  }
  public function getTipoIdentificacion()
  {
    $sql ="SELECT * FROM tipo_identificaciones WHERE eliminar=0";
    $request=$this->select_all($sql);
    return $request;
  }
  public function updateEliminarTipoIdentificacion($eliminar,$fecha_eliminado,$id_tipo_identificacion)
  {
    $sql ="UPDATE tipo_identificaciones SET eliminar=? ,fecha_eliminado=? where id_tipo_identificacion=$id_tipo_identificacion";
    $arrData= array ($eliminar,$fecha_eliminado);
    $request=$this->update($sql,$arrData);
    return $request;
  }
  public function updateModificartTipoIdentificacion($tipo_identificacion, $id_tipo_identificacion)
  {
    $sql ="UPDATE tipo_identificaciones SET tipo_identificacion=? where id_tipo_identificacion=$id_tipo_identificacion";
    $arrData= array ($tipo_identificacion);
    $request=$this->update($sql,$arrData);
    return $request;
  }

  // PROYECTOS
  public function setProyecto(string $nombre_proyecto,string $identificador_proyecto,$eliminar,$fecha_eliminado)
  {
    $query_insert ="INSERT INTO proyectos(nombre_proyecto,identificador_proyecto,eliminar,fecha_eliminado) VALUES (?,?,?,?)";
    $arrData=array ($nombre_proyecto,$identificador_proyecto,$eliminar,$fecha_eliminado);
    $request_insert=$this->insert($query_insert,$arrData);
    return $request_insert;
  }
  public function getProyectos()
  {
    $sql ="SELECT * FROM proyectos WHERE eliminar=0";
    $request=$this->select_all($sql);
    return $request;
  }
  public function updateEliminarProyecto($eliminar,$fecha_eliminado,$id_proyecto)
  {
    $sql ="UPDATE proyectos SET eliminar=? ,fecha_eliminado=? where id_proyecto=$id_proyecto";
    $arrData= array ($eliminar,$fecha_eliminado);
    $request=$this->update($sql,$arrData);
    return $request;
  }
  public function updateModificarProyecto($nombre_proyecto,$identificador_proyecto,$id_proyecto)
  {
    $sql ="UPDATE proyectos SET nombre_proyecto=? ,identificador_proyecto=? where id_proyecto=$id_proyecto";
    $arrData= array ($nombre_proyecto,$identificador_proyecto);
    $request=$this->update($sql,$arrData);
    return $request;
  }

  // CATEGORIAS
  public function setCategoria(string $nombre_categoria,$eliminar,$fecha_eliminado)
  {
    $query_insert ="INSERT INTO categorias(nombre_categoria,eliminar,fecha_eliminado) VALUES (?,?,?)";
    $arrData=array ($nombre_categoria,$eliminar,$fecha_eliminado);
    $request_insert=$this->insert($query_insert,$arrData);
    return $request_insert;
  }
  public function getCategoria()
  {
    $sql ="SELECT * FROM categorias where eliminar=0";
    $request=$this->select_all($sql);
    return $request;
  }
  public function updateEliminarCategoria($eliminar,$fecha_eliminado,$id_categoria)
  {
    $sql ="UPDATE categorias SET eliminar=? ,fecha_eliminado=? where id_categoria=$id_categoria";
    $arrData= array ($eliminar,$fecha_eliminado);
    $request=$this->update($sql,$arrData);
    return $request;
  }
  public function updateModificarCategoria($nombre_categoria,$id_categoria)
  {
    $sql ="UPDATE categorias SET nombre_categoria=? where id_categoria=$id_categoria";
    $arrData= array ($nombre_categoria);
    $request=$this->update($sql,$arrData);
    return $request;
  }

  // ESTADOS
  public function setEstado($estado, $eliminar, $fecha_eliminado)
  {
    $query_insert ="INSERT INTO estados(estado,eliminar,fecha_eliminado) VALUES (?,?,?)";
    $arrData=array ($estado, $eliminar, $fecha_eliminado);
    $request_insert=$this->insert($query_insert,$arrData);
    return $request_insert;
  }
  public function getEstado()
  {
    $sql ="SELECT * FROM estados where eliminar=0";
    $request=$this->select_all($sql);
    return $request;
  }
  public function updateEliminarEstado($eliminar,$fecha_eliminado,$id_estado)
  {
    $sql ="UPDATE estados SET eliminar=? ,fecha_eliminado=? where id_estado=$id_estado";
    $arrData= array ($eliminar,$fecha_eliminado);
    $request=$this->update($sql,$arrData);
    return $request;
  }
  public function updateModificarEstado($estado,$id_estado)
  {
    $sql ="UPDATE estados SET estado=? where id_estado=$id_estado";
    $arrData= array ($estado);
    $request=$this->update($sql,$arrData);
    return $request;
  }




  // public function setPermiso(string $id_permiso)
  // {
  //   $query_insert ="INSERT INTO roles(nombre_rol) VALUES (?)";
  //   $arrData=array ($nombre_rol);
  //   $request_insert=$this->insert($query_insert,$arrData);
  //   return $request_insert;
  // }

  // public function getProyectosID($id_proyecto)
  // {
  //   $sql ="SELECT * FROM proyectos WHERE id_proyecto=$id_proyecto";
  //   $request=$this->select_all($sql);
  //   return $request;
  // }





}
?>