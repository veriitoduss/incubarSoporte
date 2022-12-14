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
    $this->model->setAgente($nombre_agente, $correo_agente, $usuario_agente, $contrasena_agente, $id_rol, $eliminar, $fecha_eliminado);
    header("Location: " . base_url() . "administrador/agente");
  }
  public function EliminarAgente()
  {
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado = date("Y-m-d H:i:s");
    $id_agente = $_POST['id_agente'];
    $this->model->updateEliminarAgente($eliminar, $fecha_eliminado, $id_agente);
    header("Location: " . base_url() . "administrador/agente");
  }
  public function ModificarAgente()
  {
    $nombre_agente = $_POST['nombre_agente'];
    $correo_agente = $_POST['correo_agente'];
    $id_rol = $_POST['id_rol'];
    $id_agente = $_POST['id_agente'];
    $this->model->updateModificarAgente($nombre_agente, $correo_agente, $id_rol, $id_agente);
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
    $this->model->setCategoria($nombre_categoria, $eliminar, $fecha_eliminado);
    header("Location: " . base_url() . "administrador/categoria");
  }
  public function Eliminarcategoria()
  {
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado = date("Y-m-d H:i:s");
    $id_categoria = $_POST['id_categoria'];
    $this->model->updateEliminarCategoria($eliminar, $fecha_eliminado, $id_categoria);
    header("Location: " . base_url() . "administrador/categoria");
  }
  public function ModificarCategoria()
  {
    $nombre_categoria = $_POST['nombre_categoria'];
    $id_categoria = $_POST['id_categoria'];
    $this->model->updateModificarCategoria($nombre_categoria, $id_categoria);
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
    $nombre = $_POST['nombre_cliente'];
    $nombreCliente = chop($nombre);
    $nombre_cliente = nl2br($nombreCliente);
    $array_datos = explode("<br />", $nombre_cliente);
    $id_proyecto = $_POST['id_proyecto'];
    $IdentificadorProyecto = implode($id_proyecto);
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado = $_POST["fecha_eliminado"];
    for ($i = 0, $size = count($array_datos); $i < $size; ++$i) {
      $dato_proyecto[$i] = $IdentificadorProyecto;
      $dato_Eliminar[$i] = $eliminar;
      $dato_Fecha_Eliminar[$i] = $fecha_eliminado;
    }
    foreach ($array_datos as $clientes) {
      foreach ($dato_proyecto as $proyecto) {
      }
      foreach ($dato_Eliminar as $eliminacion) {
      }
      foreach ($dato_Fecha_Eliminar as $fechaEliminacion) {
      }
      $this->model->setClientes($clientes,$proyecto,$eliminacion,$fechaEliminacion);
    }
    header("Location: ".base_url()."administrador/cliente");
  }
  public function EliminarCliente()
  {
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado = date("Y-m-d H:i:s");
    $id_cliente = $_POST['id_cliente'];
    $this->model->updateEliminarCliente($eliminar, $fecha_eliminado, $id_cliente);
    header("Location: " . base_url() . "administrador/cliente");
  }
  public function ModificarCliente()
  {
    $nombre_cliente = $_POST['nombre_cliente'];
    $id_proyecto = $_POST['id_proyecto'];
    $id_cliente = $_POST['id_cliente'];
    $this->model->updateModificarCliente($nombre_cliente, $id_proyecto,$id_cliente);
    header("Location: " . base_url() . "administrador/cliente");
  }

  // Prioridades
  public function prioridades()
  {
    $data['vista'] = "Prioridades";
    $data['titulo'] = "Prioridades";
    $data['administrador'] = "Administrador";
    $data['tag_page'] = "Soporte - Incubarhuila";
    $data['proyectos'] = $this->model->getProyectos();
    $data['prioridades'] = $this->model->getPrioridades();
    $this->views->getView($this, "prioridades", $data);
  }
  public function AgregarPrioridad()
  {
    $nombre_prioridad = $_POST['nombre_prioridad'];
    $id_proyecto = $_POST['id_proyecto'];
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado = $_POST['fecha_eliminado'];
    $this->model->setPrioridad($nombre_prioridad, $id_proyecto, $eliminar, $fecha_eliminado);
    header("Location: " . base_url() . "administrador/prioridades");
  }
  public function EliminarPrioridad()
  {
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado = date("Y-m-d H:i:s");
    $id_prioridad = $_POST['id_prioridad'];
    $this->model->updateEliminarPrioridad($eliminar, $fecha_eliminado, $id_prioridad);
    header("Location: " . base_url() . "administrador/prioridades");
  }
  public function ModificarPrioridad()
  {
    $nombre_prioridad = $_POST['nombre_prioridad'];
    $id_proyecto = $_POST['id_proyecto'];
    $id_prioridad = $_POST['id_prioridad'];
    $this->model->updateModificarPrioridad($nombre_prioridad, $id_proyecto, $id_prioridad);
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
    $this->model->setProyecto($nombre_proyecto, $identificador_proyecto, $eliminar, $fecha_eliminado);
    header("Location: " . base_url() . "administrador/proyecto");
  }
  public function EliminarProyecto()
  {
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado = date("Y-m-d H:i:s");
    $id_proyecto = $_POST['id_proyecto'];
    $this->model->updateEliminarProyecto($eliminar, $fecha_eliminado, $id_proyecto);
    header("Location: " . base_url() . "administrador/proyecto");
  }
  public function ModificarProyecto()
  {
    $nombre_proyecto = $_POST['nombre_proyecto'];
    $identificador_proyecto = $_POST['identificador_proyecto'];
    $id_proyecto = $_POST['id_proyecto'];
    $this->model->updateModificarProyecto($nombre_proyecto, $identificador_proyecto, $id_proyecto);
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

  // requerimientos
  public function requerimiento()
  {
    $data['administrador'] = "Administrador";
    $data['vista'] = "Requerimientos";
    $data['tag_page'] = "Soporte - Incubarhuila";
    $data['titulo'] = "Requerimientos";
    $data['requerimientos'] = $this->model->getRequerimineto();
    $this->views->getView($this, "requerimiento", $data);
  }
  public function AgregarRequerimiento()
  {
    $tipo_requerimiento = $_POST['tipo_requerimiento'];
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado = $_POST['fecha_eliminado'];
    $this->model->setRequerimiento($tipo_requerimiento, $eliminar, $fecha_eliminado);
    header("Location: " . base_url() . "administrador/requerimiento");
  }
  public function EliminarRequerimiento()
  {
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado = date("Y-m-d H:i:s");
    $id_tipo_requerimiento = $_POST['id_tipo_requerimiento'];
    $this->model->updateEliminarTipoRequerimiento($eliminar, $fecha_eliminado, $id_tipo_requerimiento);
    header("Location: " . base_url() . "administrador/requerimiento");
  }
  public function ModificarRequerimiento()
  {
    $tipo_requerimiento = $_POST['tipo_requerimiento'];
    $id_tipo_requerimiento = $_POST['id_tipo_requerimiento'];
    $this->model->updateModificartTipoRequerimiento($tipo_requerimiento, $id_tipo_requerimiento);
    header("Location: " . base_url() . "administrador/requerimiento");
  }

  // identificaciones
  public function tipo_identificacion()
  {
    $data['administrador'] = "Administrador";
    $data['vista'] = "Tipo identificacion";
    $data['tag_page'] = "Soporte - Incubarhuila";
    $data['titulo'] = "Tipo identificaci??n";
    $data['identificaciones'] = $this->model->getTipoIdentificacion();
    $this->views->getView($this, "tipo_identificacion", $data);
  }
  public function AgregarTipoIdentificacion()
  {
    $tipo_identificacion = $_POST['tipo_identificacion'];
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado = $_POST['fecha_eliminado'];
    $this->model->setTipoIdentificacion($tipo_identificacion, $eliminar, $fecha_eliminado);
    header("Location: " . base_url() . "administrador/tipo_identificacion");
  }
  public function EliminarTipoIdentificacion()
  {
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado = date("Y-m-d H:i:s");
    $id_tipo_identificacion = $_POST['id_tipo_identificacion'];
    $this->model->updateEliminarTipoIdentificacion($eliminar, $fecha_eliminado, $id_tipo_identificacion);
    header("Location: " . base_url() . "administrador/tipo_identificacion");
  }
  public function ModificarTipoIdentificacion()
  {
    $tipo_identificacion = $_POST['tipo_identificacion'];
    $id_tipo_identificacion = $_POST['id_tipo_identificacion'];
    $this->model->updateModificartTipoIdentificacion($tipo_identificacion, $id_tipo_identificacion);
    header("Location: " . base_url() . "administrador/tipo_identificacion");
  }

  // ESTADOS
  public function estado()
  {
    $data['administrador'] = "Administrador";
    $data['vista'] = "Estados";
    $data['tag_page'] = "Soporte - Incubarhuila";
    $data['titulo'] = "Estados";
    $data['estados'] = $this->model->getEstado();
    $this->views->getView($this, "estado", $data);
  }
  public function AgregarEstado()
  {
    $estado = $_POST['estado'];
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado = $_POST['fecha_eliminado'];
    $this->model->setEstado($estado, $eliminar, $fecha_eliminado);
    header("Location: " . base_url() . "administrador/estado");
  }
  public function EliminarEstado()
  {
    $eliminar = $_POST['eliminar'];
    $fecha_eliminado = date("Y-m-d H:i:s");
    $id_estado = $_POST['id_estado'];
    $this->model->updateEliminarEstado($eliminar, $fecha_eliminado, $id_estado);
    header("Location: " . base_url() . "administrador/estado");
  }
  public function ModificarEstado()
  {
    $estado = $_POST['estado'];
    $id_estado = $_POST['id_estado'];
    $this->model->updateModificarEstado($estado, $id_estado);
    header("Location: " . base_url() . "administrador/estado");
  }
}
