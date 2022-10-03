<?php
session_start();
if (!isset($_SESSION["id_agente"])) {
  // header("location:../incubarSoporte/");
  header("Location: " . base_url());
} {
  // print_r($_SESSION['id_agente']);
  // print_r($_SESSION["nombre_agente"]);
  // echo $_SESSION['nombre_agente'];
  // echo $_SESSION['id_agente'];
}
?>