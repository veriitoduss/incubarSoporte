<?php

require_once "mainModel.php";

class listaTicketModelo extends mainModel
{
  protected static function datos_ticket_controlador($id)
  {
    $sql = mainModel::conectar()->prepare("SELECT t.id_Ticket,c.nombre_categoria,t.numero_ticket,t.asunto,t.correo_usuario,t.nombre_apellido_usuario FROM tickets t,categorias c WHERE t.id_categoria= c.id_categoria AND t.id_ticket=:id_ticket");

    $sql->bindParam(":id_ticket", $id);
    $sql->execute();
    return $sql;
  }
  protected static function datos_tickets_controlador()
  {
    $sql = mainModel::conectar()->prepare("SELECT * FROM categorias");
    $sql->execute();
    return $sql;
  }
}
