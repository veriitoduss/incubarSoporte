<?php
// if ($_SESSION['rol_ihs'] != 1) {
//   echo $lc->forzar_cierre_sesion_controlador();
//   exit();
// }
if ($_SESSION['rol_ihs'] == 1 || $_SESSION['rol_ihs'] == 10) {
  include "./vistas/inc/headAdmin.php";
  include "./vistas/inc/menuAdmin.php";
} else {
  echo $lc->forzar_cierre_sesion_controlador();
  exit();
}
?>
<div class="content-page">
  <div class="">
    <div class="container">
      <img src="<?php echo SERVERURL; ?>assets/images/logoAdmin.png" style="height:90%;margin-left:70px;opacity: 0.7;margin-top:140px" alt="">
    </div>
  </div>
</div>
<?php
include "./vistas/inc/footerAdmin.php";
?>