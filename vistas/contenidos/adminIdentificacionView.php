<?php
// if ($_SESSION['rol_ihs'] != 1) {
//   echo $lc->forzar_cierre_sesion_controlador();
//   exit();
// }
if ($_SESSION['rol_ihs'] == 1 || $_SESSION['rol_ihs'] == 10) {
include "./vistas/inc/headAdmin.php";
include "./vistas/inc/menuAdmin.php";
require_once "./controladores/IdentificacionControlador.php";
$ins_identificador = new IdentificacionControlador();
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
            <ol class="breadcrumb pull-right">
              <li><a href="<?php echo SERVERURL; ?>adminIndex/" style="color:black">Admin</a></li>
              <li style="cursor: pointer;color:black">Adiciones</li>
              <li class="active"><a href="<?php echo SERVERURL; ?>adminIdentificacion/" style="color:black">Tipo de Identificación</a></li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary text-center">
            <div class="panel-heading">
              <h4 class="panel-title">Agregar Tipo de Identificación</h4>
            </div>
            <div class="panel-body">
              <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/identificacionAjax.php" id="formularioIdentificacion" method="POST" data-form="save" autocomplete="off">
                <div class="col-sm-12">
                  <div class="form-group" style="text-align: left;">
                    <label style="padding-bottom:10px;font-size:15px" for="tipo_identificacion">Nombre del tipo de identificación</label>
                    <span style="display: block; padding-bottom:20px;font-size:11px;color:#495057">Inserte el nombre del tipo de identificación</span>
                    <input required type="text" id="tipo_identificacion" name="tipo_identificacion" class="form-control" id="exampleInputEmail1">
                  </div>
                </div>
                <button type="submit" class="btn btn-dark waves-effect waves-light">Agregar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary text-center">
            <div class="panel-heading">
              <h4 class="panel-title">Tipo Identificación</h4>
            </div>
            <div class="panel-body">
              <?php
              echo $ins_identificador->mostrar_datosIdentificacion_controlador();
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