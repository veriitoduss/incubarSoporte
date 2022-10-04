<?php
class Administrador extends Controllers
{
  public function __construct()
  {
    parent::__construct();
  }
  public function administrador()
  {
    $data['administrador'] = "Administrador";
    $data['vista'] = " ";
    $data['tag_page'] = "Soporte - Incubarhuila";
    $data['titulo'] = " ";
    $this->views->getView($this, "administrador", $data);
  }
  public function cerrarSesion()
  {
    session_start();
    session_destroy();
    header("Location: " . base_url());
  }

  // Agentes
  public function agente()
  {
    $data['administrador'] = "Administrador";
    $data['vista'] = "Agentes de soporte";
    $data['tag_page'] = "Soporte - Incubarhuila";
    $data['titulo'] = "Agentes";
    $data['roles'] = $this->model->getRol();
    $data['agentes'] = $this->model->getAgente();
    $this->views->getView($this, "agente", $data);
  }
  public function AgregarAgentes()
  {
    $nombre_agente = $_POST['nombre_agente'];
    $agenteNombre   = preg_replace('/[ <>\'\"]/', '', $nombre_agente);
    $correo_agente = $_POST['correo_agente'];
    $charPass = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $contra = '';
    for ($i = 0; $i < 8; $i++) {
      $contra .= $charPass[mt_rand(0, strlen($charPass) - 1)];
    }
    $usuario_agente = $agenteNombre;
    $contrasena_agente = $contra;
    $id_rol = $_POST['id_rol'];
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado = $_POST['fecha_eliminado'];
    $this->model->setAgente($nombre_agente, $correo_agente, $usuario_agente, $contrasena_agente, $id_rol,$eliminar,$fecha_eliminado);
    header("Location: " . base_url() . "administrador/agente");
  }
  public function EliminarAgente()
  {
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado =date("Y-m-d H:i:s");
    $id_agente = $_POST['id_agente'];
    $this->model->updateEliminarAgente($eliminar,$fecha_eliminado,$id_agente);
    header("Location: " . base_url() . "administrador/agente");
  }
  public function ModificarAgente()
  {
    $nombre_agente = $_POST['nombre_agente'];
    $correo_agente = $_POST['correo_agente'];
    $id_rol = $_POST['id_rol'];
    $id_agente = $_POST['id_agente'];
    $this->model->updateModificarAgente($nombre_agente,$correo_agente,$id_rol,$id_agente);
    header("Location: " . base_url() . "administrador/agente");
  }

  // Categorias
  public function categoria()
  {
    $data['vista'] = "Categorias ticket";
    $data['administrador'] = "Administrador";
    $data['titulo'] = "Categorias Ticket";
    $data['tag_page'] = "Soporte - Incubarhuila";
    $data['categorias'] = $this->model->getCategoria();
    $this->views->getView($this, "categoria", $data);
  }
  public function AgregarCategoria()
  {
    $nombre_categoria = $_POST['nombre_categoria'];
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado = $_POST['fecha_eliminado'];
    $this->model->setCategoria($nombre_categoria,$eliminar,$fecha_eliminado);
    header("Location: " . base_url() . "administrador/categoria");
  }
  public function Eliminarcategoria()
  {
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado =date("Y-m-d H:i:s");
    $id_categoria = $_POST['id_categoria'];
    $this->model->updateEliminarCategoria($eliminar,$fecha_eliminado,$id_categoria);
    header("Location: " . base_url() . "administrador/categoria");
  }
  public function ModificarCategoria()
  {
    $nombre_categoria = $_POST['nombre_categoria'];
    $id_categoria = $_POST['id_categoria'];
    $this->model->updateModificarCategoria($nombre_categoria,$id_categoria);
    header("Location: " . base_url() . "administrador/categoria");
  }

  // Clientes
  public function cliente()
  {
    $data['vista'] = "Clientes";
    $data['administrador'] = "Administrador";
    $data['titulo'] = "Clientes";
    $data['tag_page'] = "Soporte - Incubarhuila";
    $data['proyectos'] = $this->model->getProyectos();
    $data['cliente'] = $this->model->getCliente();
    $this->views->getView($this, "cliente", $data);
  }
  public function AgregarClientes()
  {
    $nombre_cliente = $_POST['nombre_cliente'];
    $id_proyecto = $_POST['id_proyecto'];
    while (true) {
      $nombre_cliente = current($nombre_cliente);
      $id_proyecto = current($id_proyecto);
      $cliente = (($nombre_cliente !== false) ? $nombre_cliente : ", &nbsp;");
      $proyecto = (($id_proyecto !== false) ? $id_proyecto : ", &nbsp;");
      $valores = '(' . $cliente . ',"' . $proyecto . '"),';
      $valor = substr($valores, 0, -1);
    }
    echo $valor;
    // $this->model->setCliente($valor);
    // header("Location: ".base_url()."administrador/cliente");
  }

  // Prioridades
  public function prioridades()
  {
    $data['vista'] = "Prioridades";
    $data['titulo'] = "Prioridades";
    $data['administrador'] = "Administrador";
    $data['tag_page'] = "Soporte - Incubarhuila";
    $data['proyectos'] = $this->model->getProyectos();
    // $id_proyecto=;
    // $data['proyectosID'] = $this->model->getProyectosID($id_proyecto);
    $data['prioridades'] = $this->model->getPrioridades();
    $this->views->getView($this, "prioridades", $data);
  }
  public function AgregarPrioridad()
  {
    $nombre_prioridad = $_POST['nombre_prioridad'];
    $id_proyecto = $_POST['id_proyecto'];
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado = $_POST['fecha_eliminado'];
    $this->model->setPrioridad($nombre_prioridad, $id_proyecto,$eliminar,$fecha_eliminado);
    header("Location: " . base_url() . "administrador/prioridades");
  }
  public function EliminarPrioridad()
  {
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado =date("Y-m-d H:i:s");
    $id_prioridad = $_POST['id_prioridad'];
    $this->model->updateEliminarPrioridad($eliminar,$fecha_eliminado,$id_prioridad);
    header("Location: " . base_url() . "administrador/prioridades");
  }
  public function ModificarPrioridad()
  {
    $nombre_prioridad = $_POST['nombre_prioridad'];
    $id_proyecto = $_POST['id_proyecto'];
    $id_prioridad = $_POST['id_prioridad'];
    $this->model->updateModificarPrioridad($nombre_prioridad,$id_proyecto,$id_prioridad);
    header("Location: " . base_url() . "administrador/prioridades");
  }

  // Proyectos
  public function proyecto()
  {
    $data['vista'] = "Proyectos";
    $data['titulo'] = "Proyectos";
    $data['administrador'] = "Administrador";
    $data['tag_page'] = "Soporte - Incubarhuila";
    $data['proyectos'] = $this->model->getProyectos();
    $this->views->getView($this, "proyecto", $data);
  }
  public function AgregarProyecto()
  {
    $nombre_proyecto = $_POST['nombre_proyecto'];
    $identificador_proyecto = $_POST['identificador_proyecto'];
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado = $_POST['fecha_eliminado'];
    $this->model->setProyecto($nombre_proyecto, $identificador_proyecto,$eliminar,$fecha_eliminado);
    header("Location: " . base_url() . "administrador/proyecto");
  }
  public function EliminarProyecto()
  {
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado =date("Y-m-d H:i:s");
    $id_proyecto = $_POST['id_proyecto'];
    $this->model->updateEliminarProyecto($eliminar,$fecha_eliminado,$id_proyecto);
    header("Location: " . base_url() . "administrador/proyecto");
  }
  public function ModificarProyecto()
  {
    $nombre_proyecto = $_POST['nombre_proyecto'];
    $identificador_proyecto = $_POST['identificador_proyecto'];
    $id_proyecto = $_POST['id_proyecto'];
    $this->model->updateModificarProyecto($nombre_proyecto,$identificador_proyecto,$id_proyecto);
    header("Location: " . base_url() . "administrador/proyecto");
  }

  // roles
  public function rol()
  {
    $data['administrador'] = "Administrador";
    $data['vista'] = "Roles de agentes";
    $data['tag_page'] = "Soporte - Incubarhuila";
    $data['titulo'] = "Roles de agentes";
    $data['roles'] = $this->model->getRol();
    $data['permisos'] = $this->model->getPermiso();
    $this->views->getView($this, "rol", $data);
  }
  public function AgregarRol()
  {
    $nombre_rol = $_POST['nombre_rol'];
    // $id_permiso=$_POST['id_permiso'];
    $this->model->setRol($nombre_rol);
    // $this->model->setPermiso($id_permiso);
    header("Location: " . base_url() . "administrador/rol");
  }
}
