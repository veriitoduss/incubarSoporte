<?php
class ticketsModel extends Mysql
{
  public function __construct()
  {
    parent::__construct();
  }
  // Tickets
  public function setTicket(string $numero_ticket,string $nombre_apellido_usuario,string $numero_identificacion_usuario, string $celular_usuario, string $correo_usuario, string $asunto, string $descripcion, string $archivo_adjunto_ticket, string $fecha_creacion_ticket, int $id_tipo_identificacion, int $id_cliente, int $id_tipo_requerimiento, int $id_estado)
  {
    $query_insert ="INSERT INTO tickets(numero_ticket,nombre_apellido_usuario,numero_identificacion_usuario,celular_usuario,correo_usuario,asunto,descripcion,archivo_adjunto_ticket,fecha_creacion_ticket,id_tipo_identificacion,id_cliente,id_tipo_requerimiento,id_estado) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $arrData=array ($numero_ticket,$nombre_apellido_usuario,$numero_identificacion_usuario,$celular_usuario,$correo_usuario,$asunto,$descripcion,$archivo_adjunto_ticket,$fecha_creacion_ticket,$id_tipo_identificacion,$id_cliente,$id_tipo_requerimiento,$id_estado);
    $request_insert=$this->insert($query_insert,$arrData);
    return $request_insert;
  }
  // Estados
  public function getEstados()
  {
    $sql ="SELECT * FROM estados";
    $request=$this->select_all($sql);
    return $request;
  }
  // Prioridades
  public function getPrioridades()
  {
    $sql ="SELECT * FROM prioridades";
    $request=$this->select_all($sql);
    return $request;
  }
  // Proyectos
  public function getProyectos()
  {
    $sql ="SELECT * FROM proyectos";
    $request=$this->select_all($sql);
    return $request;
  }
  // Clientes
  public function getClientes()
  {
    $sql ="SELECT c.id_cliente, c.nombre_cliente, p.nombre_proyecto FROM clientes c, proyectos p WHERE c.id_proyecto = p.id_proyecto AND c.id_proyecto=1";
    $request=$this->select_all($sql);
    return $request;
  }
  // Identificaciones
  public function getIdentificaciones()
  {
    $sql ="SELECT * FROM tipo_identificaciones";
    $request=$this->select_all($sql);
    return $request;
  }
  // Requerimientos
  public function getRequerimientos()
  {
    $sql ="SELECT * FROM tipo_requerimientos";
    $request=$this->select_all($sql);
    return $request;
  }
}
