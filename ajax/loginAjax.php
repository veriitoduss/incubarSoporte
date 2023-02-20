<?php
$peticionAjax=true;
require_once "../config/APP.php";

if (isset($_POST['token']) && isset($_POST['agente']))
{
  require_once "../controladores/loginControlador.php";
  $ins_login= new loginControlador();
  echo $ins_login->cierre_sesion_controlador();

}else {
  session_start(['name'=>'IHS']);
  session_unset();
  session_destroy();
  header("Location:". SERVERURL."login/");
  exit();
}