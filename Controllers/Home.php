<?php
class Home extends Controllers
{
  public function __construct()
  {
    parent::__construct();
  }
  public function home()
  {
    $data['tag_page'] = "Soporte - Incubarhuila";
    $this->views->getView($this, "home", $data);
  }
  public function validar()
  {
    if (!empty($_POST["btnIniciarSesion"])) {
      if (!empty($_POST["usuario_agente"]) and !empty($_POST["contrasena_agente"])) {
        $usuario_agente = $_POST["usuario_agente"];
        $contrasena_agente = $_POST["contrasena_agente"];
        $datos = $this->model->AgenteVista($usuario_agente, $contrasena_agente);
        // $sql = $conexion->query(" SELECT *FROM agentes WHERE usuario_agente='$usuario_agente' AND contrasena_agente='$contrasena_agente'");
        if ($datos = $datos) {
          session_start();
          // $_SESSION['agentes'] = $datos;
          $_SESSION["id_agente"] = $datos['id_agente'];
          $_SESSION["nombre_agente"] = $datos['nombre_agente'];
          $_SESSION["correo_agente"] = $datos['correo_agente'];
          $_SESSION["id_rol"] = $datos['id_rol'];
          // $data=$datos['id_agente'];
          header("Location: ".base_url()."lista");
        } else {
          header("Location: ".base_url()."home");
        }
      } else {
        echo "campos vacios";
      }
    }
  }
  public function cerrarSesion()
  {
    session_start();
    session_destroy();
    header("Location: ".base_url());
  }
}
