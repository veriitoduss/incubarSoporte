<?php
session_start(['name' => 'IHS']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="latin-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include "./vistas/inc/linkVistas.php"; ?>
  <title><?php echo COMPANY; ?> </title>
</head>

<body>
  <?php
  $peticionAjax = false;
  require_once "./controladores/vistasControlador.php";
  $IV = new vistasControlador();
  $vistas = $IV->obtener_vistas_controlador();
  if ($vistas == "login" || $vistas == "404") {
    require_once "./vistas/contenidos/" . $vistas . "View.php";
  } else {
    $pagina = explode("/", $_GET['views']);
    require_once "./controladores/loginControlador.php";
    $lc = new loginControlador();
    include $vistas;
  ?>
    <script>
      // let btn_salir=document.querySelector("btn-exit-system");
      // btn_salir.addEventListener('click', function(e){
      //   e.preventDefault();
      //   Swal.fire({
      //     title:'',
      //     text:'',
      //     type:'',
      //     showcancelButton:true,
      //     confirmButtonColor:'#3052d6',
      //     cancelButtonColor:'#d33',
      //     confirmButtontext:'',
      //     cancelButtontext:'',
      //   }).then((result)=>{
      //     if (result.value) {
      //       window.location="";
      //     }
      //   });
      // });
      // alert("joa");
    </script>
  <?php
    include "./vistas/inc/cerrarSesion.php";
  }
  include "./vistas/inc/Script.php";
  ?>
</body>

</html>