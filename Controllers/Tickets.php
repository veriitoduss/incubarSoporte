<?php
class Tickets extends Controllers{
  public function __construct()
  {
    parent::__construct();
  }
  public function tickets()
  {
    $data['estados']=$this->model->getEstados();
    $data['prioridades']=$this->model->getPrioridades();
    $data['proyectos']=$this->model->getProyectos();
    $data['clientes']=$this->model->getClientes();
    $data['identificaciones']=$this->model->getIdentificaciones();
    $data['requerimientos']=$this->model->getRequerimientos();
    $data['tag_page']="ticket";
    $this->views->getView($this,"tickets",$data);

  }
  public function AgregarTickets()
  {

    $numero_ticket=$_POST['numero_ticket'];
    $nombre_apellido_usuario=$_POST['nombre_apellido_usuario'];
    $numero_identificacion_usuario=$_POST['numero_identificacion_usuario'];
    $celular_usuario=$_POST['celular_usuario'];
    $correo_usuario=$_POST['correo_usuario'];
    $asunto=$_POST['asunto'];
    $descripcion=$_POST['descripcion'];
    $archivo_adjunto_ticket=$_POST['archivo_adjunto_ticket'];
    $fecha_creacion_ticket=date("Y-m-d H:i:s");
    $id_tipo_identificacion=$_POST['id_tipo_identificacion'];
    $id_cliente=$_POST['id_cliente'];
    $id_tipo_requerimiento=$_POST['id_tipo_requerimiento'];
    $id_estado=$_POST['id_estado'];
    // $id_proyecto=$_POST['id_proyecto'];
    // $identificadorTicket=$this->model->setIdentificador($id_proyecto);
    $this->model->setTicket($numero_ticket,$nombre_apellido_usuario,$numero_identificacion_usuario,$celular_usuario,$correo_usuario,$asunto,$descripcion,$archivo_adjunto_ticket,$fecha_creacion_ticket,$id_tipo_identificacion,$id_cliente,$id_tipo_requerimiento,$id_estado);
    header("Location: ".base_url()."tickets");
  }
    public function VerTickets()
  {
    $data=$this->model->getTickets();
    print_r($data);
  }


  // public function AgregarTickets()
  // {
  //   $numero_ticket=$_POST['numero_ticket'];
  //   $nombre_apellido_usuario=$_POST['nombre_apellido_usuario'];
  //   $numero_identificacion_usuario=$_POST['numero_identificacion_usuario'];
  //   $celular_usuario=$_POST['celular_usuario'];
  //   $correo_usuario=$_POST['correo_usuario'];
  //   $asunto=$_POST['asunto'];
  //   $descripcion=$_POST['descripcion'];
  //   $archivo_adjunto_ticket=$_POST['archivo_adjunto_ticket'];
  //   $fecha_creacion_ticket=date("Y-m-d H:i:s");
  //   $id_tipo_identificacion=$_POST['id_tipo_identificacion'];
  //   $id_cliente=$_POST['id_cliente'];
  //   $id_tipo_requerimiento=$_POST['id_tipo_requerimiento'];
  //   $id_estado=$_POST['id_estado'];
    
  //   $this->model->setUser($numero_ticket,$nombre_apellido_usuario,$numero_identificacion_usuario,$celular_usuario,$correo_usuario,$asunto,$descripcion,$archivo_adjunto_ticket,$fecha_creacion_ticket,$id_tipo_identificacion,$id_cliente,$id_tipo_requerimiento,$id_estado);
  //   return "gol";






    // $nombre_apellido_usuario=$_POST['nombre_apellido_usuario'];
    // $id_tipo_identificacion=$_POST['id_tipo_identificacion'];
    // $numero_identificacion_usuario=$_POST['numero_identificacion_usuario'];
    // $celular_usuario=$_POST['celular_usuario'];
    // $correo_usuario=$_POST['correo_usuario'];
    // $id_tipo_requerimiento=$_POST['id_tipo_requerimiento'];
    // $numero_ticket=$_POST['numero_ticket'];
    // $id_cliente=$_POST['id_cliente'];
    // $fecha_creacion_ticket=$_POST['fecha_creacion_ticket'];
    // $asunto=$_POST['asunto'];
    // $descripcion=$_POST['descripcion'];
    // $archivo_adjunto_ticket=$_POST['archivo_adjunto_ticket'];
    // $id_estado=$_POST['id_estado'];
    // $this->model->setUser($nombre_apellido_usuario,$id_tipo_identificacion,$numero_identificacion_usuario,$celular_usuario,$correo_usuario,$id_tipo_requerimiento,$numero_ticket,$id_cliente,$fecha_creacion_ticket,$asunto,$descripcion,$archivo_adjunto_ticket,$id_estado);
    // header( 'http://localhost/incubarSoporte/tickets' );
    // echo $nombre_apellido_usuario,$id_tipo_identificacion,$numero_identificacion_usuario,$celular_usuario,$correo_usuario,$id_tipo_requerimiento,$numero_ticket,$id_cliente,$fecha_creacion_ticket,$asunto,$descripcion,$archivo_adjunto_ticket,$id_estado;
    // $data['tag_page']="ticket";
    // $this->views->getView($this,"tickets",$data);
  // }

}
?>