<?php
// if ($_SESSION['rol_ihs'] != 1) {
//   echo $lc->forzar_cierre_sesion_controlador();
//   exit();
// }
// if ($_SESSION['rol_ihs'] == 1 || $_SESSION['rol_ihs'] == 10) {
include "./vistas/inc/headAdmin.php";
include "./vistas/inc/menuAdmin.php";
require_once "./controladores/administradorControlador.php";
$ins_rol = new administradorControlador();
// } else {
// echo $lc->forzar_cierre_sesion_controlador();
// exit();
// }
?>
<script src="<?php echo SERVERURL; ?>assets/js/jquery-3.6.1.min.js"></script>
<script src="<?php echo SERVERURL; ?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#seleccionarTodo').click(function() {
      $('#permisosPorRol input[type=checkbox]').attr("checked", true);
    });
    $('#deseleccionarTodo').click(function() {
      $('#permisosPorRol input[type=checkbox]').attr("checked", false);
    });
  });
</script>
<div class="content-page">
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="page-header-title">
            <ol class="breadcrumb pull-right">
              <li><a href="<?php echo SERVERURL; ?>adminIndex/" style="color:black">Admin</a></li>
              <li style="cursor: pointer;color:black">Adiciones</li>
              <li class="active"><a href="<?php echo SERVERURL; ?>adminRoles/" style="color:black">Roles</a></li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary text-center">
            <div class="panel-heading">
              <h4 class="panel-title">Roles</h4>
            </div>
            <div class="panel-body">
              <?php
              echo $ins_rol->mostrar_datosRol_controlador();
              ?>
            </div>
          </div>
        </div>
        <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/rolesAjax.php" id="formularioRoles" method="POST" data-form="save" autocomplete="off">
          <!-- <div class="col-md-6">
          <div class="panel panel-primary text-center">
            <div class="panel-heading">
              <h4 class="panel-title">Roles</h4>
            </div>
            <div class="panel-body">
              <?php
              echo $ins_rol->mostrar_datosRol_controlador();
              ?>
            </div>
          </div>
        </div> -->
          <div class="col-md-12">
            <div class="panel panel-primary text-center">
              <div class="panel-heading">
                <h4 class="panel-title">Agregar Rol</h4>
              </div>
              <div class="panel-body">
                <div class="form-group" style="text-align: left;">
                  <label style="padding-bottom:10px;font-size:15px" for="tipo_requerimiento">Nombre del rol</label>
                  <span style="display: block; padding-bottom:20px;font-size:11px;color:#495057">Por favor ingrese el nombre del rol</span>
                  <input type="text" id="nombre_rol_ag" name="nombre_rol_ag" class="form-control" id="exampleInputEmail1">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="panel panel-primary text-center">
              <div class="panel-heading">
                <h4 class="panel-title">Permisos por Rol</h4>
              </div>
              <div>
                <input type="button" class="seleccionarTodosLosPermisos" id="seleccionarTodo" value="Seleccionar Todo"></i>
                <input type="button" class="deseleccionarTodosLosPermisos" id="deseleccionarTodo" value="Quitar Seleccion"></i>
              </div>
              <div class="panel-body" style="margin: -25px" id="permisosPorRol">
                <?php
                echo $ins_rol->mostrar_datosPermisosRol_controlador();
                ?>
              </div>
              <button type="submit" class="btn btn-dark waves-effect waves-light" style="margin-bottom:25px;margin-top:20px">Agregar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
include "./vistas/inc/footerAdmin.php";
?>