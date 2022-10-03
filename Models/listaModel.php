<?php
class listaModel extends Mysql
{
  public function __construct()
  {
    parent::__construct();
  }
    public function getTicketsLista()
  {
    $sql ="SELECT t.numero_ticket,t.nombre_apellido_usuario,t.asunto, t.fecha_creacion_ticket,pt.fecha_respuesta,p.nombre_prioridad,c.nombre_categoria,e.estado FROM tickets t,procesos_tickets pt,prioridades p, categorias c, estados e WHERE pt.id_ticket=t.id_ticket AND pt.id_prioridad=p.id_prioridad AND pt.id_categoria=c.id_categoria AND t.id_estado=e.id_estado";
    $request=$this->select_all($sql);
    return $request;
  }

}
?>