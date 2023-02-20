<?php
// if ($_SESSION['rol_ihs'] != 1) {
//   echo $lc->forzar_cierre_sesion_controlador();
//   exit();
// }
if ($_SESSION['rol_ihs'] == 1 || $_SESSION['rol_ihs'] == 10) {
  include "./vistas/inc/headAdmin.php";
  include "./vistas/inc/menuAdmin.php";
  require_once "./controladores/prioridadControlador.php";
  $ins_prioridad = new prioridadControlador();
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
              <li class="active"><a href="<?php echo SERVERURL; ?>adminPrioridad/" style="color:black">Prioridades</a></li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary text-center">
            <div class="panel-heading">
              <h4 class="panel-title">Agregar Prioridad</h4>
            </div>
            <div class="panel-body">
            <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/prioridadAjax.php" id="formularioProyecto" method="POST" data-form="save" autocomplete="off">
                <div class="col-sm-6">
                  <div class="form-group" style="text-align: left;" style="text-align: left;">
                    <label style="padding-bottom:10px;font-size:15px" for="nombre_prioridad">Nombre de la prioridad</label>
                    <span style="display: block; padding-bottom:20px;font-size:11px;color:#495057">Inserte el nombre de la prioridad</span>
                    <input required type="text" id="nombre_prioridad" name="nombre_prioridad" class="form-control" id="exampleInputEmail1">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group" style="text-align: left;">
                    <label style="padding-bottom:10px;font-size:15px" for="exampleInputPassword1">Proyecto</label>
                    <span style="display: block; padding-bottom:20px;font-size:11px;color:#495057">Por favor seleccione el proyecto relacionado</span>
                    <?php
                    echo $ins_prioridad->mostrar_datosproyecto_input_controlador();
                    ?>
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
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="panel-title">Prioridades</h4>
            </div>
            <?php
            echo $ins_prioridad->mostrar_datosprioridades_controlador($pagina[1], $pagina[0])
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include "./vistas/inc/footerAdmin.php";
?>