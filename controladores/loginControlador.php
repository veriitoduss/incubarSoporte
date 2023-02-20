<?php

if ($peticionAjax) {
  require_once "../modelos/loginModelo.php";
} else {
  require_once "./modelos/loginModelo.php";
}
class loginControlador extends loginModelo
{
  /*--------- Controlador inciar sesion ---------*/
  public function iniciar_sesion_controlador()
  {
    $usuario_agente = mainModel::limpiar_cadena($_POST['usuario_agente']);
    $contrasena_agente = mainModel::limpiar_cadena($_POST['contrasena_agente']);
    /*=== comprobar campos vacios ===*/
    if ($usuario_agente == "" || $contrasena_agente == "") {
      echo '<script>
          Swal.fire
          ({
            icon: "error",
            title: "Ocurrio un error inesperado",
            text: "No se han llenado todos los campos requeridos",
            type: "error",
            confirmButtonText:"Aceptar"
          });
          </script>';
      exit();
    }
    $datos_login =
      [
        'usuario_agente' => $usuario_agente,
        'contrasena_agente' => $contrasena_agente,
      ];
    $datos_cuenta = loginModelo::iniciar_sesion_modelo($datos_login);
    // $consulta = "SELECT id_permiso FROM pivote_permisos WHERE id_rol=10";
    // $conexion = mainModel::conectar();
    // $datos_permisos = $conexion->query($consulta);
    // $datos_permisos = $datos_permisos->fetchAll();
    // $datos_permisos = loginModelo::permisos();

    if ($datos_cuenta->rowCount() == 1) {
      // echo "si tiene ingreso";
      $row = $datos_cuenta->fetch();
      // $row_permisos = $datos_permisos->fetch();
      session_start(['name' => 'IHS']);
      $_SESSION['id_ihs'] = $row['id_agente'];
      $_SESSION['nombre_ihs'] = $row['nombre_agente'];
      $_SESSION['correo_ihs'] = $row['correo_agente'];
      $_SESSION['usuario_ihs'] = $row['usuario_agente'];
      $_SESSION['contrasena_ihs'] = $row['contrasena_agente'];
      $_SESSION['rol_ihs'] = $row['id_rol'];
      // $_SESSION['permisos_ihs'] = $datos_permisos;
      $_SESSION['token_ihs'] = md5(uniqid(mt_rand(), true));

      if (headers_sent()) {
        echo "<script> window.location.href ='" . SERVERURL . "listaTicket/';
        </script>";
      } else {
        return header("Location: " . SERVERURL . "listaTicket/");
      }
    } else {
      echo "<script>
      alert('Credenciales incorrectas');
      </script>";
      exit();
    }
  }
  /*--------- Controlador forzar cierre sesion ---------*/
  public function forzar_cierre_sesion_controlador()
  {
    // session_start();
    // session_destroy();
    // header("Location: ".SERVERURL);
    session_unset();
    session_destroy();
    if (headers_sent()) {
      return "<script> window.location.href ='" . SERVERURL . "login/';</script>";
    } else {
      return header("Location: " . SERVERURL . "login/");
    }
  } //fin funcion forzar_cierre_sesion_controlador
  /*--------- Controlador forzar cierre de sesion ---------*/
  public function cierre_sesion_controlador()
  {
    session_start(['name' => 'IHS']);
    $tocken = mainModel::decryption($_POST['token']);
    $agente = mainModel::decryption($_POST['agente']);
    if ($tocken == $_SESSION['token_ihs'] && $agente == $_SESSION['usuario_ihs']) {
      session_unset();
      session_destroy();
      $alerta = [
        "Alerta" => "redireccionar",
        "URL" => SERVERURL . "login/"
      ];
    } else {
      $alerta =
        [
          "Alerta" => "simple",
          "Icon" => "error",
          "Titulo" => "Ocurrio un error inesperado",
          "Texto" => "No se pudo Cerrar la sesion",
          "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
  } //fin funcion cierre_sesion_controlador
}
