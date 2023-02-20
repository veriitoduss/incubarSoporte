<?php
// if ($_SESSION['rol_ihs'] != 1) {
//   echo $lc->forzar_cierre_sesion_controlador();
//   exit();
// }
if ($_SESSION['rol_ihs'] == 1 || $_SESSION['rol_ihs'] == 10) {
  include "./vistas/inc/headAdmin.php";
  include "./vistas/inc/menuAdmin.php";
  require_once "./controladores/proyectoControlador.php";
  $ins_administrador = new proyectoControlador();
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
              <li class="active"><a href="<?php echo SERVERURL; ?>adminProyecto/" style="color:black">Proyectos</a></li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary text-center">
            <div class="panel-heading">
              <h4 class="panel-title">Agregar Proyecto</h4>
            </div>
            <div class="panel-body">
              <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/proyectoAjax.php" id="formularioProyecto" method="POST" data-form="save" autocomplete="off">
                <div class="col-sm-6">
                  <div class="form-group" style="text-align: left;" style="text-align: left;">
                    <label style="padding-bottom:10px;font-size:15px" for="nombre_proyecto">Nombre del proyecto</label>
                    <span style="display: block; padding-bottom:20px;font-size:11px;color:#495057">Inserte el nombre del proyecto</span>
                    <input required type="text" id="nombre_proyecto" name="nombre_proyecto" class="form-control" id="exampleInputEmail1">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group" style="text-align: left;">
                    <label style="padding-bottom:10px;font-size:15px" for="identificador_proyecto">Identificador del proyecto</label>
                    <span style="display: block; padding-bottom:20px;font-size:11px;color:#495057">Inserte el identificador del proyecto. Recuerde que el identificador es en mayúscula</span>
                    <input required type="text" id="identificador_proyecto" name="identificador_proyecto" class="form-control" id="exampleInputEmail1">
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
              <h4 class="panel-title">Proyectos</h4>
            </div>
            <?php
            echo $ins_administrador->mostrar_datosproyectos_controlador($pagina[1], $pagina[0])
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