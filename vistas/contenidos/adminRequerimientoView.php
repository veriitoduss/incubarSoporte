<?php
// if ($_SESSION['rol_ihs'] != 1) {
//   echo $lc->forzar_cierre_sesion_controlador();
//   exit();
// }
if ($_SESSION['rol_ihs'] == 1 || $_SESSION['rol_ihs'] == 10) {
  include "./vistas/inc/headAdmin.php";
  include "./vistas/inc/menuAdmin.php";
  require_once "./controladores/requerimientoControlador.php";
  $ins_requerimiento = new requerimientoControlador();
} else {
  echo $lc->forzar_cierre_sesion_controlador();
  exit();
}
?>
<div class="content-page">
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
        <div class="page-header-title">
            <ol class="breadcrumb pull-right" >
              <li><a href="<?php echo SERVERURL; ?>adminIndex/" style="color:black">Admin</a></li>
              <li style="cursor: pointer;">Adiciones</li>
              <li class="active"><a href="<?php echo SERVERURL; ?>adminRequerimiento/" style="color:black">Tipo de Requerimiento</a></li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary text-center">
            <div class="panel-heading">
              <h4 class="panel-title">Agregar Requerimiento</h4>
            </div>
            <div class="panel-body">
              <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/requerimientoAjax.php" id="formularioRequerimiento" method="POST" data-form="save" autocomplete="off">
                <div class="col-sm-12">
                  <div class="form-group" style="text-align: left;">
                    <label style="padding-bottom:10px;font-size:15px" for="tipo_requerimiento">Nombre del requerimiento</label>
                    <span style="display: block; padding-bottom:20px;font-size:11px;color:#495057">Inserte el nombre del requerimiento</span>
                    <input required type="text" id="tipo_requerimiento" name="tipo_requerimiento" class="form-control" id="exampleInputEmail1">
                  </div>
                </div>
                <button type="submit" class="btn btn-dark">Agregar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary text-center">
            <div class="panel-heading">
              <h4 class="panel-title">Tipo Requerimiento</h4>
            </div>
            <div class="panel-body">
              <?php
              echo $ins_requerimiento->mostrar_datosRequerimiento_controlador();
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include "./vistas/inc/footerAdmin.php";
?>